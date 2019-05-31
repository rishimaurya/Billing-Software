<!DOCTYPE html>
<head>
<title>Dashboard :: Agarwal Stores</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- bootstrap-css -->
<link rel="stylesheet" href="css/bootstrap.min.css" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
	<link rel="stylesheet" href="<?php echo base_url('css/demo.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('css/form-basic.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('css/style-responsive.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('css/style.css'); ?>">
          <style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #e7e7e7;
    background-color: #f3f3f3;
}

li {
    float: left;
}

li a {
    display: block !important;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none !important;
}

li a:hover:not(.active) {
    background-color: #ddd;
}

li a.active {
    color: white;
    background-color: #4CAF50;
}
li a, .dropbtn {
    display: inline-block;
        text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
 
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {}

.dropdown:hover .dropdown-content {
    display: block;
}
.navi
{
	padding:0px !important;
}
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}

ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    border: 1px solid #e7e7e7;
    background-color: #f3f3f3;
}

li {
    float: left;
}

li a {
    display: block !important;
    color: black;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none !important;
}

li a:hover:not(.active) {
    background-color: #ddd;
}

li a.active {
    color: white;
    background-color: #4CAF50;
}
li a, .dropbtn {
    display: inline-block;
        text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
 
}

li.dropdown {
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {}

.dropdown:hover .dropdown-content {
    display: block;
}
</style>
</head>


	<header>
		<h1>Agarwal Stores</h1>
        
    </header>

    <ul>
        <li class="active"><a href="<?php echo base_url('/Dashboard');?>">Dashboard</a></li>
        <li class="active"><a href="<?php echo base_url('/Invoice');?>">Invoice</a></li>
        <li class="active"><a href="<?php echo base_url('/Add_item');?>">Add Item</a></li>
        <li class="active"><a href="<?php echo base_url('Add_item/itemList');?>">Item List</a></li>
 <li class="active"><a href="<?php echo base_url('Customer');?>">Add Customer</a></li>
        <li class="active"><a href="<?php echo base_url('Customer/searchCustomerList');?>">Customer List</a></li>
        <li class="active"><a href="<?php echo base_url('Agency');?>">Add Agency</a></li>
        <li class="active"><a href="<?php echo base_url('Agency/searchAgencyList');?>">Agency List</a></li>
        <li class=""><a href="<?php echo base_url('ViewInvoice/invoice');?>">Invoice Details</a></li>
        <li class=""><a href="<?php echo base_url('ViewInvoice/rAlert');?>" <?php if(!isset($alert_color)) $alert_color = 0 ;  if($alert_color > 0) echo "style='color:red;'" ?> >Quantity Alert</a></li>
        <li class="active"><a href="<?php echo base_url('Login/logout');?>">Logout</a></li>

    </ul>

<!--<ul>
  <li><a class="active" href="#home">Home</a></li>
  <li><a href="#news">News</a></li>
  <li><a href="#contact">Contact</a></li>
    <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Dropdown</a>
    <div class="dropdown-content">
      <a href="#">Link 1</a>
      <a href="#">Link 2</a>
      <a href="#">Link 3</a>
    </div>
  </li>
</ul>
-->
</br></br>

</head>
<body>
