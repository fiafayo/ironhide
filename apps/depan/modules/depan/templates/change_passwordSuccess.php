
<div id="sf_admin_container">
    <h1>Ganti Password</h1>
    <div class="sf_admin_list">
<?php
if ( count($errorList)>0 ) {
    foreach ($errorList as $error)
    {
        echo '<div class="error">'.$error.'</div>';
    }
}
?>
        <form action="<?php echo url_for('@change_password'); ?>" method="post">

            <table>
      <tr>
        <th>Password saat ini :</th>
        <td>
            <input type="password" name="password[old]" />
        </td>
      </tr>
      <tr>
        <th>Password yang baru :</th>
        <td>
            <input type="password" name="password[new1]" />
        </td>
      </tr>
      <tr>
        <th>Konfirmasi Password yang baru :</th>
        <td>
            <input type="password" name="password[new2]" />
        </td>
      </tr>
      <tr>
          <td colspan="2"><input type="submit" name="commit" value="Ganti" /></td>
      </tr>
            </table>
        </form>
    </div>
</div>