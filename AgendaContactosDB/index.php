<?php
// core.php holds pagination variables
include_once 'config/core.php';
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/contacto.php';

  
// instantiate database and contact object
$database = new Database();
$db = $database->getConnection();
  
$contacto = new Contacto($db);

  
$page_title = "Agenda Contactos";
include_once "layout_header.php";
  
// query contacts
$stmt = $contacto->readAll($from_record_num, $records_per_page);
  
// specify the page where paging is used
$page_url = "index.php?";
  
// count total rows - used for pagination
$total_rows=$contacto->countAll();
  
// read_template.php controls how the contact list will be rendered
include_once "read_template.php";
  
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>