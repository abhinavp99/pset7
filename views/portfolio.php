<?php
print('<table align = "center">');
print('<tr><th>Stock</th><th>Shares</th><th>Price</th> <th>Total</th></tr>');
$cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
$total = number_format($cash[0]["cash"], 2);
print('<tr>');
print('<td> <div id = "cash">CASH<td></div> <td></td>');
print('<td><div id= "cash">$ '. $total. ' </td> </div>');
print("</tr>");
$rows = CS50::query("SELECT Stock, Shares FROM portfolios WHERE user_id = ?", $_SESSION["id"]);
foreach($rows as $row)
{
    $stock = lookup($row["Stock"]);
    $value = $row["Shares"] * $stock["price"];
    $cost = number_format($stock["price"], 2);
    $value = number_format($value, 2);
    print("<tr>");
    print("<td> {$stock["name"]} ({$stock["symbol"]}) </td>");
    print("<td>{$row["Shares"]} </td>");
    print("<td>$ {$cost} </td>");
    print("<td>$ {$value}</td>");
    print("</tr>");
}
print('</table>');
//print('<a href="password_reset.php"> Forgot Password?</a>');

?>