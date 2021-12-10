<?php
class Contacto{
  
    // database connection and table name
    private $conn;
    private $table_name = "agenda";
  
    // object properties
    public $id;
    public $nombre;
    public $telefono;
  
  
    public function __construct($db){
        $this->conn = $db;
    }
  
    // create contacto
    function create(){
  
        //write query
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    id=:id, nombre=:nombre, telefono=:telefono";
  
        $stmt = $this->conn->prepare($query);
  
        // posted values
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->nombre=htmlspecialchars(strip_tags($this->nombre));
        $this->telefono=htmlspecialchars(strip_tags($this->telefono));
        
  
      
  
        // bind values 
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":telefono", $this->telefono);
        
  
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
  
    }
    function readAll($from_record_num, $records_per_page){
  
        $query = "SELECT
                    id, nombre, telefono
                FROM
                    " . $this->table_name . "
                ORDER BY
                    id ASC
                LIMIT
                    {$from_record_num}, {$records_per_page}";
      
        $stmt = $this->conn->prepare( $query );
        $stmt->execute();
      
        return $stmt;
    }
    
public function countAll(){
  
    $query = "SELECT id FROM " . $this->table_name . "";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->execute();
  
    $num = $stmt->rowCount();
  
    return $num;
}
function readOne(){
  
    $query = "SELECT
                id, nombre, telefono
            FROM
                " . $this->table_name . "
            WHERE
                id = ?
            LIMIT
                0,1";
  
    $stmt = $this->conn->prepare( $query );
    $stmt->bindParam(1, $this->id);
    $stmt->execute();
  
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    $this->id = $row['id'];
    $this->nombre = $row['nombre'];
    $this->telefono = $row['telefono'];
    
}
function update(){
  
    $query = "UPDATE
                " . $this->table_name . "
            SET
                id = :id,
                nombre = :nombre,
                telefono = :telefono,
            WHERE
                id = :id";
  
    $stmt = $this->conn->prepare($query);
  
    // posted values
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->nombre=htmlspecialchars(strip_tags($this->nombre));
    $this->telefono=htmlspecialchars(strip_tags($this->telefono));
    

  
    // bind parameters
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':nombre', $this->nombre);
    $stmt->bindParam(':telefono', $this->telefono);

  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// delete the contact
function delete(){
  
    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
      
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
  
    if($result = $stmt->execute()){
        return true;
    }else{
        return false;
    }
}
// read contacts by search term
public function search($search_term, $from_record_num, $records_per_page){
  
    // select query
    $query = "SELECT
               id,nombre,telefono
            FROM
                " . $this->table_name . " ";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(4, $records_per_page, PDO::PARAM_INT);
  
    // execute query
    $stmt->execute();
  
    // return values from database
    return $stmt;
}
  
public function countAll_BySearch($search_term){
  
    // select query
    $query = "SELECT
                COUNT(*) as total_rows
            FROM
                " . $this->table_name . " p 
            WHERE
                p.name LIKE ? OR p.description LIKE ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind variable values
    $search_term = "%{$search_term}%";
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
  
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $row['total_rows'];
}
}
?>