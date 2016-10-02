<form method=post>
<fieldset>
  <div class="control-group">
  <select name="symbol" id= "so" action= "sell.php">
    <option value="" disabled selected>Select Symbol</option>
<?php
$options = CS50::query("SELECT Stock FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
foreach($options as $option)
{
  print("<option value =\"" . $option["Stock"] . "\">" . $option["Stock"]. '</option>');
}
?>
</select>
</div>
</form>
<br><br>
<div class="form-group">
            <button class="btn btn-default" type="submit">
                Sell Shares
            </button>
        </div>
</fieldset>

