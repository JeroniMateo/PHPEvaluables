<?php

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
  

echo "<div class='right-button-margin'>
          <a href='index.php' class='btn btn-default pull-right'>Read Contacts</a>
     </div>";
  
?>


<?php 
// if the form was submitted
if($_POST){
  
    // set contact property values
    $contacto->id = $_POST['id'];
    $contacto->nombre = $_POST['nombre'];
    $contacto->telefono = $_POST['telefono'];
  
    // update the contact
    if($contacto->update()){
        echo "<div class='alert alert-success alert-dismissable'>";
            echo "Contact was updated.";
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
            <td><input type='text' name='price' value='<?php echo $contacto->nombre; ?>' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Telefono</td>
            <td><input name='description' class='form-control'><?php echo $contacto->telefono; ?></input></td>
        </tr>
    
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>
  
    </table>
</form>
  <?php
// set page footer
include_once "layout_footer.php";
?>