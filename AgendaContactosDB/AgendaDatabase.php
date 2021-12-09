<?php


require("database.php");

$database = new Database();
$db = $database->getConnection();

$showAgenda = $db->query("select * from agenda");
$nombre = $_POST['name'];
$telefono = $_POST['telf'];
$showAgenda =  $db->query('insert into agenda(nombre,telefono) values ($nombre,$telefono) ');

echo "<table> <th> Agenda de Contactos </th>";
foreach ($showAgenda as $row) {
    echo "<tr> <td>" .  $row['nombre'] . "</td>" ;
   
    echo "<td>" . $row['telefono'] .  "</td></tr>";
}
echo "</table>"


?>
<form action="agendacheck.php" method="POST">
    <label>Nombre:<input type="text" name="name"   /></label><br />
    <label>Teléfono:<input type="number" name="telf"  /></label><br />
    <input type="submit" name='submit' value="Ejecutar" /><br />
</form>

