<?php

$rand = rand(1000, 9999);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $captcha = $_POST['captcha'];
    $captcha_rand = $_POST['captcha-rand'];

    if ($captcha == $captcha_rand) {

        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/SMTP.php';
        require 'PHPMailer/src/PHPMailer.php';

        $to = $email;

        $subject = 'Contact Us Mail';
        $message = 'Message: ' . $message;
        $headers = 'From: ghevariyadevang123@gmail.com';

        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->IsSMTP();                    
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ghevariyadevang123@gmail.com';
        $mail->Password = 'orwkvhenvsdelduw';
        $mail->SMTPSecure = 'TLS';
        $mail->Port = 587;

        $mail->setFrom('ghevariyadevang123@gmail.com', 'Devang');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $message;

       
        if ($mail->send()) {
            $success_message = "Message has been sent successfully";
        } else {
            $error_message = "Message could not be sent.";
        }

    } else {
        $error_message = "Enter valid captcha";
    }
}

?> 



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .contact-form {
            margin: 100px auto;
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }

        .contact-form h2 {
            text-align: center;
        }

        .contact-form .form-control {
            margin-bottom: 15px;
        }

        .contact-form .btn {
            width: 100%;
        }

        .contact-form .text-danger {
            color: red;
        }

        /* Captcha Styles */
        .captcha-container {
            display: flex;
            align-items: center;
        }

        .captcha {
            font-size: 18px;
            font-weight: bold;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-radius: 20px;
            min-width: 80px;
            text-align: center;
            margin-left: auto;
            margin-bottom: 10px;
        }

        .refresh-captcha {
            margin-left: 10px;
            margin-bottom: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="contact-form">
                    <?php if (isset($error_message)): ?>
                        <p class="text-danger">
                            <?php echo $error_message; ?>
                        </p>
                    <?php endif; ?>
                    <?php if (isset($success_message)): ?>
                        <p class="text-success">
                            <?php echo $success_message; ?>
                        </p>
                    <?php endif; ?>

                    <form action="Devang_Ghevariya.php" method="post" id="contactForm">

                        <div class="form-group">
                            <label for="username">Name:</label><i class="fa fa-user" aria-hidden="true"></i>
                            <div class="input-group">
                                
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email:</label><i class="fa fa-envelope" aria-hidden="true"></i>
                            <div class="input-group">
                               
                                <input type="email" id="email" name="email" placeholder="Enter Email"
                                    class="form-control" required>
                            </div>
                        </div>

                        <div class="captcha-container">
                            <label for="captcha">Enter The Captcha:</label>
                            <div class="captcha">
                                <?php echo $rand; ?>
                            </div>
                            <span class="refresh-captcha" onclick="refreshCaptcha()">
                                <i class="fa fa-refresh" aria-hidden="true"></i>
                            </span>
                        </div>

                        <input type="hidden" name="captcha-rand" value="<?php echo $rand; ?>">

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Captcha" size="4" name="captcha"
                                id="captcha" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea id="message" name="message" class="form-control" required></textarea>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function refreshCaptcha() {
            var rand = Math.floor(Math.random() * (9999 - 1000 + 1)) + 1000;
            document.querySelector('.captcha').textContent = rand;
            document.querySelector('input[name="captcha-rand"]').value = rand;
        }

        document.getElementById("contactForm").addEventListener("submit", function (event) {
            const email = document.getElementById("email").value;
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert("Please enter a valid email address.");
                event.preventDefault();
            }
        });

    </script>


</body>

</html>