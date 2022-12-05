<?php
        // Töötab ainult LOCALHOSTis
        //Autor: https://github.com/PHPMailer/PHPMailer

        
        // Define variables
        $name = $_POST['name'];
        $email = $_POST['email'];
        //$subject = $_POST['subject'];
        //$message = $_POST['message'];
        $ala = $_POST['alad'];

        //Import PHPMailer classes into the global namespace
        //These must be at the top of your script, not inside a function
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        //Load Composer's autoloader
        require "vendor/SMTP/SMTP.php";
        require "vendor/SMTP/PHPMailer.php";
        require "vendor/SMTP/Exception.php";

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'koiksonjaanus.confirm@gmail.com';                     //SMTP username
            $mail->Password   = 'oegtifxzmfhgmhvg';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('koiksonjaanus.confirm@gmail.com');
            $mail->addAddress($email);                                  //Add a recipient

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Registreerimise kinnitus';
            $mail->Body    = 'Tere ' . $nimi . '. Olete registreerinud ennast alale' . $ala . '. Oma reserveeringu tühistamiseks võtke ühendust korraldajatega. Täpsema info leiate meie veebilehelt';


            $mail->send();
            //echo 'Message has been sent';
            header('Location:teineleht.html');
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        ?>