
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi email - Lab 8</title>
</head>
<body>
    <h2>Gửi email bằng PHPMailer</h2>

    <form action="mail.php"
          method="POST"
          enctype="multipart/form-data">

        <label>Email người nhận:</label><br>
        <input type="email" name="email"
               placeholder="recipient@gmail.com" required>
        <br><br>

        <label>Tiêu đề:</label><br>
        <input type="text" name="tieude"
               placeholder="Nhập tiêu đề" required>
        <br><br>

        <label>Nội dung:</label><br>
        <textarea name="content" rows="6"
                  placeholder="Nhập nội dung email"
                  required></textarea>
        <br><br>

        <label>Tệp đính kèm:</label><br>
        <input type="file" name="file">
        <br><br>

        <button type="submit">Gửi email</button>
    </form>
</body>
</html>
