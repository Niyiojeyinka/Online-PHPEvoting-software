<div class="w3-twothird w3-center">
<?php
	if($election_start > time() && time() < $election_end)
{
	echo 'Election is Currently On and ends by <span class="w3-text-red">'.date("F j, Y, g:i a",$election_end).'</span><br>';
}
	?><br><div class="<?php  
if($election_end > time())
{
	echo 'w3-hide';
}
	?>">
	<span class="w3-serif w3-text-xlarge w3-text-indigo">
		SET ELECTION TIME & DATE
	</span>
	<?php

if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}

	?>
  
<?= form_open('admin/set_time') ?>

<span>Day  Month Year</span><br>
<select class="w3-padding" name='day'>

<?php
for ($i=1; $i <32 ; $i++) { 
echo "<option value'".$i."'>".$i."</option>";
}
?>
</select>


<select class="w3-padding" name='month'>
<option value="1">JANUARY</option>
<option value="2">FEBRUARY</option>
<option value="3">MARCH</option>
<option value="4">APRIL</option>
<option value="5">MAY</option>
<option value="6">JUNE</option>
<option value="7">JULY</option>
<option value="8">AUGUST</option>
<option value="9">SEPTEMBER</option>
<option value="10">OCTOBER</option>
<option value="11">NOVEMBER</option>
<option value="12">DECEMBER</option>
</select>

<select class="w3-padding" name='year'>

<?php
for ($i=2019; $i <= 2099 ; $i++) { 
echo "<option value='".$i."'>".$i."</option>";
}
?>
</select>
<br>
<span class="w3-text-indigo w3-serif">Election Start Time</span><br>
<input class="w3-padding" type="time" name="stime"/><br>

<br>
<span class="w3-text-indigo w3-serif">Election Duration</span><br>
<select class="w3-padding" name='duration'>

<?php
for ($i=5; $i < 1440 ; $i = $i+5) { 
	if($i < 60)
	{
echo "<option value='".$i."'>".$i." Minutes</option>";
	}
}

for ($i=1; $i <= 48 ; $i++) { 
	if($i < 60)
	{
echo "<option value='".($i*60)."'>".$i." Hours</option>";
	}
}
?>
</select>
<br>

<input type="submit" name="submit" class="w3-btn w3-indigo w3-margin w3-round" value="Set Time"/>

</form>

 <?php  
if($election_end < time() && $release_result =='false')
{
	echo 'Election End : You can release Result by clicking on Release Result Button Below';
}elseif($release_result =='true'){

echo "Result Released";
	
}
?>
<table style="max-width: 80%;" class="w3-table w3-margin w3-striped <?php  
if($election_end > time())
{
	echo 'w3-hide';
}
	?>">
	<tr class="w3-green"><td>Election Start</td><td><?=date("F j, Y, g:i a",$election_start) ?></td></tr>
		<tr class="w3-red"><td>Election End</td><td><?=date("F j, Y, g:i a",$election_end) ?></td></tr>

</table>
</div>
<hr>

<br>
	<span class="w3-serif w3-text-xlarge w3-text-indigo">
	Result Manager	
	</span><br>

<a class="w3-btn w3-indigo w3-round w3-margin"href="<?= site_url('admin/release_result'); ?>" ><?php if($release_result =='true'){

echo "View Result";
	
}else{
	echo "Release Result";
}
?></a>






  </div