<?php
    global $chk;
    if(isset($_POST['wphw_submit'])){
            wphw_opt();
    }
    function wphw_opt(){
        $nothing = $_POST['nothing'];
        $showdescription = $_POST['showdescription'];
        $showphotoscount = $_POST['showphotoscount'];
        global $chk;
        if( get_option('mc_17_nothing') != trim($nothing)){
            $chk = update_option( 'mc_17_nothing', trim($nothing));
        }
        if (get_option('mc_17_showdescription') != $showdescription) {
            $chk = update_option( 'mc_17_showdescription', $showdescription);
        }
        if (get_option('mc_17_showphotoscount') != $showphotoscount) {
            $chk = update_option( 'mc_17_showphotoscount', $showphotoscount);
        }
    }
?>
<div class="wrap">
  <div id="icon-options-general" class="icon32"> <br>
  </div>
  <h2>Footer Settings</h2>
  <?php if(isset($_POST['wphw_submit']) && $chk):?>
  <div id="message" class="updated below-h2">
    <p>Content updated successfully</p>
  </div>
  <?php endif;?>
  <div class="metabox-holder">
    <div class="postbox">
      <h3><strong>Enter footer text and click on save button.</strong></h3>
      <form method="post" action="">
        <table class="form-table">
          <tr>
            <th scope="row">nothing</th>
            <td><input type="text" name="nothing" 
value="<?php echo get_option('mc_17_nothing');?>" style="width:350px;" /></td>
          </tr>
          <tr>
            <th scope="row">Show Description</th>
            <td><input name="showdescription" type="checkbox" value="1" <?php checked( '1', get_option( 'mc_17_showdescription' ) ); ?> /></td>
          </tr>
          <tr>
            <th scope="row">Show photos count</th>
            <td><input name="showphotoscount" type="checkbox" value="1" <?php checked( '1', get_option( 'mc_17_showphotoscount' ) ); ?> /></td>
          </tr>
          <tr>
            <th scope="row">&nbsp;</th>
            <td style="padding-top:10px;  padding-bottom:10px;">
<input type="submit" name="wphw_submit" value="Save changes" class="button-primary" />
</td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>