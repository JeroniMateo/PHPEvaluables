<?php
// show error reporting
error_reporting(E_ALL);
 

 
// set default time-zone
date_default_timezone_set('Europe/Madrid');
 
// url de la agenda de contactos
$home_url="http://localhost/CAP5 Evaluables/Agenda con DataBase/";
 
// page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>