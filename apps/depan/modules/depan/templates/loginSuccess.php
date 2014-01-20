
<div id="sf_admin_container">
    <h1>Login ke Sistem</h1>
    <div class="sf_admin_list">
 
        <form action="<?php echo url_for('depan/login'); ?>" method="post">
            <input type="hidden" name="login[referer]" value="<?php echo $sf_request->getReferer() ? $sf_request->getReferer() : $_SERVER['PHP_SELF'] ?>" />
            <table>
      <tr>
        <th>Username :</th>
        <td>
            <input type="text" name="login[username]" />
        </td>
      </tr>
      <tr>
        <th>Password :</th>
        <td>
            <input type="password" name="login[password]" />
        </td>
      </tr>
      <tr>
          <td colspan="2"><input type="submit" name="commit" value="Login" /></td>
      </tr>
            </table>
        </form>
    </div>
</div>
