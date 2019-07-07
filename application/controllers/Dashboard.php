<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
 /**
  *written by great members of group 7 of SWEP 200 2017/2018 SESSION

  **/



public function __construct()
{
     parent::__construct();

    $this->load->model(array('admin_model','voters_model','pages_model'));
        $this->load->helper(array('url','form','page_helper'));
     $this->load->library(array('form_validation','session'));



//check for login
      if  (!isset($this->session->logged_in))
       {    
       $_SESSION['action_status_report'] ="<center><div style='color:red;'>You Don't have the permission to visit the Page or Your session has expired</div></center>";
  $this->session->mark_as_flash('action_status_report'); 
       show_page('');     }



}
public function index()
{
 $data["title"] ="E-voting | Voters Dashboard";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";
$data['election_start'] = $this->voters_model->get_system_var('election_start')['variable_value'];
$data['election_end'] = $this->voters_model->get_system_var('election_end')['variable_value'];
if((time() >= $data['election_start'] ) && ($data['election_end'] >time() ))
{
  show_page('Dashboard/vote');
}
if((time() > $data['election_start'] ) && ($data['election_end'] < time() ))
{
  show_page('Dashboard/post_vote');
}
    $this->load->view('common/header_view',$data);
    $this->load->view('private/prevote_view',$data);
    $this->load->view('common/footer_view',$data);
}



public function return_countdown_check()
{
$election_start = $this->voters_model->get_system_var('election_start')['variable_value'];
$election_end = $this->voters_model->get_system_var('election_end')['variable_value'];
if((time() >= $election_start ) && ($election_end >time() ))
{
  //election is on
  echo "start";
}elseif(time() > $election_end){
  echo "stop";
}elseif(time() < $election_start){
  //wait
  echo "wait";
}


}

public function test()
{
echo time();
  var_dump($this->voters_model->get_available_position('id,label'));
 echo count($this->voters_model->get_available_position('id,label'));
}
public function vote()
{

$this->form_validation->set_rules("submit","Vote Button","required");
if(!$this->form_validation->run())
{



$data["title"] ="E-voting | Voters Dashboard";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";
$data['election_start'] = $this->voters_model->get_system_var('election_start')['variable_value'];
$data['election_end'] = $this->voters_model->get_system_var('election_end')['variable_value'];
if((time() > $data['election_start'] ) && ($data['election_end'] < time() ))
{
  show_page('Dashboard/post_vote');
}
if((time() <= $data['election_start'] ))
{
  show_page('Dashboard');
}

$position = $this->voters_model->get_available_position('id,label');
/*create an array to hold candidates and Position details*/
$data['holder'] =[];
for ($i=0; $i < count($position); $i++) {

$candidates = $this->voters_model->get_candidates_by_position($position[$i]['id']);
$data['holder'][$i] = array('position_name'=> $position[$i]['label'],'position_id'=> $position[$i]['id'],'candidates' => $candidates);
}

    $this->load->view('common/header_view',$data);
    $this->load->view('private/vote_view',$data);
    $this->load->view('common/footer_view',$data);




}else{

//echo   $candidate_id = $this->input->post($i+1);

  
  //check if time is still available

$election_end = $this->voters_model->get_system_var('election_end')['variable_value'];
if(!(time() >= $election_end))
{
  //time is ok proceed
    //check if vote already exist

$position = $this->voters_model->get_available_position('id,label');
$user_votes = [];
for ($i=0; $i < count($position) ; $i++) {
  $candidates = $this->voters_model->get_candidates_by_position($position[$i]['id']);
  //check for empty position
   if(!empty($candidates))
  {
    //candidate id as value position as name
  //$index = (int)$i+1;
  $candidate_id = $this->input->post($position[$i]['id']);
  
$user_votes[$i] = array('voters_id'=>$_SESSION['id'],'candidate_id' => $candidate_id ,'position'  => $position[$i]['id'],
   'status' => 'valid'
);

  }

}
$this->voters_model->insert_vote($user_votes);

  show_page('Dashboard/vote');


}else{

  //redirect to voteend
  $_SESSION['action_status_report'] ="<span style='color: red;'>Sorry Time is UP</span>";
  $this->session->mark_as_flash('action_status_report');
  show_page('Dashboard/post_vote');
}


}


}

public function view_result()
{

 $data["title"] ="E-voting | View Result";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";
$data['release_result'] = $this->voters_model->get_system_var('release_result')['variable_value'];
$data['election_start'] = $this->voters_model->get_system_var('election_start')['variable_value'];
$data['election_end'] = $this->voters_model->get_system_var('election_end')['variable_value'];

if( ($data['election_end'] > time() ))
{
  show_page('Dashboard');
}



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



$this->load->view('common/header_view',$data);
    $this->load->view('private/result_view',$data);
    $this->load->view('common/footer_view',$data);


}
public function post_vote()
{
 $data["title"] ="E-voting | Voters Dashboard";
      $data["keywords"] ="E-voting,oau,group7";
    $data["author"] ="Group7";
     $data["description"] ="Electronic Voting system created for swep200 by Group Seven";
$data['election_start'] = $this->voters_model->get_system_var('election_start')['variable_value'];
$data['election_end'] = $this->voters_model->get_system_var('election_end')['variable_value'];
if((time() >= $data['election_start'] ) && ($data['election_end'] >time() ))
{
  show_page('Dashboard/vote');
}
if((time() <= $data['election_start'] ))
{
  show_page('Dashboard');
}
    $this->load->view('common/header_view',$data);
    $this->load->view('private/postvote_view',$data);
    $this->load->view('common/footer_view',$data);



 }
}


