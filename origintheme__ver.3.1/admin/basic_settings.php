<div class="wrap">
    <h2>基本情報設定</h2>
    <form method="post" action="options.php">
      <?php
    settings_fields( 'basic-settings-group' );
    do_settings_sections( 'basic-settings-group' );
    ?>
      <table class="form-table">
        <tbody>
          <tr>
            <th scope="row">
              <label for="basic_name">会社・施設名</label>
            </th>
              <td><input type="text" id="basic_name" class="regular-text" name="basic_name" value="<?php echo get_option('basic_name'); ?>"></td>
          </tr>
            <th scope="row">
              <label for="basic_tel">電話番号</label>
            </th>
              <td><input type="text" id="basic_tel" class="regular-text" name="basic_tel" value="<?php echo get_option('basic_tel'); ?>"></td>
          </tr>
          <tr>
            <th scope="row">
              <label for="basic_fax">FAX番号</label>
            </th>
              <td><input type="text" id="basic_fax" class="regular-text" name="basic_fax" value="<?php echo get_option('basic_fax'); ?>"></td>
          </tr>
          <tr>
            <th scope="row">
              <label for="basic_zipcode">郵便番号</label>
            </th>
              <td><input type="text" id="basic_zipcode" class="regular-text" name="basic_zipcode" value="<?php echo get_option('basic_zipcode'); ?>"></td>
          </tr>
          <tr>
            <th scope="row">
              <label for="basic_address">住所</label>
            </th>
              <td><input type="text" id="basic_address" class="regular-text" name="basic_address" value="<?php echo get_option('basic_address'); ?>"></td>
          </tr>
          <tr>
            <th scope="row">
              <label for="basic_reception_time">受付時間</label>
            </th>
              <td><input type="text" id="basic_reception_time" class="regular-text" name="basic_reception_time" value="<?php echo get_option('basic_reception_time'); ?>"></td>
          </tr>
          <tr>
            <th scope="row">
              <label for="basic_reception_time">facebook</label>
            </th>
              <td><input type="text" id="basic_facebook" class="regular-text" name="basic_facebook" value="<?php echo get_option('basic_facebook'); ?>"></td>
          </tr>
        </tbody>
      </table>
      <?php submit_button(); ?>
    </form>
  </div>