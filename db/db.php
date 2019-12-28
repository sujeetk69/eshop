<?php
class Database {
  // TODO: Make configurable
  private $host = "localhost";
  private $username = "root";
  private $password = "";
  private $dbname = "eshop";
  
  /*
  Connects to Database and return the object of mysqli
  */
  public function connect() {
    return new mysqli($this->host, $this->username, $this->password, $this->dbname);
  }
    
  public function select($table, $columns, $filter = "", $orderby = "", $reverse_order = false, $limit = "") {
    $query = "SELECT $columns FROM $table";
    if(strlen($filter) > 0) {
      $query .= " WHERE $filter";
    }
    
    if(strlen($orderby) > 0) {      
      $query .= " ORDER BY $orderby";
      if($reverse_order) {
        $query .= " DESC";  
      }
    }
    
    if(strlen($limit) > 0) {
      $query .= " LIMIT $limit";
    }
    
    $conn = $this->connect();
    $result = $conn->query($query);
    $conn->close();
    return $result;
  }
}
?>