<?php
        // Töötab ainult LOCALHOSTis või web serveris
        //Autor: https://github.com/PHPMailer/PHPMailer

        
        // muutujad
        $name = $_POST['name'];
        $email = $_POST['email'];
        $ala = $_POST['alad'];

        //Võtab vajalikud PHPMaileri klassid
        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        require "vendor/SMTP/SMTP.php";
        require "vendor/SMTP/PHPMailer.php";
        require "vendor/SMTP/Exception.php";

        //Loob uue objekti, "true väärtus lubab erandeid"
        $mail = new PHPMailer(true);

        try {
            //Serveri seaded
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //DEBUG mood
            $mail->isSMTP();                                            //Kasutab SMTP protokolli
            $mail->Host       = 'smtp.gmail.com';                     //mis domeeni kasutab ".gmail"
            $mail->SMTPAuth   = true;                                   //Lubab SMTP autentimise    ????
            $mail->Username   = 'koiksonjaanus.confirm@gmail.com';                     //SMTP kasutajanimi   "kasutajanimi ja parool on gmaili omad mille alt saadab"
            $mail->Password   = 'oegtifxzmfhgmhvg';                               //SMTP parool
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Mis šifreeringut kasutab
            $mail->Port       = 465;                                    //Mis TCP porti kasutab

            //Recipients
            $mail->setFrom('koiksonjaanus.confirm@gmail.com');
            $mail->addAddress($email);                                  //Sõnumi saaja

            //Content
            $mail->isHTML(true);                                  //Seab emaili sisu HTML vormi (saad kirja vormindada HTML syntaxi kasutades)
            $mail->Subject = 'Registreerimise kinnitus';
            $mail->Body    = 'Tere ' . $nimi . '. Olete registreerinud ennast alale' . $ala . '. Oma reserveeringu tühistamiseks võtke ühendust korraldajatega. Täpsema info leiate meie veebilehelt';


            $mail->send();
            //Sõnumi saates värskendab lehe
            header('Location:teineleht.html');
        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";       //kui meili saatmine ebaõnnestus siis kuvab errori teate.
        }
        ?>