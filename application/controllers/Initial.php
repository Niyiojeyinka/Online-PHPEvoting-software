<?php
/**
  *written by great members of group 7 of SWEP 200 2017/2018 SESSION

  **/

class Initial extends CI_Controller {
    function index()
    {

    $this->load->database();

        $sql1 = "CREATE TABLE users (
            id int(11) NOT NULL AUTO_INCREMENT,
            firstname varchar(128),
            lastname varchar(128),
            username varchar(128),
            slogan varchar(225),
            user_id varchar(128),
            password varchar(128),
            email varchar(128),
            email_vc varchar(128),
            status enum('active','inactive'),
            candidate enum('0','1'),
            position int(2),
            time int(20),
            PRIMARY KEY (id)
    );";
    //slogan not more than 244characters 
    //username for candidates

    $sql2 = "CREATE TABLE votes (
            id int(11) NOT NULL AUTO_INCREMENT,
            voters_id varchar(128) NOT NULL,
            candidate_id varchar(128) NOT NULL,
            position varchar(224),
            status enum('valid','invalid'),
            time int(20),
            PRIMARY KEY (id)
    );";



 $sql3= "CREATE TABLE system_var (
    id int(11) NOT NULL AUTO_INCREMENT,
    variable_name varchar(128),
    variable_value varchar(128),
    long_value text,
    PRIMARY KEY (id)
);";




 $sql4= "CREATE TABLE positions (
    id int(11) NOT NULL AUTO_INCREMENT,
    label varchar(128),
    short_form varchar(128),
    PRIMARY KEY (id)
);";
/*release_result, election_start,election_end*/ 


 $sql6 = "CREATE TABLE mail_mails (
    id int(11) NOT NULL AUTO_INCREMENT,
    sender varchar(128),
    receiver varchar(128),
    title varchar(225),
    message text,
    time varchar(128),
    PRIMARY KEY (id)
);";



 $sqls = array($sql1,$sql2,$sql3,$sql4,$sql5);
$count = 0;
 foreach($sqls as $sql)
 {
 $handle_table_creation = $this->db->query($sql);
 $count++;
  if ($handle_table_creation)
  {

  echo "Table ".$count." sucessfully created"."<br>";

  }
  }
}


}
