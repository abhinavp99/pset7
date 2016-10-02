<?php
    
    require("../includes/config.php"); 
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Get Quote"]);
    }
    elseif($_SERVER["REQUEST_METHOD"] == "POST")
    {

        $stock = lookup($_POST["symbol"]);

        render_alt("quote_dis.php", ["title" => "Quote", "stock" => $stock]);

    }
    render("footer.php");
?>
