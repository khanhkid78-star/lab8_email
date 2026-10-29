
<?php
require __DIR__ . '/PHPMailer-master/src/Exception.php';
require __DIR__ . '/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('Vui lòng gửi email từ form.');
}


$to = trim($_POST['email'] ?? '');
$tieude = trim($_POST['tieude'] ?? '');
$content = $_POST['content'] ?? '';


if (!filter_var($to, FILTER_VALIDATE_EMAIL)
    || $tieude === ''
    || trim($content) === '') {
    exit('Vui lòng nhập email, tiêu đề và nội dung hợp lệ.');
}

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
    $mail->addAddress($to);

    
    $mail->isHTML(true);
    $mail->Subject = $tieude;

    
    $noidungthu = '<h3>Xin chào!</h3><p>'
                . nl2br(htmlspecialchars(
                    $content, ENT_QUOTES, 'UTF-8'
                  ))
                . '</p>';

    $mail->Body = $noidungthu;
    $mail->AltBody = $content;

    
    if (isset($_FILES['file'])
        && $_FILES['file']['error'] !== UPLOAD_ERR_NO_FILE) {

        if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception('Tải tệp lên thất bại.');
        }

        
        if ($_FILES['file']['size'] > 5 * 1024 * 1024) {
            throw new Exception('Tệp không được vượt quá 5 MB.');
        }

        if (is_uploaded_file($_FILES['file']['tmp_name'])) {
            $tenfile = basename($_FILES['file']['name']);

            $mail->addAttachment(
                $_FILES['file']['tmp_name'],
                $tenfile
            );
        }
    }

  
    $mail->send();
    echo 'Đã gửi email thành công!';

} catch (Exception $e) {
    echo 'Gửi email thất bại: ' . htmlspecialchars(
        $mail->ErrorInfo ?: $e->getMessage(),
        ENT_QUOTES,
        'UTF-8'
    );
}
?>
