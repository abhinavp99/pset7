<?php
print('<table align = "center">');
print('<tr><th>Transaction</th><th>Time</th><th>Symbol</th><th>Shares</th><th>Price</th></tr>');
$cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
$total = number_format($cash[0]["cash"], 2);
// print('<tr>');
// print('<td> <div id = "cash">CASH<td></div> <td></td>');
// print('<td><div id= "cash">$ '. $total. ' </td> </div>');
// print("</tr>");
$rows = CS50::query("SELECT * FROM history WHERE user_id = ?", $_SESSION["id"]);
foreach($rows as $row)
{
    $hist = lookup($row["symbol"]);
    $string = strtoupper($row["symbol"]);
    $cost = number_format($hist["price"], 2);
    $cost = number_format($cost, 2);
    print("<tr>");
    print("<td>{$row["transaction"]} </td>");
    print("<td>{$row["time"]}</td>");
    print("<td>{$string}</td>");
    print("<td>{$row["Shares"]}</td>");
    print("<td>$ {$cost}</td>");
    print("</tr>");
}
print('</table>');

?>