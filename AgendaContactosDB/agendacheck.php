<?php
require("database.php");

$database = new Database();
$db = $database->getConnection();

$showAgenda = $db->query("select * from agenda");

echo "<table> <th> Agenda de Contactos </th>";
foreach ($showAgenda as $row) {
    echo "<tr> <td>" .  $row['nombre'] . "</td>" ;
   
    echo "<td>" . $row['telefono'] .  "</td></tr>";
}
echo "</table>"
?>