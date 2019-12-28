<?php
include "product/product.php";

class Cart {
  /* List of products */
  private $product_list;
  
  public function __construct() {
    $this->product_list = array();
  }
  
  public function find_product_in_cart($product_code) {
    foreach($this->product_list as $product) {
      if($product->get_code() == $product_code) {
        return $product;
      }
    }
    return null;
  }
  
  public function add_product($product_code, $quantity = 1) {
    if($quantity < 1) {
      //Throw Error
      echo "Error: cannot add $quantity products";
    }
    if($product = $this->find_product_in_cart($product_code)) {
      $product->change_quantity_by($quantity);
    }
    else {
      $product = Product::find_product_in_db($product_code);
      $product->set_quantity($quantity);
//      $product->add_bundle_pricing(4, 7.00);
      array_push($this->product_list, $product);
    }    
  }
  
  public function final_price() {
    $final_price = 0;
    foreach($this->product_list as $product) {
      $final_price += $product->get_total_price();
    }
    return $final_price;
  }
  
  public function clear() {
    $this->product_list = array();
  }
}
?>