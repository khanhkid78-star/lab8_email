
<?php
//Nạp thư viện PHPMailer
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Tạo đối tượng gửi mail
$mail = new PHPMailer(true);

try {
    //Cấu hình SMTP Gmail
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;

    $nguoigui = 'khanhhv.25ite@vku.udn.vn';
    $matkhau = 'ogxy nvln nhrf rqwv';

    $mail->Username   = $nguoigui;
    $mail->Password   = $matkhau;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    //Khai báo người gửi và người nhận
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($nguoigui, 'Khánh');
    $mail->addAddress('khanhkid78@gmail.com', 'Người nhận');

    //Khai báo nội dung email
    $mail->isHTML(true);
    $mail->Subject = 'Email thử nghiệm Lab 8';
    $mail->Body = '<h3>Xin chào!</h3>
                   <p>Đây là email được gửi bằng PHP.</p>';
    $mail->AltBody = 'Xin chào! Đây là email được gửi bằng PHP.';

    $mail->send();
    echo 'Đã gửi email thành công!';

} catch (Exception $e) {
    echo 'Gửi email thất bại: ' . $mail->ErrorInfo;
}
?>
