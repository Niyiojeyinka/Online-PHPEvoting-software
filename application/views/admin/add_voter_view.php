 <div class="w3-twothird w3-center">
 	<div class="w3-text-serif w3-xlarge w3-text-indigo w3-margin"><b class="w3-margin">ADD NEW VOTER</b><br>

 		<i class="fa fa-user w3-jumbo"></i>

 	</div>

<?= form_open() ?>
<div class="w3-text-red"><?=validation_errors() ?></div>

 	<div class="w3-container w3-row">
 		<div class="w3-half">
 			<input type='text' class="w3-padding w3-margin" placeholder="Firstname" name="firstname"/>
<br>
 			<input type="text" class="w3-padding w3-margin" placeholder="Nickname" name="username"/>

<br>

	<input type="email" class="w3-padding w3-margin" placeholder="Email" name="email"/>

	<br>

	<input type="text" class="w3-padding w3-margin" placeholder="Voters ID/Matric No" name="user_id"/>
 		</div>
 		<div class="w3-half">
 			<input type="text" class="w3-padding w3-margin" placeholder="Lastname" name="lastname"/>
<br>
 			<input type="text" class="w3-padding w3-margin" placeholder="Slogan" name="slogan"/>


<br>

	     <input type="password" class="w3-padding w3-margin" placeholder="Email Password" name="epassword"/>
<br>

	     <input type="password" class="w3-padding w3-margin" placeholder="Account Password" name="password"/>
 		</div>

 	</div>
<input type="submit" name="submit" class="w3-btn w3-indigo w3-round-large w3-margin" value="Add Voter"/>
</form>
</div>