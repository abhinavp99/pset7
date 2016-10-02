<?php
        require("../views/header.php");
        $stock = lookup($_POST["symbol"]);
        if($stock == false)
        {
            apologize_alt("INCORRECT SYMBOL");

        }
        else
        {
            $cost = number_format($stock["price"], 2);
            print("<h1> <strong> Share: </strong> {$stock["name"]} ({$stock["symbol"]}) </h1> <br>" );
            print("<h1><strong> Price: </strong> $ {$cost}</h1>" );
        }

?>
    
    