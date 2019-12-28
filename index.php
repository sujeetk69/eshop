<?php include "cart/cart.php"; ?>

<?php

$cart = new Cart();
//echo $cart->final_price();

echo "TestCase-1: Scan items in this order: ZA,YB,FC,GD,ZA,YB,ZA,ZA; Verify the total price is £32.40 <br>";
$cart->add_product("ZA");
$cart->add_product("YB");
$cart->add_product("FC");
$cart->add_product("GD");
$cart->add_product("ZA");
$cart->add_product("YB");
$cart->add_product("ZA");
$cart->add_product("ZA");
echo "Total Price = £{$cart->final_price()}<br>";
$cart->clear();

echo "TestCase-2: Scan items in this order: FC,FC,FC,FC,FC,FC,FC; Verify the total price is £7.25 <br>";
$cart->add_product("FC");
$cart->add_product("FC");
$cart->add_product("FC");
$cart->add_product("FC");
$cart->add_product("FC");
$cart->add_product("FC");
$cart->add_product("FC");
echo "Total Price = £{$cart->final_price()}<br>";
$cart->clear();

echo "TestCase-3: Scan items in this order: ZA,YB,FC,GD; Verify the total price is £15.40 <br>";
$cart->add_product("ZA");
$cart->add_product("YB");
$cart->add_product("FC");
$cart->add_product("GD");
echo "Total Price = £{$cart->final_price()}<br>";
$cart->clear();

?>