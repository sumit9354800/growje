<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Locate PHPMailer: try several common paths (project vendor, sibling, downloaded copy)
$phpMailerPaths = [
    __DIR__ . '/vendor/autoload.php',
    __DIR__ . '/../phpmailer/vendor/autoload.php',
    __DIR__ . '/../phpmailer/src/PHPMailer.php',
    'C:\\Users\\This\\Downloads\\PHPMailer-master\\phpmailer\\vendor\\autoload.php',
    'C:\\Users\\This\\Downloads\\PHPMailer-master\\phpmailer\\src\\PHPMailer.php',
];

$included = false;
foreach ($phpMailerPaths as $p) {
    if (file_exists($p)) {
        if (strpos($p, 'autoload.php') !== false) {
            require_once $p;
        } else {
            require_once dirname($p) . '/Exception.php';
            require_once dirname($p) . '/PHPMailer.php';
            require_once dirname($p) . '/SMTP.php';
        }
        $included = true;
        break;
    }
}

if (!$included) {
    $try1 = __DIR__ . '/phpmailer/src/PHPMailer.php';
    if (file_exists($try1)) {
        require_once __DIR__ . '/phpmailer/src/Exception.php';
        require_once __DIR__ . '/phpmailer/src/PHPMailer.php';
        require_once __DIR__ . '/phpmailer/src/SMTP.php';
        $included = true;
    }
}

if (!$included) {
    error_log('PHPMailer not found; checked paths: ' . implode(', ', $phpMailerPaths));
    header('Location: ../contact-us.html?error=phpmailer');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

// Sanitize and validate form data
$fullname = trim((string) filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$email = trim((string) filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
$phone = trim((string) filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
$message = trim((string) filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

if (empty($fullname) || empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
    header('Location: ../contact-us.html?error=validation');
    exit;
}

/* ================================================================
   ✅ DATABASE INSERT SECTION (AUTO-SAVES MESSAGE)
================================================================ */

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASS = "";
$DB_NAME = "growjedb";

// Create DB connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if (!$conn->connect_error) {
    // Prepare query
    $stmt = $conn->prepare("
        INSERT INTO growjetd (name, email, phone, message,date)
        VALUES (?, ?, ?, ?,CURDATE())
    ");

    if ($stmt) {
        $stmt->bind_param("ssss", $fullname, $email, $phone, $message);
        $stmt->execute();
        $stmt->close();
    } else {
        error_log("DB Prepare Failed: " . $conn->error);
    }

    $conn->close();
} else {
    error_log("DB Connection Failed: " . $conn->connect_error);
}

/* ================================================================
   END DATABASE SECTION
================================================================ */


// SMTP configuration
$smtpHost = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
$smtpUser = getenv('SMTP_USER') ?: 'sumit9354800@gmail.com';
$smtpPass = getenv('SMTP_PASS') ?: 'qjglbfgljerhxdiq';
$smtpSecure = getenv('SMTP_SECURE') ?: 'tls';
$smtpPort = (int) (getenv('SMTP_PORT') ?: 587);

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = $smtpHost;
    $mail->SMTPAuth = true;
    $mail->Username = $smtpUser;
    $mail->Password = $smtpPass;
    $mail->SMTPSecure = $smtpSecure;
    $mail->Port = $smtpPort;
    $mail->CharSet = 'UTF-8';

    $mail->SMTPOptions = [
        'ssl' => [
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true,
        ],
    ];

    $mail->setFrom($smtpUser, 'Website Contact');
    $mail->addAddress($smtpUser);

    if (!empty($email)) {
        $mail->addReplyTo($email, $fullname);
    }

    $mail->isHTML(true);
    $mail->Subject = "New Contact Message from " . $fullname;

    $safeName = htmlspecialchars($fullname, ENT_QUOTES);
    $safeEmail = htmlspecialchars($email, ENT_QUOTES);
    $safePhone = htmlspecialchars($phone, ENT_QUOTES);
    $safeMessage = nl2br(htmlspecialchars($message, ENT_QUOTES));

    $mail->Body = "
        <h2>New Contact Form Message</h2>
        <p><strong>Name:</strong> {$safeName}</p>
        <p><strong>Email:</strong> {$safeEmail}</p>
        <p><strong>Phone:</strong> {$safePhone}</p>
        <p><strong>Message:</strong><br>{$safeMessage}</p>
    ";

    $mail->AltBody = "Name: {$fullname}\nEmail: {$email}\nPhone: {$phone}\nMessage:\n{$message}";

    try {
        $mail->send();
        header('Location: ../contact-us.html?sent=1');
        exit;
    } catch (Exception $e1) {
        if (strtolower($smtpSecure) === 'tls' && $smtpPort === 587) {
            try {
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
                $mail->send();
                header('Location: ../contact-us.html?sent=1');
                exit;
            } catch (Exception $e2) {
                error_log('Mail retry error (ssl/465): ' . $e2->getMessage());
            }
        }
        error_log('Mail send error: ' . $e1->getMessage());
        header('Location: ../contact-us.html?error=send');
        exit;
    }

} catch (Exception $e) {
    error_log('Mail error: ' . $mail->ErrorInfo . ' Exception: ' . $e->getMessage());
    header('Location: ../contact-us.html?error=send');
    exit;
}
?>