<div class="w3-container">
	
<span class="w3-serif w3-large w3-text-theme w3-margin">INBOX</span>

<?php

if(!empty($mails))
{
	foreach ($mails as $mail) {

    echo "<a href='".site_url('mail/view_mail/'.$mail['id'])."'>";
	echo "<div class='w3-margin w3-border w3-border-black w3-padding'>";
     echo "<span class='w3-margin'>".$mail['title']."</span>";
     echo "<span class='w3-small w3-text-gray w3-right'>".date( "F j, Y, g:i a",$mail['time'])."</span>";
     echo "</div>";
          echo "</a>";

     	}

}else{
	echo "<br><br><i class='w3-small'>No Mail in Your inbox yet</i><br>";
}









?>


</div>