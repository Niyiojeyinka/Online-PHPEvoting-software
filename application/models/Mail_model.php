<?php

class Mail_model extends CI_Model {


/***
 * Name:      E-voting
 * Package:    mail_model.php
 * About:        A model class that handle  voter's  model operation
 * Copyright:  (C) 2019
 * Author:     oop,Group 7 Members
 * License:    closed /propietry
 ***/

 public function __construct()
{
    parent::__construct();
    $this->load->database();
    //session_start();
}

//e-voting 



//new
public function login_check()
{

 $query = $this->db->get_where('mail_users',array("mail" => $this->input->post("email"),"password" => $this->input->post('password')));
 if(!empty($query->result_array()))
 {
    return true;
}
   return false;
}
 

 
   
public function get_inbox()
{

      $this->db->order_by("id","DESC");

  $query = $this->db->get_where('mail_mails',array('receiver' => $_SESSION['email']));
  return $query->result_array();
  
}

  
public function get_mail($id)
{
  $query = $this->db->get_where('mail_mails',array('receiver' => $_SESSION['email'],'id'=> $id));
  return $query->row_array();
  
}
}
