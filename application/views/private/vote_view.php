 <script type="text/javascript">
    var t = setInterval(function (){

var timeToEnd = <?=$election_end ?>;
var rightNow = new Date().getTime();
var rightNow = Math.floor(rightNow/1000);

var margin = timeToEnd-rightNow;
    var  mo =Math.floor(margin/(60*60*24*31));
    var d = Math.floor((margin % (60*60*24*31))/(60*60*24));
    var h = Math.floor(((margin % (60*60*24*31))%(60*60*24))/(60*60));
    
    var m = Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))/(60));
    
  var s =  Math.floor((((margin % (60*60*24*31))%(60*60*24))%(60*60))%(60));
document.getElementById('liveTimer').innerHTML =mo+'<span style="font-size:10px">months</span> '+d+'<span style="font-size:10px">days</span> '+h+'<span style="font-size:10px">hours</span> '+m+'<span style="font-size:10px">minutes</span> '+s+'<span style="font-size:10px">seconds</span> ';

    }, 1000);


  </script>

      <div  class="body" id="prevote">
        <div class="members_area">
          <div class="top_member_area">Vote Your Candidate</div>
          <div class="bottom_member_area">


            <div class="inner_bottom_member"   style="overflow-y: scroll;">
                <center>
                  <span>Election End In</span><br>
<div id="liveTimer" class="">


</div>
<!--error messages here-->

<div>
  <?php
if(isset($_SESSION['error_messages']))
{
  foreach ($_SESSION['error_messages'] as $err) {
    echo $err;
   } 
}

  ?>
</div>
                 <br>
              <!-- voting area-->
<div class=""  style="overflow-y: scroll;">
<?= form_open('dashboard/vote') ?>
<?php
for ($i=0; $i < count($holder); $i++) {
echo "<span style=''>".$holder[$i]['position_name']."</span><br>";

  if(empty( $holder[$i]['candidates']))
  {
echo "<br><span style='font-size:8px'>No Candidate For this Post</span><br><br>";
  }else{
echo "<select style='padding-top:5px;padding-bottom:5px;' name='".$holder[$i]['position_id']."'>";
  echo "<option value=''>Choose</option>";

foreach ($holder[$i]['candidates'] as $candidate) {
  
  echo "<option value='".$candidate['user_id']."'>".$candidate['firstname']." ".$candidate['lastname']." (".$candidate['username'].")</option>";
}
    echo "</select>";
echo "<br><br>";

echo "</select>";

}
}

?>

<input  style='background-color:rgb(0,0,102);padding-top:5px;padding-bottom:5px;' type="submit" class="" name="submit" value="Vote Now"/>


</form>

</div>


            	    
            </center>
            
            </div>
          </div>
        </div>
      </div>


<div style="display: none;" id="usediv"></div>

<script type="text/javascript">
   
var myVar = setInterval(myTimer, 500);

function myTimer() {
    $("#usediv").load("<?= site_url('dashboard/return_countdown_check') ?>", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
        {
        
       if(responseTxt =='stop')
         {
               window.location.assign("<?=site_url('dashboard/post_vote') ?>");
         }else if(responseTxt =='wait')
        {
               
               window.location.assign("<?=site_url('dashboard') ?>");


        }
    }
    /* if(statusTxt == "error")
        {
            alert("Network Error: " + xhr.status + ": " + xhr.statusText);
        }*/
    });
}



</script>
