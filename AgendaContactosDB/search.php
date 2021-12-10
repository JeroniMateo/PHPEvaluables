<?php
// core.php holds pagination variables
include_once 'config/core.php';
  
// include database and object files
include_once 'config/database.php';
include_once 'objects/contacto.php';

  
// instantiate database and contacto object
$database = new Database();
$db = $database->getConnection();
  
$contacto = new Contacto($db);
  
// get search term
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
  
$page_title = "You searched for \"{$search_term}\"";
include_once "layout_header.php";
  
// query contacto
$stmt = $contacto->search($search_term, $from_record_num, $records_per_page);
  
// specify the page where paging is used
$page_url="search.php?s={$search_term}&";
  
// count total rows - used for pagination
$total_rows=$contacto->countAll_BySearch($search_term);
  
// read_template.php controls how the contacto list will be rendered
include_once "read_template.php";
  
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>