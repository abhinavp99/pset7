<?php

    // configuration
    require("../includes/config.php");
    require("libphp-phpmailer/class.phpmailer.php");


    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
            //blank username or password
        if($_POST["username"] == ' ' || $_POST["password"] == ' ' || $_POST["email"] == '')
        {
            apologize("Do not leave username, password, or email empty");
        }
    
        //passwords don't match error
        if($_POST["password"] != $_POST["confirmation"])
        {
            apologize("Passwords do not match!");
        }
        

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
    $mail->Subject = "CS50 Finance"; // change to email's subject
    $mail->Body = "You have just registered for CS50 finance. Implementation by Abhinav Prasad."; // change to email's body, add the needed link here

    if ($mail->Send() == false)
    {
        apologize("Fail". $mail->ErrInfo);
    }
        $temp = CS50::query("INSERT IGNORE INTO users (username, hash, cash, Email) VALUES(?, ?, 10000.0000, ?)",
        $_POST["username"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["email"]);
        if($temp != 0)
        {
            $rows = CS50::query("SELECT LAST_INSERT_ID() AS id");
            $_SESSION["id"]= $rows[0]["id"];
            redirect("index.php");
        }
        else
        {
            apologize("Please enter a unique username!");
        }

    }

?>