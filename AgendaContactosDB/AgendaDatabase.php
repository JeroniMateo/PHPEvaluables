
<!--Tenemos un formulario  de donde sacaremos los contactos de la agenda-->
<form  method="POST">
    <label>Nombre:<input type="text" name="nombre"   /></label><br />
    <label>Teléfono:<input type="number" name="telefono"  /></label><br />
    <input type="submit" name='submit' value="Ejecutar" /><br />
</form>


<?php

/**
 * Llamamos a la base de datos que hemos creado en "database.php
 * y creamos la conexion con la misma
 * */
require("database.php");
$database = new Database();
$db = $database->getConnection();

//mostramos los valores que hay dentro de la tabla agenda
$showAgenda = $db->query("select * from agenda");


//Cramos la query insert para insertar dichos valores de los intputs en la base de datos
$showAgenda =  $db->query('insert into agenda(nombre,telefono) values (:nombre,:telefono) ');

//Cogemos los valores que tenemos dentro de los inputs del fromulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];

$showAgenda -> bindParam(":nombre",$nombre);
$showAgenda -> bindParam(":telefono", $telefono);
//Finalmente impimimos todos los valores dentro de la tabla de agenda
echo "<table> <th> Agenda de Contactos </th>";
foreach ($showAgenda as $row) {
    echo "<tr> <td>" .  $row['nombre'] . "</td>" ;
   
    echo "<td>" . $row['telefono'] .  "</td></tr>";
}
echo "</table>"


?>


