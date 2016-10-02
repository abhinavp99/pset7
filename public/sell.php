<?php
    require("../includes/config.php"); 
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("sell_form.php", ["title" => "Sell"]);
    }
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {   
       $set = isset($_POST["symbol"]);
       if($set == false)
       {
           apologize("Please Select Stock!");
       }
        else
        {
        render("sell_choice.php", ["symbol" => $_POST["symbol"]]);
        }
    }
?>