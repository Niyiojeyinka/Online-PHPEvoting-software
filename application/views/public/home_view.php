
      <div class="body">
        <div class="members_area">
          <div class="top_member_area">Members</div>
          <div class="bottom_member_area">
            <div class="inner_bottom_member">
              Please enter the user id as communicated to you and enter your
              provided password. After entering the login details you would be
              able to select the Candidate(s) for which you intend to vote.<br />
              <br />
              <br />
              <?php
if(isset($_SESSION['action_status_report']))
{
  echo $_SESSION['action_status_report'];
}

              ?>
              <div style="color:red;"><?= validation_errors()?></div>
              
              <form id="form1" name="form1" method="post" action="<?php echo site_url('page/index') ?>">
                <label for="textfield"
                  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;User
                  ID</label
                >
                &nbsp;&nbsp;&nbsp;&nbsp;
                <input
                  name="user_id"
                  type="text"
                  class="text_boxes"
                  id="textfield"
                  size="50"
                  placeholder="ENTER YOUR USER ID"
                />
                <br />
                <br />
                <label for="textfield2"
                  >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Password</label
                >
                &nbsp;
                <input
                  name="password"
                  type="password"
                  class="text_boxes"
                  id="textfield2"
                  size="50"
                  placeholder="ENTER YOUR PASSWORD"
                />
                <br />
                <br />
                <br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input
                  name="button"
                  type="submit"
                  class="login_class"
                  id="button"
                  value="Log In"
                />
              </form>
            </div>
          </div>
        </div>
      </div>
      