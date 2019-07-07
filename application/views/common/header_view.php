<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="Group7 2017/2018"/>
    <link rel="icon" href="<?php echo base_url('assets/media/images/favicon.png'); ?>" type="image/x-icon"/>
  <meta name="description" content="<?php echo $description; ?>"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0" />
    <script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
 <script type="text/javascript">
    var t = setInterval(function (){
var current_time = new Date().getTime();
var current_time = Math.floor(current_time/1000);
var countdown = <?= $election_start ?>;
var margin = countdown-current_time;
    var  mo =Math.floor(margin/(60*60*24*31));
    var d = Math.floor((margin % (60*60*24*31))/(60*60*24));
    var h = Math.floor(((margin % (60*60*24*31))%(60*60*24))/(60*60));
    
    var m = Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))/(60));
    
  var s =  Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))%(60));
document.getElementById('time_div').innerHTML =mo+'<span style="font-size:8px">months</span> '+d+'<span style="font-size:8px">days</span> '+h+'<span style="font-size:8px">hours</span> '+m+'<span style="font-size:8px">minutes</span> '+s+'<span style="font-size:8px">seconds</span> ';

    }, 1000);


  </script>

<?php

if(isset($noindex))
{
  echo $noindex;
}


?>
  <meta property="og:description" content="<?php echo strip_tags($description); ?>" />

  <meta property="og:url"content="<?php echo current_url(); ?>" />

  <meta property="og:title" content="<?php echo $title; ?>" />

  <meta property="og:image" content="<?php
 ?>"/>
    <title>E-voting Platform</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/fontawesome-4.6.3.min.css') ?>"/>
 <link rel="stylesheet" href="<?= base_url('assets/css/ourstyle.css') ?>"/>

  </head>

  <body style="background-color:white;">
    <div class="full_container">
      <div class="header">
        <!--Skip to main content | Screen reader Friendly-->
      </div>
      <div class="nav">
        <div class="left_nav">
          <img src="<?= base_url('assets/images/logo.png') ?>" width="157" height="50" alt="logo" />
        </div>
        <div class="main_nav">
<?php
          //do not show for logged in users
          if(isset($_SESSION['logged_in']))
          {
            echo "   <a href='".site_url('dashboard')."'>Home</a> ";
          }else{
            echo "   <a href='".site_url('')."'>Home</a> ";

          }
        ?>         <!-- <a href="<?=site_url('p/about') ?> ">About us</a>
          <?php
          //do not show for logged in users
          if(!isset($_SESSION['logged_in']))
          {
            echo "   <a href='".site_url('p/registration')."'>Registration</a> ";
          }
        ?>
          <a href="<?=site_url('p/help') ?>">Help</a>
          <a href="<?=site_url('p/contact') ?>">Contact Us</a>
          <a href="<?=site_url('p/feedback') ?>">Feedback</a>-->
        </div>
       <div class="right_nav">
         <!--  <input type="text" class="box_size" placeholder="Search.." />-->
        </div>
      </div>