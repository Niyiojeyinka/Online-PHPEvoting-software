<div class="w3-container">
	<?= form_open('mail/index') ?>
	<?="<div class='w3-text-red'>".validation_errors()."</div>" ?>
	<?php
if(isset($_SESSION['action_status_report']))
{
	echo $_SESSION['action_status_report'];
}

	?>
<span class="w3-text-theme">Email:</span><br>
<input type="email" name="email" class="w3-padding w3-round" placeholder="yourname@group7.com"/>	<br>
<span class="w3-text-theme">Password:</span><br>
<br>
<input type="password" name="password" class="w3-padding w3-round" placeholder="Password"/>	
<br>
<input type="submit" name="submit" value="Login" class="w3-btn w3-theme w3-margin"/>
<br>
</div>