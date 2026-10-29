
<?php
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$recipients = "khanhkid78@gmail.com,khanhkid78@gmail.com,khanhkid78@gmail.com";


$email_array = explode(",", $recipients);


$mail = new PHPMailer(true);

try {
  
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $nguoigui = 'khanhhv.25ite@vku.udn.vn';
    $matkhau = 'ogxy nvln nhrf rqwv';

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->CharSet = 'UTF-8';
    $mail->setFrom($nguoigui, 'Khánh');
    $mail->isHTML(true);

    
    $mail->Subject = 'Thông báo';
    $mail->Body = '<h3>Xin chào!</h3>
                   <p>Đây là email gửi từ bài thực hành 3.</p>';
    $mail->AltBody = 'Đây là email gửi từ bài thực hành 3.';

    $success = 0;
    $failed = 0;

    
    foreach ($email_array as $email) {
        $email = trim($email);

      
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Email không hợp lệ: '
                 . htmlspecialchars($email) . '<br>';
            $failed++;
            continue;
        }

        try {
            
            $mail->clearAddresses();

            
            $mail->addAddress($email);

        
            $mail->send();

            echo 'Đã gửi đến: '
                 . htmlspecialchars($email) . '<br>';
            $success++;

        } catch (Exception $e) {
            echo 'Gửi thất bại đến: '
                 . htmlspecialchars($email) . '<br>';
            $failed++;
        }
    }

    echo '<hr>';
    echo 'Gửi thành công: ' . $success . '<br>';
    echo 'Gửi thất bại: ' . $failed;

} catch (Exception $e) {
    echo 'Lỗi cấu hình SMTP: ' . htmlspecialchars(
        $mail->ErrorInfo
    );
}
?>
