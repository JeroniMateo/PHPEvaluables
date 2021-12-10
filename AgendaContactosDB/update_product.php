<?php
// retrieve one contact will be here
// get ID of the contact to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/contacto.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare objects
$contacto = new Contacto($db);

  
// set ID property of contact to be edited
$contacto->id = $id;
  
// read the details of contact to be edited
$contacto->readOne();
  
// set page header
$page_title = "Update Contact";
include_once "layout_header.php";
  
// contents will be here
echo "<div class='right-button-margin'>
          <a href='index.php' class='btn btn-default pull-right'>Read Contacts</a>
     </div>";
  
?>
<!-- 'update contact' form will be here -->
<!-- post code will be here -->
<?php 
// if the form was submitted
if($_POST){
  
    // set contact property values
    $contacto->id = $_POST['id'];
    $contacto->nombre = $_POST['nombre'];
    $contacto->telefono = $_POST['telefono'];

  
    // update the contacto
    if($contacto->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "contact was updated.";
        echo "</div>";
    }
  
    // if unable to update the contact, tell the user
    else{
        echo "<div class='alert alert-danger alert-dismissable'>";
            echo "Unable to update contact.";
        echo "</div>";
    }
}
?>

  
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>ID</td>
            <td><input type='text' name='id' value='<?php echo $contacto->id; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Nombre</td>
            <td><input type='text' name='nombre' value='<?php echo $contacto->nombre; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>telefono</td>
            <td><input name='telefono' class='form-control'><?php echo $contacto->telefono; ?></input></td>
        </tr>
  
          
        <tr>
            <td></td>
            <td>
                <butt type="submit" class="btn btn-primary">Update</butt  on>
            </td>
        </tr>
  
    </table>
    
</form>
<?
// the page where this paging is used
$page_url = "index.php?";
  
// count all contact in the database to calculate total pages
$total_rows = $contacto->countAll();
  
// paging buttons here
include_once 'paging.php';
// display the contact if there are any
if($num>0){
  
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>ID</th>";
            echo "<th>Nombre</th>";
            echo "<th>Telefono</th>";
            
        echo "</tr>";
  
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  
            extract($row);
  
            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$nombre}</td>";
                echo "<td>{$telefono}</td>";
               
  
                echo "<td>";
                        
                echo "</td>";
  
            echo "</tr>";
  
        }
  
    echo "</table>";
  
    // paging buttons will be here
}
  
// tell the user there are no contact
else{
    echo "<div class='alert alert-info'>No contact found.</div>";
}

  
// set page footer
include_once "layout_footer.php";
?>