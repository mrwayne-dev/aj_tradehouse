<?php

if (!defined('API_ACCESS')) {
    http_response_code(403);
    die('Direct access not permitted');
}

class EmailTemplate {
    
    /**
     * Base HTML Email Template
     */
    private static function getBaseTemplate($content, $preheader = '') {
        return '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>' . SITE_NAME . '</title>
    <!--[if mso]>
    <style type="text/css">
        body, table, td {font-family: Arial, Helvetica, sans-serif !important;}
    </style>
    <![endif]-->
    <style>
        /* Reset Styles */
        body {
            margin: 0;
            padding: 0;
            width: 100% !important;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        img {
            border: 0;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }
        table {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }
        .ExternalClass {
            width: 100%;
        }
        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-container {
                width: 100% !important;
                margin: auto !important;
            }
            .fluid {
                width: 100% !important;
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }
            .stack-column {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
                direction: ltr !important;
            }
            .mobile-padding {
                padding: 20px !important;
            }
        }
    </style>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f4;">
    <!-- Preheader Text -->
    <div style="display: none; max-height: 0; overflow: hidden;">
        ' . htmlspecialchars($preheader) . '
    </div>
    
    <!-- Main Container -->
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: 0; padding: 0; background-color: #f4f4f4;">
        <tr>
            <td style="padding: 40px 10px;">
                <!-- Email Container -->
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" class="email-container" style="margin: auto; width: 100%; max-width: 600px; background-color: #ffffff; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                    ' . $content . '
                </table>
            </td>
        </tr>
    </table>
</body>
</html>';
    }
    
    /**
     * Email Header
     */
    private static function getHeader() {
        return '
    <!-- Header -->
    <tr>
        <td style="padding: 40px 30px; text-align: center; background-color: ' . PRIMARY_COLOR . '; border-radius: 8px 8px 0 0;">
            <h1 style="margin: 0; color: #ffffff; font-size: 24px; font-weight: 700; letter-spacing: -0.5px;">
                Richie Forex Trading Academy
            </h1>
        </td>
    </tr>';
    }
    
    /**
     * Email Footer
     */
    private static function getFooter() {
        $currentYear = date('Y');
        return '
    <!-- Footer -->
    <tr>
        <td style="padding: 30px; background-color: #f9f9f9; border-radius: 0 0 8px 8px; text-align: center;">
            <p style="margin: 0 0 10px 0; font-size: 14px; color: #666666; line-height: 1.6;">
                <strong>' . SITE_NAME . '</strong><br>
                Email: <a href="mailto:' . SUPPORT_EMAIL . '" style="color: ' . ACCENT_COLOR . '; text-decoration: none;">' . SUPPORT_EMAIL . '</a>
            </p>
            <p style="margin: 15px 0 0 0; font-size: 12px; color: #999999;">
                &copy; ' . $currentYear . ' ' . SITE_NAME . '. All rights reserved.
            </p>
        </td>
    </tr>';
    }
    
    /**
     * Admin Notification Email
     */
    public static function adminNotification($data) {
        $inquiryTypes = [
            'Mentorship' => '📚 Mentorship Inquiry',
            'VIP Signals' => '📊 VIP Signals Inquiry',
            'Copy Trading' => '💹 Copy Trading Inquiry',
            'Bootcamp' => '🎓 Bootcamp Inquiry',
            'Partnership' => '🤝 Partnership Inquiry'
        ];
        
        $inquiryTitle = isset($inquiryTypes[$data['inquiry_type']]) 
            ? $inquiryTypes[$data['inquiry_type']] 
            : '💬 General Inquiry';
        
        $content = self::getHeader() . '
    <!-- Content -->
    <tr>
        <td class="mobile-padding" style="padding: 40px 30px;">
            <h2 style="margin: 0 0 20px 0; color: ' . PRIMARY_COLOR . '; font-size: 22px; font-weight: 700;">
                New Contact Form Submission
            </h2>
            
            <!-- Inquiry Type Badge -->
            <div style="display: inline-block; padding: 8px 16px; background-color: ' . ACCENT_COLOR . '; color: #ffffff; border-radius: 20px; font-size: 14px; font-weight: 600; margin-bottom: 25px;">
                ' . htmlspecialchars($inquiryTitle) . '
            </div>
            
            <p style="margin: 0 0 25px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                A new contact form has been submitted on your website. Here are the details:
            </p>
            
            <!-- Contact Details Table -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin-bottom: 25px; border: 1px solid #e0e0e0; border-radius: 6px;">
                <tr>
                    <td style="padding: 15px; background-color: #f9f9f9; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: ' . TEXT_COLOR . '; width: 40%;">
                        Name
                    </td>
                    <td style="padding: 15px; border-bottom: 1px solid #e0e0e0; color: ' . TEXT_COLOR . ';">
                        ' . htmlspecialchars($data['first_name'] . ' ' . $data['last_name']) . '
                    </td>
                </tr>
                <tr>
                    <td style="padding: 15px; background-color: #f9f9f9; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: ' . TEXT_COLOR . ';">
                        Email
                    </td>
                    <td style="padding: 15px; border-bottom: 1px solid #e0e0e0;">
                        <a href="mailto:' . htmlspecialchars($data['email']) . '" style="color: ' . ACCENT_COLOR . '; text-decoration: none;">
                            ' . htmlspecialchars($data['email']) . '
                        </a>
                    </td>
                </tr>
                <tr>
                    <td style="padding: 15px; background-color: #f9f9f9; border-bottom: 1px solid #e0e0e0; font-weight: 600; color: ' . TEXT_COLOR . ';">
                        Company/Level
                    </td>
                    <td style="padding: 15px; border-bottom: 1px solid #e0e0e0; color: ' . TEXT_COLOR . ';">
                        ' . htmlspecialchars($data['company']) . '
                    </td>
                </tr>
                <tr>
                    <td style="padding: 15px; background-color: #f9f9f9; font-weight: 600; color: ' . TEXT_COLOR . ';">
                        Inquiry Type
                    </td>
                    <td style="padding: 15px; color: ' . TEXT_COLOR . ';">
                        ' . htmlspecialchars($data['inquiry_type']) . '
                    </td>
                </tr>
            </table>
            
            <!-- Action Button -->
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 25px 0;">
                <tr>
                    <td style="border-radius: 6px; background-color: ' . ACCENT_COLOR . ';">
                        <a href="mailto:' . htmlspecialchars($data['email']) . '" style="display: inline-block; padding: 14px 30px; font-size: 16px; color: #ffffff; text-decoration: none; font-weight: 600;">
                            Reply to ' . htmlspecialchars($data['first_name']) . '
                        </a>
                    </td>
                </tr>
            </table>
            
            <p style="margin: 20px 0 0 0; padding: 15px; background-color: #f0f8ff; border-left: 4px solid ' . ACCENT_COLOR . '; font-size: 14px; color: #666;">
                <strong>Quick tip:</strong> Respond within 1 hour for best conversion rates!
            </p>
        </td>
    </tr>
    ' . self::getFooter();
        
        return self::getBaseTemplate($content, 'New contact form submission from ' . $data['first_name']);
    }
    
    /**
     * User Confirmation Email - MAIN ROUTER
     * This is the method called by contact.php
     */
    public static function userConfirmation($data) {
        // Route to specific template based on inquiry type
        switch ($data['inquiry_type']) {
            case 'Mentorship':
                return self::mentorshipTemplate($data);
            case 'VIP Signals':
                return self::vipSignalsTemplate($data);
            case 'Copy Trading':
                return self::copyTradingTemplate($data);
            case 'Bootcamp':
                return self::bootcampTemplate($data);
            case 'Partnership':
                return self::partnershipTemplate($data);
            default:
                return self::genericTemplate($data);
        }
    }
    
    /**
     * Mentorship Template
     */
    private static function mentorshipTemplate($data) {
        $content = self::getHeader() . '
    <tr>
        <td class="mobile-padding" style="padding: 40px 30px;">
            <h2 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 24px; font-weight: 700;">
                Welcome to Your Trading Journey! 🎯
            </h2>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Hi ' . htmlspecialchars($data['first_name']) . ',
            </p>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Thank you for your interest in our <strong>Lifetime Mentorship Program</strong>! We\'re excited to help you master forex trading.
            </p>
            
            <div style="padding: 20px; background-color: ' . LIGHT_BG . '; border-left: 4px solid ' . ACCENT_COLOR . '; border-radius: 4px; margin: 25px 0;">
                <h3 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 18px;">What\'s Included:</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: ' . TEXT_COLOR . '; line-height: 1.8;">
                    <li>One-on-one personalized coaching</li>
                    <li>Lifetime access to all course materials</li>
                    <li>Weekly live trading sessions</li>
                    <li>24/7 support community</li>
                    <li>Trading psychology & risk management</li>
                    <li>Real-time trade analysis</li>
                </ul>
            </div>
            
            <p style="margin: 25px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Our team will reach out within 24 hours to schedule your onboarding call and get you started on the path to consistent profitability.
            </p>
            
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 30px 0;">
                <tr>
                    <td style="border-radius: 6px; background-color: ' . ACCENT_COLOR . ';">
                        <a href="' . SITE_URL . '/mentorship" style="display: inline-block; padding: 14px 30px; font-size: 16px; color: #ffffff; text-decoration: none; font-weight: 600;">
                            Learn More About Mentorship
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ' . self::getFooter();
        
        return self::getBaseTemplate($content, 'Your mentorship inquiry has been received!');
    }
    
    /**
     * VIP Signals Template
     */
    private static function vipSignalsTemplate($data) {
        $content = self::getHeader() . '
    <tr>
        <td class="mobile-padding" style="padding: 40px 30px;">
            <h2 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 24px; font-weight: 700;">
                Get Ready for Premium Signals! 📊
            </h2>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Hi ' . htmlspecialchars($data['first_name']) . ',
            </p>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Thank you for your interest in our <strong>Lifetime VIP Signals</strong>! We deliver high-probability trade setups directly to you.
            </p>
            
            <div style="padding: 20px; background-color: ' . LIGHT_BG . '; border-left: 4px solid ' . ACCENT_COLOR . '; border-radius: 4px; margin: 25px 0;">
                <h3 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 18px;">Signal Features:</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: ' . TEXT_COLOR . '; line-height: 1.8;">
                    <li>3-5 high-quality signals daily</li>
                    <li>Entry, stop loss, and take profit levels</li>
                    <li>Risk-reward ratio analysis</li>
                    <li>Real-time notifications via Telegram</li>
                    <li>70-85% average win rate</li>
                    <li>Detailed trade explanations</li>
                </ul>
            </div>
            
            <p style="margin: 25px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                We\'ll contact you soon to set up your VIP signals access and add you to our exclusive Telegram channel.
            </p>
            
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 30px 0;">
                <tr>
                    <td style="border-radius: 6px; background-color: ' . ACCENT_COLOR . ';">
                        <a href="' . SITE_URL . '/pricing" style="display: inline-block; padding: 14px 30px; font-size: 16px; color: #ffffff; text-decoration: none; font-weight: 600;">
                            View Pricing
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ' . self::getFooter();
        
        return self::getBaseTemplate($content, 'Your VIP Signals inquiry has been received!');
    }
    
    /**
     * Copy Trading Template
     */
    private static function copyTradingTemplate($data) {
        $content = self::getHeader() . '
    <tr>
        <td class="mobile-padding" style="padding: 40px 30px;">
            <h2 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 24px; font-weight: 700;">
                Automated Trading Made Simple! 💹
            </h2>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Hi ' . htmlspecialchars($data['first_name']) . ',
            </p>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Thank you for your interest in our <strong>Copy Trading Service</strong>! Let professionals trade for you while you focus on other things.
            </p>
            
            <div style="padding: 20px; background-color: ' . LIGHT_BG . '; border-left: 4px solid ' . ACCENT_COLOR . '; border-radius: 4px; margin: 25px 0;">
                <h3 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 18px;">Copy Trading Benefits:</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: ' . TEXT_COLOR . '; line-height: 1.8;">
                    <li>Replicate trades from professional traders</li>
                    <li>Fully automated - no manual intervention needed</li>
                    <li>Transparent performance tracking</li>
                    <li>Flexible risk settings</li>
                    <li>Start with any account size</li>
                </ul>
            </div>
            
            <p style="margin: 25px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                We\'ll reach out within 24 hours to set up your copy trading account and walk you through the process.
            </p>
            
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 30px 0;">
                <tr>
                    <td style="border-radius: 6px; background-color: ' . ACCENT_COLOR . ';">
                        <a href="' . SITE_URL . '" style="display: inline-block; padding: 14px 30px; font-size: 16px; color: #ffffff; text-decoration: none; font-weight: 600;">
                            Learn More
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ' . self::getFooter();
        
        return self::getBaseTemplate($content, 'Your Copy Trading inquiry has been received!');
    }
    
    /**
     * Bootcamp Template
     */
    private static function bootcampTemplate($data) {
        $content = self::getHeader() . '
    <tr>
        <td class="mobile-padding" style="padding: 40px 30px;">
            <h2 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 24px; font-weight: 700;">
                Ready to Transform Your Trading? 🎓
            </h2>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Hi ' . htmlspecialchars($data['first_name']) . ',
            </p>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Thank you for your interest in our <strong>Intensive Trading Bootcamp</strong>! Get ready for an immersive learning experience.
            </p>
            
            <div style="padding: 20px; background-color: ' . LIGHT_BG . '; border-left: 4px solid ' . ACCENT_COLOR . '; border-radius: 4px; margin: 25px 0;">
                <h3 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 18px;">Bootcamp Highlights:</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: ' . TEXT_COLOR . '; line-height: 1.8;">
                    <li>Comprehensive forex trading curriculum</li>
                    <li>Live trading sessions with expert traders</li>
                    <li>Hands-on practice with real market conditions</li>
                    <li>Risk management and psychology training</li>
                    <li>Certificate of completion</li>
                    <li>Lifetime access to course materials</li>
                </ul>
            </div>
            
            <p style="margin: 25px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Our team will contact you with bootcamp schedules, pricing, and enrollment details.
            </p>
            
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 30px 0;">
                <tr>
                    <td style="border-radius: 6px; background-color: ' . ACCENT_COLOR . ';">
                        <a href="' . SITE_URL . '" style="display: inline-block; padding: 14px 30px; font-size: 16px; color: #ffffff; text-decoration: none; font-weight: 600;">
                            View Bootcamp Details
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ' . self::getFooter();
        
        return self::getBaseTemplate($content, 'Your Bootcamp inquiry has been received!');
    }
    
    /**
     * Partnership Template
     */
    private static function partnershipTemplate($data) {
        $content = self::getHeader() . '
    <tr>
        <td class="mobile-padding" style="padding: 40px 30px;">
            <h2 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 24px; font-weight: 700;">
                Let\'s Build Something Great Together! 🤝
            </h2>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Hi ' . htmlspecialchars($data['first_name']) . ',
            </p>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Thank you for your interest in partnering with <strong>Richie Forex Trading Academy</strong>! We\'re always looking for strategic partnerships to expand our reach and impact.
            </p>
            
            <div style="padding: 20px; background-color: ' . LIGHT_BG . '; border-left: 4px solid ' . ACCENT_COLOR . '; border-radius: 4px; margin: 25px 0;">
                <h3 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 18px;">Partnership Opportunities:</h3>
                <ul style="margin: 10px 0; padding-left: 20px; color: ' . TEXT_COLOR . '; line-height: 1.8;">
                    <li>Affiliate program with competitive commissions</li>
                    <li>White-label solutions</li>
                    <li>Co-branded educational content</li>
                    <li>Enterprise training programs</li>
                    <li>Strategic collaborations</li>
                </ul>
            </div>
            
            <p style="margin: 25px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                A member of our partnership team will reach out to discuss how we can work together to achieve mutual success.
            </p>
            
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 30px 0;">
                <tr>
                    <td style="border-radius: 6px; background-color: ' . ACCENT_COLOR . ';">
                        <a href="' . SITE_URL . '/about" style="display: inline-block; padding: 14px 30px; font-size: 16px; color: #ffffff; text-decoration: none; font-weight: 600;">
                            Learn About Us
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ' . self::getFooter();
        
        return self::getBaseTemplate($content, 'Your Partnership inquiry has been received!');
    }

    /**
     * Generic Template (fallback)
     */
    private static function genericTemplate($data) {
        $content = self::getHeader() . '
    <tr>
        <td class="mobile-padding" style="padding: 40px 30px;">
            <h2 style="margin: 0 0 10px 0; color: ' . PRIMARY_COLOR . '; font-size: 24px; font-weight: 700;">
                Thank You for Reaching Out! ✉️
            </h2>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Hi ' . htmlspecialchars($data['first_name']) . ',
            </p>
            
            <p style="margin: 0 0 20px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                Thank you for contacting <strong>Richie Forex Trading Academy</strong>! We\'ve received your inquiry and our team will review it shortly.
            </p>
            
            <div style="padding: 20px; background-color: ' . LIGHT_BG . '; border-left: 4px solid ' . ACCENT_COLOR . '; border-radius: 4px; margin: 25px 0;">
                <p style="margin: 0; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                    <strong>What you can expect:</strong><br>
                    Our team typically responds within 24 hours during business days. We\'ll get back to you as soon as possible to address your inquiry.
                </p>
            </div>
            
            <p style="margin: 25px 0; font-size: 16px; color: ' . TEXT_COLOR . '; line-height: 1.6;">
                In the meantime, feel free to explore our website to learn more about our services and trading resources.
            </p>
            
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin: 30px 0;">
                <tr>
                    <td style="border-radius: 6px; background-color: ' . ACCENT_COLOR . ';">
                        <a href="' . SITE_URL . '" style="display: inline-block; padding: 14px 30px; font-size: 16px; color: #ffffff; text-decoration: none; font-weight: 600;">
                            Visit Our Website
                        </a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    ' . self::getFooter();
        
        return self::getBaseTemplate($content, 'We\'ve received your message!');
    }
}