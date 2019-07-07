<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

public function __construct()
{
    parent::__construct();

    $this->load->model(array('admin_model','voters_model','pages_model'));
    $this->load->helper(array('url','form_helper','page_helper'));
    $this->load->library(array('form_validation','session'));
  
 if ((!isset($this->session->admin_name)) ||(!isset($this->session->admin_logged_in)))
 {


    header('Location: '.site_url('officer'));
}
}


public function index()
{
  $data= [];

$data['election_start'] = $this->voters_model->get_system_var('election_start')['variable_value'];
$data['election_end'] = $this->voters_model->get_system_var('election_end')['variable_value'];

$data['release_result'] = $this->voters_model->get_system_var('release_result')['variable_value'];

   $this->load->view('/admin/header_view',$data);
   $this->load->view('/admin/sidebar_view',$data);
   $this->load->view('/admin/first_view',$data);
   $this->load->view('/admin/footer_view',$data);





}
public function set_time()
{

$this->form_validation->set_rules('stime','Election Start Time','required');

if (!$this->form_validation->run()) {
 $_SESSION['action_status_report'] ="<center><div style='color:red;'>".validation_errors()."</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
show_page('admin');

}else{
//check if date is valid
  $start_time = $this->input->post('day').'-'.$this->input->post('month').'-'.$this->input->post('year').' '.$this->input->post('stime').' ';
$start_time =  strtotime($start_time);

if($start_time < time())
{
   $_SESSION['action_status_report'] ="<center><div style='color:red;'>Time is not valid;Please use time greater than ".date("F j, Y, g:i a",time())."</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin');
}else{

//date is valid

$end_time = $start_time + ($this->input->post('duration') * 60);

$this->admin_model->set_time($start_time,$end_time);

$_SESSION['action_status_report'] ="<center><div style='color:green;'>Time Set Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin');

}
}
}


public function release_result()
{

$this->admin_model->release_result();

$position = $this->voters_model->get_available_position('id,label');
//create an array to hold candidates and Position details
$data['results'] =[];

for ($i=0; $i < count($position); $i++) {


$each_position=[];
$each_position['position_label'] = $position[$i]['label'];

$each_position['candidates'] = [];

$candidates = $this->voters_model->get_candidates_by_position($position[$i]['id']);
if(!empty($candidates))
{
foreach ($candidates as $candidate) {
//get candidate votes
  $no_votes = count($this->voters_model->get_candidates_votes($candidate['user_id']));
  $candidate['no_votes'] = $no_votes;
  array_push($each_position['candidates'],$candidate );
}
}else{
  //no candidate
  $each_position['candidates'] = 0;
}
array_push($data['results'] ,$each_position);
}

$data['title'] = "Result";

   $this->load->view('/admin/header_view',$data);
   $this->load->view('/admin/sidebar_view',$data);
   $this->load->view('/admin/result_view',$data);
   $this->load->view('/admin/footer_view',$data);




}
public function add_voter()
{

$this->form_validation->set_rules('firstname','Firstname','required');
$this->form_validation->set_rules('lastname','Lastname','required');
$this->form_validation->set_rules('email','Email','required|valid_email|is_unique[users.email]');
$this->form_validation->set_rules('user_id','Password','required|is_unique[users.user_id]',array('is_unique' => 'User Already Registered'));
$this->form_validation->set_rules('password','Password','required|min_length[3]');
$this->form_validation->set_rules('epassword','Email Password','required|min_length[3]');


if(!$this->form_validation->run())
{
$data['title'] = "Add Voter";

   $this->load->view('/admin/header_view',$data);
   $this->load->view('/admin/sidebar_view',$data);
   $this->load->view('/admin/add_voter_view',$data);
   $this->load->view('/admin/footer_view',$data);



}else{

  $this->admin_model->insert_voter();
$_SESSION['action_status_report'] ="<center><div style='color:green;'>Voter Added Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/voters');



}


}


public function posts()
{

$this->form_validation->set_rules('label','Office Name','required');
$this->form_validation->set_rules('short_form','Short Form','required');


if(!$this->form_validation->run())
{
$data['title'] = "Add Office/Post";

$data['offices'] =$this->admin_model->get_offices();
   $this->load->view('/admin/header_view',$data);
   $this->load->view('/admin/sidebar_view',$data);
   $this->load->view('/admin/posts_view',$data);
   $this->load->view('/admin/footer_view',$data);



}else{

  $this->admin_model->insert_post();
$_SESSION['action_status_report'] ="<center><div style='color:green;'>Office/Post Added Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/posts');



}


}
public function delete_post($id = NULL)
{


$result = $this->admin_model->get_users_by_office($id);

if(empty($result))
{
$this->admin_model->delete_post($id);
$_SESSION['action_status_report'] ="<center><div style='color:green;'>Office/Post Deleted Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/posts');
}else{

$_SESSION['action_status_report'] ="<center><div style='color:red;'>Office/Post cannot be Deleted because its already assigned to one or more candidates</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/posts');


}


}

public function voters($offset = 0)
{


    $limit = 4;
      $this->load->library('pagination');



if(isset($_POST['submit']))
{
        $data['voters'] = $this->admin_model->search_users($offset,$limit);

}else{
        $data['voters'] = $this->admin_model->get_users($offset,$limit);
}



    $config['base_url'] = site_url("admin/voters");

  $config['total_rows'] = count($this->admin_model->get_users(null,null));
  

    $config['per_page'] = $limit;

   //$config['uri_segment'] = 4;
  $config['first_tag_open'] = '<span class="w3-btn w3-indigo w3-text-white">';
  $config['first_tag_close'] = '</span>';
  $config['last_tag_open'] = '<br><span class="w3-btn w3-indigo w3-text-white">';
  $config['last_tag_close'] = '</span>';
  $config['first_link'] = 'First';

  $config['prev_link'] = 'Prev';
  $config['next_link'] = 'Next';
  $config['next_tag_open'] = '<span style="margin-left:20%" class="w3-btn w3-indigo w3-text-white">';
  $config['next_tag_close'] = '</span><br>';
  $config['prev_tag_open'] = '<span style="" class="w3-btn w3-indigo w3-text-white">';
  $config['prev_tag_close'] = '</span>';
  $config['last_link'] = 'Last';
  $config['display_pages'] = false;

       $this->pagination->initialize($config);
  $data['pagination'] = $this->pagination->create_links();

$data['title'] = "Add Office/Post";

$data['offices'] =$this->admin_model->get_offices();
   $this->load->view('/admin/header_view',$data);
   $this->load->view('/admin/sidebar_view',$data);
   $this->load->view('/admin/users_view',$data);
   $this->load->view('/admin/footer_view',$data);



}
public function mark_as_candidate($id = NULL)
{

$this->form_validation->set_rules('office','Office','required');

if (!$this->form_validation->run()) {

$data['title'] = "Add Office/Post";

$data['offices'] =$this->admin_model->get_offices();
$data['candidate'] = $this->voters_model->get_voter_by_its_id($id);
   $this->load->view('/admin/header_view',$data);
   $this->load->view('/admin/sidebar_view',$data);
   $this->load->view('/admin/candidacy_view',$data);
   $this->load->view('/admin/footer_view',$data);


}else{

  $this->admin_model->mark_as_candidate($id);


$_SESSION['action_status_report'] ="<center><div style='color:green;'>Marked as candidate Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/voters');


}
}

public function remove_candidate($id = NULL)
{

  $this->admin_model->remove_candidate($id);


$_SESSION['action_status_report'] ="<center><div style='color:red;'>Candidate Removed Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/voters');



}

public function delete_candidate($id = NULL)
{

  $this->admin_model->delete_candidate($id);


$_SESSION['action_status_report'] ="<center><div style='color:red;'>Candidate DELETED Successfully</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
  show_page('admin/voters');



}
public function log_out()
{


  unset($_SESSION['admin_logged_in']);
  show_page('admin');
}
}