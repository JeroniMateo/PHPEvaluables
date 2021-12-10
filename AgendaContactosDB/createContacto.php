<?php

// include database and object files
include_once 'config/database.php';
include_once 'objects/contacto.php';

  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// pass connection to objects
$contacto = new Contacto($db);

// set page headers
$page_title = "Añadir contacto";
include_once "layout_header.php";
  
// contents will be here
echo "<div class='right-button-margin'>
<a href='index.php' class='btn btn-default pull-right'>Read Contacts</a>
</div>";

?>
<!-- 'create contact' html form will be here -->
<!-- PHP post code will be here -->
<?php 
// if the form was submitted - PHP OOP CRUD Tutorial
if($_POST){
  
    // set contact property values
    $contacto->id = $_POST['id'];
    $contacto->nombre = $_POST['nombre'];
    $contacto->telefono = $_POST['telefono'];
    
  
    // create the contact
    if($contacto->create()){
        echo "<div class='alert alert-success'>Contact was created.</div>";
    }
  
    // if unable to create the contact, tell the user
    else{
        echo "<div class='alert alert-danger'>Unable to create contact.</div>";
    }
}
?>
  
<!-- HTML form for creating a contact -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  
    <table class='table table-hover table-responsive table-bordered'>
  
        <tr>
            <td>Id</td>
            <td><input type='text' name='id' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Nombre</td>
            <td><input type='text' name='nombre' class='form-control' /></td>
        </tr>
  
        <tr>
            <td>Telefono</td>
            <td><textarea name='telefono' class='form-control'></textarea></td>
        </tr>
  
        
  


            </td>
        </tr>
  
        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>
  
    </table>
</form>
<?php
// footer
include_once "layout_footer.php";
?>