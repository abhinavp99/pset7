<?php
    require("../includes/config.php");
     if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("enter_email.php", ["title" => "Email"]);
    }
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
    //$cash = CS50::query("SELECT email FROM users WHERE id = ?", $_SESSION["id"]);
    //$email = $cash[0]["Email"];

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com"; // change to your email host
    $mail->Port = 587; // change to your email port
    $mail->Username = "abhinavp99@gmail.com"; // change to your username
    $mail->Password = "P4family"; // change to your email password
    $mail->setFrom("abhinavp99@gmail.com"); // change to your email password
    $mail->AddAddress($_POST["email"]); // change to user's email address
    $mail->Subject = "CS50 Password Reset"; // change to email's subject
    $mail->Body = "Reset Password at https://ide50-abhi-nav.cs50.io/reset.php."; // change to email's body, add the needed link here

    if ($mail->Send() == false)
    {
        apologize("Fail". $mail->ErrInfo);
    }
    print("Email Sent!");
    }

?>