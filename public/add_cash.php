<?php
    require("../includes/config.php"); 
    
     if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("cash.php", ["title" => "Cash"]);
    }
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {
        CS50::query("UPDATE users SET Cash = Cash + ? WHERE id = ?", $_POST["cash"], $_SESSION["id"]);
        redirect("/");
    }

?>