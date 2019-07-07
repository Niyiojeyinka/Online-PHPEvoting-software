<div class="w3-container">
	<a class="w3-btn w3-theme w3-round" href="<?=site_url('mail/inbox') ?>"><i class="fa fa-home"> Home</i></a>
<div class="w3-serif w3-small w3-text-theme w3-margin"><?= $mail['title']?></div><br>
<span class="w3-left w3-tiny"><?= date( "F j, Y, g:i a",$mail['time'])?></span><br>
<div class="">
    <?= $mail['message']?>


</div>



</div>