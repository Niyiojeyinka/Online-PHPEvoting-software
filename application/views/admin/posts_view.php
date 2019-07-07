 <div class="w3-twothird w3-center">
 	<div class="w3-text-serif w3-xlarge w3-text-indigo w3-margin"><b class="w3-margin">ADD NEW OFFICE</b><br>

 		<i class="fa fa-building w3-jumbo"></i>

 	</div>
 	<?php
if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}
?>
<?= form_open('admin/posts') ?>
<div class="w3-text-red"><?=validation_errors() ?></div>

 	<div class="w3-container w3-row">
 		<div class="w3-half">
 			<input type='text' class="w3-padding w3-margin" placeholder="Office/Post" name="label"/>
<br>
 		
 		</div>
 		<div class="w3-half">
 			<input type="text" class="w3-padding w3-margin" placeholder="Short Form e.g ASG" name="short_form"/>
 		</div>

 	</div>
<input type="submit" name="submit" class="w3-btn w3-indigo w3-round-large w3-margin" value="Add Office"/>
</form>
<div class="w3-container w3-margin w3-padding">
	
<?php
if (!empty($offices))
{

foreach ($offices as $office) {

echo "<span class='w3-border w3-padding w3-margin'>".$office['label']."(".$office['short_form'].") <a href='".site_url('admin/delete_post/'.$office['id'])."'><i class='fa fa-close w3-text-red'></i></a></span><br><br>";
}

}else{
	echo 'No office/post Yet';
}

?>

</div>
</div>