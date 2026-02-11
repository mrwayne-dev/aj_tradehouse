<?php

if (!defined('API_ACCESS')) {
    http_response_code(403);
    die('Direct access not permitted');
}


define('SMTP_HOST', 'smtp.titan.email');
define('SMTP_PORT', 587);
define('SMTP_SECURE', 'tls'); 
define('SMTP_USERNAME', 'support@richieforextradingacademy.com');
define('SMTP_PASSWORD', '@Richieforextrading1');
define('SMTP_FROM_EMAIL', 'support@richieforextradingacademy.com');
define('SMTP_FROM_NAME', 'Richie Forex Trading Academy');


define('ADMIN_EMAIL', 'support@richieforextradingacademy.com');
define('ADMIN_NAME', 'Admin Team');

define('SITE_NAME', 'Richie Forex Trading Academy');
define('SITE_URL', 'https://richieforextradingacademy.com');
define('SUPPORT_EMAIL', 'support@richieforextradingacademy.com');


define('PRIMARY_COLOR', '#8b2cf5');
define('ACCENT_COLOR', '#B88CFF'); 
define('TEXT_COLOR', '#F5F7FF');
define('LIGHT_BG', '#f4f4f4');

// Response Messages
define('SUCCESS_MESSAGE', 'Thank you for contacting us! We\'ll get back to you shortly.');
define('ERROR_MESSAGE', 'Sorry, there was an error sending your message. Please try again.');

// Rate Limiting
define('RATE_LIMIT_ENABLED', true);
define('RATE_LIMIT_REQUESTS', 3); 
define('RATE_LIMIT_WINDOW', 3600);


define('DEBUG_MODE', true);


date_default_timezone_set('Africa/Lagos'); 