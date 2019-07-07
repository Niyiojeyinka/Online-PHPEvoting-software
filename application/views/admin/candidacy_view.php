 <div class="w3-twothird w3-center">
 	<div class="w3-text-serif w3-xlarge w3-text-indigo w3-margin"><b class="w3-margin">CHOOSE OFFICE</b><br>

 		<i class="fa fa-plus w3-jumbo"></i>

 	</div>
 	<?php
if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}
?>
<?= form_open('admin/mark_as_candidate/'.$this->uri->segment(3)) ?>
<div class="w3-text-red"><?=validation_errors() ?></div>


<div class="w3-container w3-margin w3-padding">
	<span class="w3-serif w3-large"><?=$candidate['firstname'].' '.$candidate['lastname'].' '.'('.$candidate['lastname'].')' ?></span><br>
<?php
if (!empty($offices))
{
	echo "<select class='w3-padding' name='office'>";

foreach ($offices as $office) {


echo "<option value='".$office['id']."'>".$office['label']." (".$office['short_form'].")</option>";

}
	echo "</select>";

}else{
	echo 'No office/post Yet';
}

?>

</div>
<input type="submit" name="submit" class="w3-btn w3-indigo w3-round-large w3-margin" value="Choose Office"/>
</form>
</div>