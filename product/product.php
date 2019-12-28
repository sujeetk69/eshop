<?php
include "db/db.php";

class Product {
  // DB details as static members
  public static $table_name = "products";
  public static $bundle_table_name = "bundles";
  
  private $id;
  private $code;
  private $name;
  private $unit_price;
  private $bundles;
  private $quantity;
  
  public function __construct($code, $name, $unit_price) {
    //Array of Bundles
    $this->bundles = array();
    
    $this->code = $code;
    $this->name = $name;
    $this->unit_price = $unit_price;
    
    // Minimum value of quantity
    $this->quantity = 1;
  }
  
  /* Static methods */
  public static function find_product_in_db($product_code) {
    // Find the product in the DB
    $db = new Database();
    $result = $db->select(self::$table_name, "*", "code='$product_code'");
    $product = null;

    if($result) {
      $row = $result->fetch_assoc();
      $product = new Product($row['code'], $row['name'], $row['unit_price']);
      $product_id = $row['id'];
      
      //Check for bundle pricing 
      $result = $db->select(self::$bundle_table_name, "bundle_size, bundle_price", "product_id='$product_id'", "bundle_size", true);
      if($result) {
        while($row = $result->fetch_assoc()) {
          $product->add_bundle_pricing($row['bundle_size'], $row['bundle_price']);
        }
      }
      
    }
    return $product;
  }
  
  /* End Static methods */
  
  public function get_code() {
    return $this->code;
  }
  
  public function set_quantity($num) {
    $this->quantity = $num;
  }
  
  public function change_quantity_by($n) {
    if($this->quantity + $n > 0) {
      $this->quantity += $n;
    }
    else {
      //Throw Error
      echo "Error: quantity cannot be less than 1";
    }
  }
  
  public function add_bundle_pricing($size, $price) {
    $bundle = new Bundle($size, $price);
    array_push($this->bundles, $bundle);
  }
  
  public function get_total_price() {
    //TODO: Bubdles must be in descending order
    $total_price = 0;
    $quantity = $this->quantity;
//    print_r($this->bundles);
    foreach($this->bundles as $bundle) {
      while($bundle->bundle_size <= $quantity) {
        $total_price += $bundle->bundle_price;
        $quantity -= $bundle->bundle_size;
      }
    }
//    echo "<br>quantity = $this->quantity, unit price= $this->unit_price";
    $total_price += $quantity * $this->unit_price;    
    return $total_price;
  }
  
}

class Bundle {
  public $bundle_size;
  public $bundle_price;
  
  public function __construct($size, $price) {
    $this->bundle_size = $size;
    $this->bundle_price = $price;    
  }
}
?>