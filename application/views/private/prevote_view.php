
      <div  class="body" id="prevote">
        <div class="members_area">
          <div class="top_member_area">Time To Go</div>
          <div class="bottom_member_area">
            <div class="inner_bottom_member"><center><br>
            	    <span style="color:rgb(0,0,102);font-size: 83px" class="fa fa-info"></span><br>
            	  Election start by <?=date( "F j, Y, g:i a",(int)$election_start )?><br />
              <br />
              <br />
              
  
           <h1 id='time_div' style="color:rgb(0,0,102);">
      </h1>
            </center>
            
            </div>
          </div>
        </div>
      </div>

<div style="display: none" id="useredirect"></div>

<script type="text/javascript">
    
var myVar = setInterval(myTimer, 1000);

function myTimer() {
    $("#useredirect").load("<?= site_url('dashboard/return_countdown_check') ?>", function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success")
        {

        if(responseTxt == 'start')
        {

     //redirect to voting area
         //in the voting area check for time

           window.location.assign("<?=site_url('dashboard/vote') ?>");

              
        }else if(responseTxt =='stop')
         {
               window.location.assign("<?=site_url('dashboard/post_vote') ?>");
         }
    }
    /* if(statusTxt == "error")
        {
            alert("Network Error: " + xhr.status + ": " + xhr.statusText);
        }*/
    });
}



</script>
