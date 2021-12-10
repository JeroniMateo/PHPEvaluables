<?php
// check if value was posted
if($_POST){
  
    // include database and object file
    include_once 'config/database.php';
    include_once 'objects/product.php';
  
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
  
    // prepare contact object
    $contacto = new Contacto($db);
      
    // set contact id to be deleted
    $contacto->id = $_POST['object_id'];
      
    // delete the contact
    if($product->delete()){
        echo "Object was deleted.";
    }
      
    // if unable to delete the product
    else{
        echo "Unable to delete object.";
    }
}
?>