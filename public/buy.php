<?php
    require("../includes/config.php"); 
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("buy_form.php", ["title" => "Buy"]); 
    }
    elseif($_SERVER["REQUEST_METHOD"] =="POST")
    {
        $_POST["symbol"] = strtolower($_POST["symbol"]);
        $set = isset($_POST["symbol"]);
        if($set == false)
        {
            apologize("Please Select Stock!");
        }
        $set = isset($_POST["no_shares"]);
        if($set == false)
        {
            apologize("Please Select Stock!");
        }
        $stock = lookup($_POST["symbol"]);
        if($stock == false)
        {
            apologize("Enter Valid Stock");
        }
        $transaction = $stock["price"] * $_POST["no_shares"];
        $rows = CS50::query("SELECT Cash FROM users WHERE id = ?", $_SESSION["id"]);
        if($rows[0]["Cash"] < $transaction)
        {
            apologize("You don't have enough cash!");
        }
        $string = strtolower($stock["symbol"]);
        CS50::query("UPDATE users SET Cash = Cash - ? WHERE id = ?", $transaction, $_SESSION["id"]);
        CS50::query("INSERT INTO portfolios (user_id, Stock, Shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + ?",
        $_SESSION["id"], $_POST["symbol"], $_POST["symbol"], $_POST["no_shares"]);
        CS50::query("INSERT INTO history (user_id, transaction, symbol, Shares, Price) VALUES(?, ?, ?, ?, ?)",
        $_SESSION["id"],"BUY" ,$string, $_POST["no_shares"], $transaction);
        redirect("/");
    }

    
?>