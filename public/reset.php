<?php
    require("../includes/config.php");
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("pass_reset.php", ["title" => "Reset"]);
    }
    
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
            //blank username or password
        if($_POST["password"] == ' '||$_POST["email"])
        {
            apologize("Do not leave password or email empty!");
        }
    
        //passwords don't match error
        if($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match!");
        }
       $rows =  CS50::query("SELECT id FROM users WHERE Email = ?", $_POST["email"]);
       $id = $rows[0]["id"];
        

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = "tls";
    $mail->Host = "smtp.gmail.com"; // change to your email host
    $mail->Port = 587; // change to your email port
    $mail->Username = "abhinavp99@gmail.com"; // change to your username
    $mail->Password = "P4family"; // change to your email password
    $mail->setFrom($_POST["email"]); // change to your email password
    $mail->AddAddress("abhinavp99@gmail.com"); // change to user's email address
    $mail->Subject = "Reset"; // change to email's subject
    $mail->Body = "Password Reset."; // change to email's body, add the needed link here

    if ($mail->Send() == false)
    {
        apologize("Fail". $mail->ErrInfo);
    }
    $pass = password_hash($_POST["password"], PASSWORD_DEFAULT);
    CS50::query("UPDATE users SET hash = ? WHERE id = ?", $pass, $id);
  

    }
)
?>