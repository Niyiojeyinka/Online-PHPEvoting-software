
      <div class="body">
        <div class="members_area">
          <div class="top_member_area">Security (OTP)</div>
          <div class="bottom_member_area">
            <div class="inner_bottom_member">
              Please enter the OTP code sent to your email in input Field Below.<br />
              <br />
              <br />
              <?php
if(isset($_SESSION['action_status_report']))
{
  echo $_SESSION['action_status_report'];
}

              ?>
              <div style="color:red;"><?= validation_errors()?></div>
              
              <form id="form1" name="form1" method="post" action="<?php echo site_url('page/confirm_otp') ?>">
                <label for="textfield"
                  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;OTP CODE</label
                >
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input
                  name="email_vc"
                  type="text"
                  class="text_boxes"
                  id="textfield"
                  size="50"
                  placeholder="ENTER YOUR OTP"
                />

                <br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input
                  name="button"
                  type="submit"
                  class="confirm_class"
                  id="button"
                  value="Confirm OTP"
                />
              </form>
            </div>
          </div>
        </div>
      </div>
      