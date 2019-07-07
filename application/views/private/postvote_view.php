
    
  <div id="postvote" class="body">
        <div class="members_area">
          <div class="top_member_area">Election Ended</div>
          <div class="bottom_member_area">
            <div class="inner_bottom_member"><center><br>
                  <span style="color:rgb(0,0,102);font-size: 83px" class="fa fa-info"></span><br>
                Election started by <?=date( "F j, Y, g:i a",(int)$election_start )?><br />
              <br />
              <br />
              
  <span>Election Ended at </span>
           <h1 style="color:rgb(0,0,102);"><?=date( "F j, Y, g:i a",(int)$election_end )?>
      </h1><br>
      <a href="<?=site_url('dashboard/view_result') ?>" style="color:white;margin: 32px;background-color: rgb(0,0,102);text-decoration: none;padding: 16px;" class="confirm_class">View Result</a>
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
