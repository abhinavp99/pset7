<?php
        $cur_stock = lookup($symbol);
        print("<h1>Stock: {$cur_stock["symbol"] }</h1>");
        $_POST["symbol"] = $symbol;
?>
<form action="sell_update.php" method="post">
    <fieldset>
        <div class="form-group">
            <input autocomplete="off" min="1" step="1" autofocus class="form-control" name="no_shares" placeholder="Enter Shares" type="number"/>
        </div>
        <div class="control-group">
         <?php 
          print("<select style = display:none name= \"symbol\" id= \"so\" value = \"". $symbol. "\"action= \"sell_update.php\">");
          print("<option value =\"" . $symbol . "\">" . $option["Stock"]. '</option>');
          ?>
          </select>
        </div>
        
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Sell
            </button>
        </div>
    </fieldset>
</form>