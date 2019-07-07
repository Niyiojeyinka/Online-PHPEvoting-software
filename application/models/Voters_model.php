<?php

class Voters_model extends CI_Model {


/***
 * Name:      E-voting
 * Package:    Users_model.php
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

 $query = $this->db->get_where('users',array("user_id" => $this->input->post("user_id"),"password" => $this->input->post('password')));
 if(!empty($query->result_array()))
 {
    return true;
}
   return false;
}
 

 //new
public function check_otp()
{
 $query = $this->db->get_where('users',array("user_id" => $_SESSION['id']));
 $correct_otp = $query->row_array()['email_vc'];

 if($this->input->post('email_vc') == $correct_otp)
 {
    return true;
}
   return false;
}
 
   
public function get_system_var($variable_name)
{
  $query = $this->db->get_where('system_var',array('variable_name' => $variable_name));
  return $query->row_array();
  
}
public function get_available_position($what_to_select)
{
$this->db->select($what_to_select);
$query = $this->db->get('positions');
return $query->result_array();
}
public function get_candidates_by_position($position)
{
/*only get from voters=users where its a candidate*/
//$this->db->select('id,user_id,firstname,lastname,username,slogan,position');
  $query = $this->db->get_where('users',array('candidate' => '1','position' => $position ));
  return $query->result_array();
}

public function insert_vote($votes)
{
//loop through votes
  //check if not already exists
  //if already exists dont insert just add 
  //to array of error
  //if  not exists just add
$error_messages =[];
foreach ($votes as $vote) {
 $check = $this->db->get_where('votes',array('voters_id'=>$_SESSION['id'] ,'position'  => $vote['position']));
 $check = $check->row_array();
//get position label here later
$label = $this->db->get_where('positions',array('id' => $vote['position'] ))->row_array()['label'] ;

if(empty($check))
{
  if(!empty($vote['candidate_id']))
  {
     //insert vote here
  $this->db->insert('votes',$vote);
  //set Success messages
  $err = "<span style='color:green'>Your vote for ".$label." has been recorded Successfully</span><br>";
  array_push($error_messages, $err);

  }
 
}else{
  //collate error message here

   $err = "<span style='color:red'>You can only vote for ".$label." once</span><br>";
  array_push($error_messages, $err);
}

$_SESSION['error_messages'] = $error_messages;
$this->session->mark_as_temp('error_messages',100);
//$this->session->mark_as_flash('error_messages');

}

}
public function get_candidates_votes($candidate_id)
{

  $query= $this->db->get_where('votes', array('candidate_id' => $candidate_id));
  return $query->result_array();
}

public function get_voter_by_id()
{

$query= $this->db->get_where('users',array('user_id' => $_SESSION['id']));
return $query->row_array();

}

public function get_voter_by_its_id($id)
{

$query= $this->db->get_where('users',array('id' => $id));
return $query->row_array();

}

public function get_users($offset,$limit)
{

$query= $this->db->get_where('users',array('status' => 'active'),$limit,$offset);
return $query->result_array();

}

public function send_mock_up_email($voter)
{
//update vcode 
  //insert to mail

    $array_char =range(0, 50);
    $a = mt_rand(0,49);
    $b = mt_rand(0,49);
    $c = mt_rand(0,49);
    $d = mt_rand(0,49);



   $vcode  = ($array_char[$a]*4)."".$array_char[$b]."".($array_char[$c]*3)."".($array_char[$d]*9);

 $this->db->update('users',array('email_vc' => $vcode),array('user_id' => $_SESSION['id']));

 $msg = array(
'sender' => 'help@e-voting.com',
'receiver' => $voter['email'],
'title' => 'E-Voting | One Time Password',
'message' => 'Dear '.$voter['firstname'].' <br><br>Your OTP Code is <b class="w3-text-green">'.$vcode.'</b><br>',
'time' => time()
 );
 $this->db->insert('mail_mails',$msg);

}



}

