<?php
// get ID of the contact to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/contacto.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare objects
$contacto = new Contacto($db);

  
// set ID property of contact to be read
$contacto->id = $id;
  
// read the details of contact to be read
$contacto->readOne();

// set page headers
$page_title = "Read One Contact";
include_once "layout_header.php";
  
// read contact button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read Contacts";
    echo "</a>";
echo "</div>";
// HTML table for displaying a contact details
echo "<table class='table table-hover table-responsive table-bordered'>";
  
    echo "<tr>";
        echo "<td>ID</td>";
        echo "<td>{$contacto->id}</td>";
    echo "</tr>";
  
  
    echo "<tr>";
        echo "<td>Nombre</td>";
        echo "<td>{$contacto->nombre}</td>";
    echo "</tr>";
  
    echo "<tr>";
        echo "<td>Telefono</td>";
        echo "<td>{$contacto->telefono}</td>";
    echo "</tr>";
  

  
echo "</table>";
  
// set footer
include_once "layout_footer.php";
?>