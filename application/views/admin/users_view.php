<div class="w3-twothird">


<div class="w3-center">

<b class="w3-center w3-text-grey w3-xlarge">Users</b><br>

<div class="w3-text-red"><?php
if(isset($_SESSION['action_status_report']))
{
	echo 
 $_SESSION['action_status_report'];
}



?>
</div>
<br>
<?= form_open('admin/voters') ?>

<input type="text" name="searchkeyword" placeholder="Search Users" class="w3-padding w3-border" />

<input type="submit" name="submit" value="Search" class="w3-btn w3-blue"><br>

<select name="type" class="w3-padding">
	<option value="user_id">User ID/Matric NO</option>
	<option value="email">By Email</option>
</select>
</form>

</form>
<?php

if (!empty($voters))
{

foreach ($voters as $item)
{

if($item['candidate'] == "1")
{
$color = "w3-text-green";

}else{

$color = "";


}
 
echo "<div class='w3-container w3-border w3-padding w3-margin ".$color."'>";
echo "<span class='w3-large'>".$item['firstname']." ".$item['lastname']." ".$item['username']."</span><br>";
if($item['candidate'] == '1')
{
foreach ($offices as $office) {
if($office['id'] == $item['position'])
{
	echo "(".$office['label'].")<br>";

}
}
}


if($item['candidate'] == "0")
{
echo "   <a class='w3-small w3-btn w3-indigo' href='".site_url('admin/mark_as_candidate/'.$item['id'])."'>Mark as Candidate</a>";
}else{
echo "   <a class='w3-small w3-btn w3-indigo' href='".site_url('admin/mark_as_candidate/'.$item['id'])."'>Change Office</a>";

     echo "   <a class='w3-tiny w3-btn w3-indigo' href='".site_url('admin/remove_candidate/'.$item['id'])."'>Remove as Candidate</a>";

}
  echo "   <a class='w3-tiny w3-btn w3-red w3-round-jumbo w3-margin-left' href='".site_url('admin/delete_candidate/'.$item['id'])."'><i class='fa fa-close'></i></a>";

echo "</div>";
}



echo $pagination;

}else{
echo "No user entries";

}


?>


</ul>
</div>
