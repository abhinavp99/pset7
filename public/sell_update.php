<?php
    require("../includes/config.php"); 
    
    // print("Shares: " . $_POST["no_shares"]);
    // print("Shares: " . $_POST["symbol"]. "<br>");

    
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        
        $stock = lookup($_POST["symbol"]);
        $shares = CS50::query("SELECT Shares FROM portfolios WHERE user_id= ? AND Stock = ?", $_SESSION["id"], $stock["symbol"]);
        $value = $stock["price"] * $shares[0]["Shares"];
        
        // print("Shares: " . $stock["symbol"]. "<br>");
        // print("Shares: " . $stock["price"]. "<br>");
        //print("Shares: " . $shares[0]["Shares"]. "<br>");


        if($_POST["no_shares"] > $shares[0]["Shares"])
        {
            apologize("You don't have enough shares to sell!");
        }
        elseif($_POST["no_shares"] == $shares[0]["Shares"])
        {
            CS50::query("DELETE FROM portfolios WHERE user_id = ? AND Stock = ?", $_SESSION["id"], $stock["symbol"]);
            $test = CS50::query("UPDATE users SET Cash = Cash + ? WHERE id = ?", $value, $_SESSION["id"]);
            if($test == false)
            {
                apologize("error");
            }
        }
        else
        {
            $test1 = CS50::query("UPDATE portfolios SET Shares = Shares - ? WHERE user_id = ? AND Stock=  ?",$_POST["no_shares"], $_SESSION["id"], $stock["symbol"]);
            $test2 = CS50::query("UPDATE users SET Cash = Cash + ? WHERE id = ?", $value, $_SESSION["id"]);
            if($test2 == false)
            {
                apologize("error");
            }
        }
        $string = strtolower($stock["symbol"]);
        CS50::query("INSERT INTO history (user_id, transaction, symbol, Shares, Price) VALUES(?, ?, ?, ?, ?)",
        $_SESSION["id"],"SELL" ,$string, $_POST["no_shares"], $value);
        redirect("/");
    }
    
?>