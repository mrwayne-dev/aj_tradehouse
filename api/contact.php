<?php
/**
 * Contact Form API Handler
 * Richie Forex Trading Academy
 * FIXED VERSION with better error handling
 */

// Define API access constant
define('API_ACCESS', true);

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set headers FIRST before any output
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With');

// Handle OPTIONS preflight request
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    die(json_encode(['success' => false, 'message' => 'Method not allowed.']));
}

// Error reporting - log errors but don't display them
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/php_errors.log');

// Try to load dependencies
try {
    // Check if vendor autoload exists
    $autoloadPath = __DIR__ . '/../vendor/autoload.php';
    if (!file_exists($autoloadPath)) {
        throw new Exception('Composer autoload not found. Run: composer install');
    }
    require_once $autoloadPath;
    
    // Check if config exists
    $configPath = __DIR__ . '/config.php';
    if (!file_exists($configPath)) {
        throw new Exception('Config file not found at: ' . $configPath);
    }
    require_once $configPath;
    
    // Check if email templates exist
    $templatesPath = __DIR__ . '/email-templates.php';
    if (!file_exists($templatesPath)) {
        throw new Exception('Email templates file not found at: ' . $templatesPath);
    }
    require_once $templatesPath;
    
} catch (Exception $e) {
    error_log('Contact Form - Configuration Error: ' . $e->getMessage());
    http_response_code(500);
    die(json_encode([
        'success' => false,
        'message' => 'Server configuration error. Please contact support.',
        'debug' => DEBUG_MODE ? $e->getMessage() : null
    ]));
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/* --------------------------------------------------
   HELPER FUNCTIONS
-------------------------------------------------- */

function sendJson($success, $message, $code = 200, $extra = []) {
    http_response_code($code);
    $response = array_merge([
        'success' => $success,
        'message' => $message
    ], $extra);
    echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function checkRateLimit() {
    if (!RATE_LIMIT_ENABLED) return true;
    
    $key = 'rate_' . md5($_SERVER['REMOTE_ADDR'] ?? 'unknown');
    
    if (!isset($_SESSION[$key])) {
        $_SESSION[$key] = ['count' => 1, 'time' => time()];
        return true;
    }
    
    $elapsed = time() - $_SESSION[$key]['time'];
    
    if ($elapsed > RATE_LIMIT_WINDOW) {
        $_SESSION[$key] = ['count' => 1, 'time' => time()];
        return true;
    }
    
    if ($_SESSION[$key]['count'] >= RATE_LIMIT_REQUESTS) {
        return false;
    }
    
    $_SESSION[$key]['count']++;
    return true;
}

function sendEmail($to, $toName, $subject, $body) {
    $mail = new PHPMailer(true);
    
    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_SECURE;
        $mail->Port = SMTP_PORT;
        
        // Enable verbose debug output in debug mode
        if (DEBUG_MODE) {
            $mail->SMTPDebug = 2;
            $mail->Debugoutput = function($str, $level) {
                error_log("PHPMailer SMTP Debug: $str");
            };
        }
        
        // Set longer timeout
        $mail->Timeout = 30;
        
        // Character set
        $mail->CharSet = 'UTF-8';
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        $mail->addAddress($to, $toName);
        $mail->addReplyTo(SMTP_FROM_EMAIL, SMTP_FROM_NAME);
        
        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = strip_tags(str_replace('<br>', "\n", $body));
        
        $result = $mail->send();
        
        if (DEBUG_MODE) {
            error_log("Email sent successfully to: $to");
        }
        
        return $result;
        
    } catch (Exception $e) {
        error_log('PHPMailer Error: ' . $e->getMessage());
        error_log('PHPMailer Full Error: ' . print_r($mail->ErrorInfo, true));
        return false;
    }
}

/* --------------------------------------------------
   MAIN EXECUTION
-------------------------------------------------- */

try {
    // Log request for debugging
    if (DEBUG_MODE) {
        error_log('Contact form request received from IP: ' . ($_SERVER['REMOTE_ADDR'] ?? 'unknown'));
    }
    
    // Get and parse input
    $rawInput = file_get_contents('php://input');
    
    if (DEBUG_MODE) {
        error_log('Raw input: ' . $rawInput);
    }
    
    $input = json_decode($rawInput, true);
    
    if (json_last_error() !== JSON_ERROR_NONE || !is_array($input)) {
        error_log('JSON decode error: ' . json_last_error_msg());
        sendJson(false, 'Invalid JSON data.', 400);
    }
    
    // Validate required fields
    $required = ['first_name', 'last_name', 'email', 'company', 'inquiry_type'];
    $errors = [];
    
    foreach ($required as $field) {
        if (!isset($input[$field]) || trim($input[$field]) === '') {
            $errors[] = ucfirst(str_replace('_', ' ', $field)) . ' is required.';
        }
    }

    // Validate email
    if (isset($input['email']) && !filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Please provide a valid email address.';
    }

    // Validate inquiry type
    $validTypes = ['Mentorship', 'VIP Signals', 'Copy Trading', 'Bootcamp', 'Partnership'];
    if (isset($input['inquiry_type']) && !in_array($input['inquiry_type'], $validTypes, true)) {
        $errors[] = 'Please select a valid inquiry type.';
    }
    
    if (!empty($errors)) {
        sendJson(false, 'Please correct the errors below.', 400, ['errors' => $errors]);
    }
    
    // Check rate limiting
    if (!checkRateLimit()) {
        sendJson(false, 'Too many requests. Please try again in an hour.', 429);
    }
    
    // Sanitize input data
    $data = [
        'first_name' => htmlspecialchars(trim($input['first_name']), ENT_QUOTES, 'UTF-8'),
        'last_name' => htmlspecialchars(trim($input['last_name']), ENT_QUOTES, 'UTF-8'),
        'email' => filter_var(trim($input['email']), FILTER_SANITIZE_EMAIL),
        'company' => htmlspecialchars(trim($input['company']), ENT_QUOTES, 'UTF-8'),
        'inquiry_type' => htmlspecialchars(trim($input['inquiry_type']), ENT_QUOTES, 'UTF-8')
    ];

    if (DEBUG_MODE) {
        error_log('Sanitized data: ' . print_r($data, true));
    }

    // Generate email bodies
    $adminBody = EmailTemplate::adminNotification($data);
    $userBody = EmailTemplate::userConfirmation($data);

    // Send admin notification
    $adminSent = sendEmail(
        ADMIN_EMAIL,
        ADMIN_NAME,
        'New Contact: ' . $data['inquiry_type'],
        $adminBody
    );
    
    if (DEBUG_MODE) {
        error_log('Admin email sent: ' . ($adminSent ? 'YES' : 'NO'));
    }
    
    // Send user confirmation
    $userSent = sendEmail(
        $data['email'],
        $data['first_name'] . ' ' . $data['last_name'],
        'Thank you for contacting ' . SITE_NAME,
        $userBody
    );
    
    if (DEBUG_MODE) {
        error_log('User email sent: ' . ($userSent ? 'YES' : 'NO'));
    }
    
    // Create logs directory if it doesn't exist
    $logDir = __DIR__ . '/logs';
    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }
    
    // Log submission
    $logEntry = sprintf(
        "[%s] %s | %s | %s | Admin:%s User:%s\n",
        date('Y-m-d H:i:s'),
        $data['email'],
        $data['inquiry_type'],
        $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        $adminSent ? 'OK' : 'FAIL',
        $userSent ? 'OK' : 'FAIL'
    );
    
    @file_put_contents($logDir . '/submissions.log', $logEntry, FILE_APPEND);
    
    // Send response based on email results
    if ($adminSent && $userSent) {
        sendJson(true, SUCCESS_MESSAGE, 200);
    } elseif ($adminSent) {
        sendJson(true, 'Message received! Confirmation email may be delayed.', 200);
    } else {
        error_log('Both emails failed to send');
        sendJson(false, ERROR_MESSAGE, 500);
    }
    
} catch (Exception $e) {
    error_log('Contact Form Critical Error: ' . $e->getMessage());
    error_log('Stack trace: ' . $e->getTraceAsString());
    sendJson(false, 'An error occurred. Please try again later.', 500, [
        'debug' => DEBUG_MODE ? $e->getMessage() : null
    ]);
}