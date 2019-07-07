<?php

class Admin_model extends CI_Model {



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

}



public function login_check()
{

$_pass = $this->input->post('pass');

if($_pass == "admin" && $this->input->post("name") == "admin")
{ return true;
}
 else
   {
   return false;
   }

}


public function set_time($start_time,$end_time)
{

$this->db->update('system_var',array('variable_value' => $start_time),array('variable_name' => 'election_start'));
$this->db->update('system_var',array('variable_value' => $end_time),array('variable_name' => 'election_end'));
$this->db->query('TRUNCATE votes');
$this->db->update('system_var',array('variable_value' => 'false'),array('variable_name' => 'release_result'));


}


public function release_result()
{

$this->db->update('system_var',array('variable_value' => 'true'),array('variable_name' => 'release_result'));


}
public function insert_voter()
{

$db_data = array(
'firstname' => $this->input->post('firstname'),
'lastname' => $this->input->post('lastname'),
'username' => $this->input->post('username'),
'password' => $this->input->post('password'),
'user_id' => $this->input->post('user_id'),
'slogan' => $this->input->post('slogan'),
'email' => $this->input->post('email'),
'status'=> 'active',
'candidate' =>'0',
'time' => time()


);

	$this->db->insert('users',$db_data);
		$this->db->insert('mail_users',array('mail' =>$this->input->post('email'),'password'  => $this->input->post('epassword')));

}

public function insert_post()
{

		$this->db->insert('positions',array('label' =>$this->input->post('label'),'short_form'  => $this->input->post('short_form')));

}
public function get_offices()
{
$this->db->order_by('id','DESC');
$query = $this->db->get('positions');
return $query->result_array();

}
public function delete_post($id)
{
	$this->db->delete('positions',array('id' => $id));
}
public function get_users($offset,$limit)
{
$this->db->order_by('id','DESC');
$query= $this->db->get_where('users',array('status' => 'active'),$limit,$offset);
return $query->result_array();

}

public function search_users($offset,$limit)
{
	$search_keyword =$this->input->post('searchkeyword');
     $search_type=$this->input->post('type');
if( $search_type =='email')
{

$this->db->order_by('id','DESC');
$query= $this->db->get_where('users',array('email' => $search_keyword),$limit,$offset);
}else{

$this->db->order_by('id','DESC');
$query= $this->db->get_where('users',array('user_id' => $search_keyword),$limit,$offset);
}

return $query->result_array();

}

public function mark_as_candidate($id)
{

	$this->db->update('users',array('candidate'=> '1','position' => $this->input->post('office')) ,array(
    'id' => $id
	));
}


public function remove_candidate($id)
{

	$this->db->update('users',array('candidate'=> '0','position' => '') ,array(
    'id' => $id
	));
}

public function delete_candidate($id)
{

	$this->db->delete('users',array(
    'id' => $id
	));
}
public function get_users_by_office($id)
{
	$query= $this->db->get_where('users',array('position' => $id));
	return $query->result_array();
}
}