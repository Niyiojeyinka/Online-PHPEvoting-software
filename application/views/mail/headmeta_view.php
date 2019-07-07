<!DOCTYPE html>
<html>
<title><?php
 echo $title;
    ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
<meta name="description" content="<?php echo $description; ?>">
<meta name="keywords" content="<?php
echo $keywords;
?>">
<link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.png'); ?>" />


<meta property="og:image" content="<?php


?>
" />
<style>
a {
text-decoration:none;

}
 a:active{
background-color:ndigo;

}
 </style>


<meta property="og:description" content="<?php echo $description; ?>" />

<meta property="og:url"content="<?php echo current_url(); ?>" />

<meta property="og:title" content="<?php echo $title; ?>" />
<?php
if(isset($noindex))
{
echo $noindex;

}
 ?>



<link rel="stylesheet" href="<?php echo base_url('assets/css/w3mobile.css'); ?>">
<link rel="stylesheet"  href="<?php echo base_url('assets/css/w3.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome-4.6.3.min.css') ?>"/>
<link rel="stylesheet" href="<?php echo base_url('assets/css/w3-theme-brown.css'); ?>">




<body class="">
 <!---->
 <center>
 <div style="max-width:600px">
