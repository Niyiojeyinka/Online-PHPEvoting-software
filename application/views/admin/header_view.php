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

<title><?php if(isset($title))
{echo $title;} ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome-4.6.3.min.css') ?>"/>

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

</head>
<body class="">

<div style="height:2%;width:100%;padding:1%;" class="w3-bar w3-black w3-text-white">
<div style="height:auto;width:20%;padding:;display:inline" class="w3-bar w3-black w3-text-white">


</div>


<div style="display:inline">
Total Number of Voters:<?php echo count($this->voters_model->get_users(NULL,NULL));    ?>
<br><br>
</div>

</div>


<div class=""><!--container div-->
