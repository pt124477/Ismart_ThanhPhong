<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//Create an instance; passing `true` enables exceptions
function send_mail($send_to_mail ,$send_to_fullname, $subject, $content, $option = array()){
    global $config;
    $config_mail = $config['email'];
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $config_mail['smtp_host'];                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $config_mail['smtp_user'];                     //SMTP username
        $mail->Password   = $config_mail['smtp_pass'];                               //SMTP password
        $mail->SMTPSecure = $config_mail['smtp_secure'];            //Enable implicit TLS encryption
        $mail->Port       = $config_mail['smtp_port'];                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->CharSet = "UTF-8";
        //Recipients
        $mail->setFrom($config_mail['smtp_user'], $config_mail['smtp_user']); //mail người giửi  , tiêu đề
        $mail->addAddress($send_to_mail, $send_to_fullname);  // mail người nhận, tiêu đề 
        //$mail->addAddress('windlaptrrinh.vn@gmail.com');               //Name is optional
        $mail->addReplyTo($config_mail['smtp_user'], $config_mail['smtp_user']);
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject; // tiêu dề của mail
        $mail->Body    = $content; //Nội dung content 
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        echo 'Giửi mail thành công';
    } catch (Exception $e) {
        echo "Gửi thất bại. Kiểm tra lỗi: {$mail->ErrorInfo}";
    }
}


?>