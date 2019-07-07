<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends CI_Controller {
  /**
  *written by great members of group 7 of SWEP 200 2017/2018 SESSION

  **/

public function __construct()
{
     parent::__construct();
     $this->load->model(array('mail_model'));
     $this->load->helper(array('url','page_helper','form'));
     $this->load->library(array('form_validation','session','user_agent'));
}
      
	public function index($offset = null)
	{

$this->form_validation->set_rules("email","Email","required");
$this->form_validation->set_rules("password","Password","required");

if(!$this->form_validation->run())
{

    $data["title"] ="Group7 Mail | The MockUp Email";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";

    $this->load->view('mail/headmeta_view',$data);
    $this->load->view('mail/header_view',$data);
    $this->load->view('mail/home_view',$data);
    $this->load->view('mail/footer_view',$data);


}else{
//check the database for match
  //no match redirect back to front page
  //else create a session
 
  if($this->mail_model->login_check())
{
  //send confirmation here
//redirect to confirm otp page
  $_SESSION['email'] = $this->input->post("email");
  show_page('mail/inbox');

}else{
  //incorrect login information
  $_SESSION['action_status_report'] ="<center><div style='color:red;'>Incorrect Login Details</div></center>";
  $this->session->mark_as_flash('action_status_report');
  show_page('mail');
}

}
    


	}

public function inbox(){


  if(!$_SESSION['email'])
{
  //incorrect login information
  $_SESSION['action_status_report'] ="<center><div style='color:red;'>Please Login First</div></center>";
   $this->session->mark_as_flash('action_status_report');
  show_page('mail');
}
$data['mails'] = $this->mail_model->get_inbox();
    $data["title"] ="Group7 Mail | The MockUp Email";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";

    $this->load->view('mail/headmeta_view',$data);
    $this->load->view('mail/header_view',$data);
    $this->load->view('mail/inbox_view',$data);
    $this->load->view('mail/footer_view',$data);


}

public function view_mail($slug = NULL)
{
  if(!$_SESSION['email'])
{
  //incorrect login information
  $_SESSION['action_status_report'] ="<center><div style='color:red;'>Please Login First</div></center>";
   $this->session->mark_as_flash('action_status_report');
  show_page('mail');
}
$data['mail'] = $this->mail_model->get_mail($slug);
    $data["title"] ="Group7 Mail | The MockUp Email";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";

    $this->load->view('mail/headmeta_view',$data);
    $this->load->view('mail/header_view',$data);
    $this->load->view('mail/mail_view',$data);
    $this->load->view('mail/footer_view',$data);


}



}
