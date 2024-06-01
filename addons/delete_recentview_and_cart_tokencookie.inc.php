<?php
//DELETE RECENT VIEW TOKEN COOKIE AND DATA
$viewed = new viewed('admin');
$viewed->token = get_viewed_token();
$viewed->delete_viewed();
if(isset($_COOKIE['ryn_vd'])){delete_viewed_token();}

//DELETE CART TOKEN COOKIE AND DATA
$order = new order('admin');
$order->token = get_order_token();
$order->status = 'cart';
$order->delete_cart('logout');
if(isset($_COOKIE['urntl'])){delete_order_token();}
?>