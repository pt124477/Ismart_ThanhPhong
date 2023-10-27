<?php
function send_mail($to, $subject, $message, $headers = "") {
    $to = trim($to);
    $subject = trim($subject);
    $message = trim($message);
    $headers = trim($headers);

    if (empty($to) || empty($subject) || empty($message)) {
        // Trả về một mã lỗi hoặc thông báo lỗi nếu dữ liệu không hợp lệ
        return "Invalid data. Please provide valid email details.";
    }

    if (empty($headers)) {
        $headers = "From: your_email@example.com\r\n";
        $headers .= "Reply-To: your_email@example.com\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n";
    }

    // Nếu các tham số hợp lệ, trả về true nếu gửi email thành công, ngược lại trả về false
    return mail($to, $subject, $message, $headers);
}

// Sử dụng hàm send_mail() để gửi email và kiểm tra kết quả
$to = "recipient@example.com";
$subject = "Test Email";
$message = "<p>This is a test email sent from the PHP script.</p>";
$headers = "From: sender@example.com\r\n";
$headers .= "Reply-To: sender@example.com\r\n";
$headers .= "Content-type: text/html; charset=utf-8\r\n";

$result = send_mail($to, $subject, $message, $headers);
if ($result === true) {
    echo "Email has been sent successfully.";
} else {
    echo "Failed to send the email. Error: " . $result;
}
?>
