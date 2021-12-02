<?php
class Agenda{
 
    // conexion de la base de datos y de la tabla en especifico
    private $conn;
    private $table_name = "agenda";
 
    //cogemos las propiedades del objeto
    public $nombre;
    public $telefono;
   
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
}