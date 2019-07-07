<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="description" content="<?php //echo $description; ?>">
<meta name="keywords" content="<?php
/*foreach ($keywords as $keyw)
{
echo $keyw.',';
}*/
?>">
<meta name="author" content="<?php //echo $author;?>">
<meta name="robots" content="noindex, nofollow">
<link rel="stylesheet" href="<?= base_url('assets/css/fontawesome-4.6.3.min.css') ?>"/>

<title><?php //echo $title; ?></title>
<link rel="stylesheet"  href="<?php echo base_url('assets/css/w3.css'); ?>">
<style>
a {
text-decoration:none;
}
@media screen and (min-width:400px){
#menuc {
width:50%;
}
#imgmedia {
display:inline-block;
width:40%;
height:50%;
}
}
</style>





<meta name="viewport" content="width=device-width, initial-scale=1.0">
<noscript>Pls turn on JavaScript!</noscript>
</head>
<body class="">


<br><br><br>
<div class="w3-container w3-text-indigo w3-center w3-margin-top">

<div style="width:100%" class="w3-container">
<?php echo form_open("page/officer_login");

?>
        <center>
        	<b class="w3-text-indigo w3-xlarge">Welcome E-voter Admin/Officer</b><br>
        	<i class="w3-serif w3-text-gray">With this account You be able to manage and monitor voters,candidates and the whole election process.Please input your login details below</i>
<br>
<?php
echo "<span class='w3-text-red'>".validation_errors()."</span><br>";
if(isset($_SESSION['action_status_report']))
{
  echo $_SESSION['action_status_report'];
} ?> 


<span class="w3-text-blue">Username:</span>

<input  style="width:60%" class="w3-input" name="name" value="<?php echo set_value("name"); ?>" placeholder="Username" requiindigo></input>
<br>

<span class="w3-text-blue">Password:</span>
<input style="width:60%" class="w3-input" type='password' name="pass" value="<?php echo set_value("pass"); ?>" placeholder="Password" requiindigo></input>
<br>

<input class="w3-btn w3-indigo" name="submit" type="submit" value="Login"></center>

<br>
<a class="w3-btn w3-indigo" href="<?= site_url()?>"><i class="fa fa-home"></i> Home</a><br>
</div></div>
</body>
</html>



