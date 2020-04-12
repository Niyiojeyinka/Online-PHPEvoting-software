<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
  
public function __construct()
{
     parent::__construct();
     $this->load->model(array('voters_model','pages_model','admin_model'));
     $this->load->helper(array('url','page_helper','form'));
     $this->load->library(array('form_validation','session','user_agent'));
}
      
	public function index($offset = null)
	{

if(isset($_SESSION['stage']) )
{
  if($_SESSION['stage'] == 1)
{
   $_SESSION['action_status_report'] ="<center><div style='color:red;'>Please Type in Your
    OTP</div></center>";
    $this->session->mark_as_flash('action_status_report');
  show_page('page/confirm_otp');
}
}

$this->form_validation->set_rules("user_id","User ID","required");
$this->form_validation->set_rules("password","Password","required");

if(!$this->form_validation->run())
{

    $data["title"] ="E-voting | Simplifying The Voting Process";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";

    $this->load->view('common/header_view',$data);
    $this->load->view('public/home_view',$data);
    $this->load->view('common/footer_view',$data);


}else{
//check the database for match
  //no match redirect back to front page
  //else create a session
  //send an email
  if($this->voters_model->login_check())
{
    $_SESSION['id'] = $this->input->post("user_id");
  $_SESSION['stage'] = 1;
  //send confirmation here

  $voter = $this->voters_model->get_voter_by_id();
  $this->voters_model->send_mock_up_email($voter);
//redirect to confirm otp page

  show_page('page/confirm_otp');

}else{
  //incorrect login information
  $_SESSION['action_status_report'] ="<center><div style='color:red;'>Incorrect Login Details</div></center>";
  $this->session->mark_as_flash('action_status_report');
  show_page('');
}

}
    


	}

public function confirm_otp(){


  if($_SESSION['stage'] != 1)
{
  //incorrect login information
  $_SESSION['action_status_report'] ="<center><div style='color:red;'>Please Login First</div></center>";
   $this->session->mark_as_flash('action_status_report');
  show_page('');
}

$this->form_validation->set_rules("email_vc","Email Verification Code/OTP","required");

if(!$this->form_validation->run())
{


   $data["title"] ="E-voting |Security OTP";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";

    $this->load->view('common/header_view',$data);
    $this->load->view('public/confirm_view',$data);
    $this->load->view('common/footer_view',$data);

}else{

//check if otp is correct

  if($this->voters_model->check_otp())
  {
    unset($_SESSION['stage']);
    $_SESSION['logged_in'] = true;

    //login
    //unset stage
    //redirect to dashboard
    show_page('dashboard');
  }else{
//redirect incorrect otp
$_SESSION['action_status_report'] ="<center><div style='color:red;'>Invalid OTP</div></center>";
    $this->session->mark_as_flash('action_status_report');
  show_page('page/confirm_otp');

  }
}
}

public function vp($slug = NULL)
{
       $data['item'] = $this->pages_model->get_page($slug);

        if (empty($data['item']) || $slug == NULL)
        {
                show_404();
        }


        $data['title'] = 'E-voting| '.$data['item']['title'];
      $data['keywords'] = $data['item']['keywords'];
      $data['keywords'] = $data['item']['description'];
      $data['author'] = $data['item']['author'];
      $data['description'] = $data['item']['description'];


        $data['page_code'] = $data['item']['text'];


        $this->load->view('common/header_view',$data);
		$this->load->view('public/single_view',$data);
		$this->load->view('common/footer_view',$data);


}



    public function officer_login()
    {
   
  $this->form_validation->set_rules("pass","Password","required");
$this->form_validation->set_rules("name","Username","trim|required");
$data= [];
    if(!$this->form_validation->run())
    {
    
   $this->load->view('/admin/login_view',$data);
}
else
{


if($this->admin_model->login_check())
{


//success page
//session_start();
$this->session->admin_name = $this->input->post("name");


$this->session->admin_logged_in = true;



        show_page("admin");

}
else{
//incorrect password error msg
   $_SESSION['action_status_report'] ="<span class='w3-text-red'>Incorrect 
    Username/password:Please try again</span><br>";
    $this->session->mark_as_flash('action_status_report');

show_page("page/officer_login");


}





    }
    

    
    }
    
public function unset()
{
  echo time();
  unset($_SESSION['stage']);
}

}
