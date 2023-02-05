<?php
include('includes/dbconnect.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;





if (isset($_POST['send_mail'])) {

    $recepient = $_POST['recepient'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];


    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'angelika.arenas@cvsu.edu.ph';                     //farroncafe22@gmail.com
        $mail->Password   = 'gpxpvkkfcywjhvxp';                               //farroncafe2022
        $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($recepient, 'farron');
        $mail->addAddress($recepient);     //Add a recipient
        $mail->addReplyTo('no-reply@farron.com', 'No reply');

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;


        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
include('includes/dbclose.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Request Ingredients</title>
</head>

<body>
    <div class="container">
        <form action="" method="post" class="px-5 py-4 mt-4">
            <img src="images/logo.png" alt="" class="img-fluid" style="width: 200px; margin: 2em;">
            <div class="d-flex justify-content-between mb-4">
                <a href="Dashboard.php" class="btn btn-primary"><i class="fas fa-arrow-left"></i></a>
                <h3 class="msg"></h3>
                <h4>Email</h4>
            </div>
            <div class="form-group row">
                <div class="mb-3 col-md-4">
                    <label for="recepient" class="form-label">Recepient:</label>
                    <input type="email" class="form-control input_fields" id="recepient" placeholder="Recepient"
                        name="recepient" autocomplete="off">
                </div>
                <div class="mb-3 col-md-4">
                    <label for="subject" class="form-label">Subject:</label>
                    <input type="text" class="form-control input_fields" id="subject" placeholder="Subject"
                        name="subject" autocomplete="off">
                </div>
                <div class="mb-3 col-md-8">
                    <label for="body">Message</label>
                    <textarea class="form-control" id="body" rows="5" style="resize: none;" name="body"></textarea>
                </div>
            </div>
            <input type="submit" class="btn btn-primary add" name="send_mail" id="send" value="Send Mail">
        </form>
    </div>


    <script src="https://kit.fontawesome.com/aa3ffaba25.js" crossorigin="anonymous"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>