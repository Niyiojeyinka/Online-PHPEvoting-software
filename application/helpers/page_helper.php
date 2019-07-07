<?php



/***
 * Name:      E-voting
 * Package:    Users_model.php
 * About:        A model class that handle  voter's  model operation
 * Copyright:  (C) 2019
 * Author:     oop,Group 7 Members
 * License:    closed /propietry
 ***/

 function show_login($value)
{

   header('Location: '.base_url().'index.php/user/login/'.$value);
}

function show_page($value)
{
  header('Location: '.base_url().'index.php/'.$value);
}

