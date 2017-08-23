<?php
//TODO ev ändra till mindre regler
session_save_path('session');
//session_save_path("../../Documents/session");
if(!isset($_SESSION))
{
    session_start();
}
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
include 'includes/navbar.php';
?>
<h1>Register with us!</h1>
<?php
if (!empty($error_msg)) {
    echo $error_msg;
}
?>
<!--div class="registerBox"-->
<div class="well ">
    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading"></div>
        <div class="panel-body ">
            <div class="list-group ">

                <ul>
                    <li>Usernames may contain only digits, upper and lowercase letters and underscores</li>
                    <li>Emails must have a valid email format</li>
                    <li>Passwords must be at least 6 characters long</li>
                    <li>Passwords must contain:
                        <ul>
                            <li>At least one uppercase letter (A..Z)</li>
                            <li>At least one lowercase letter (a..z)</li>
                            <li>At least one number (0..9)</li>
                        </ul>
                    </li>
                    <li>Your password and confirmation must match exactly</li>
                </ul>

                <form class="formClass col-sm-3 col-md-offset-5" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" name="registration_form">
                    <ul class="list-group">
                        <li class="list-group-item"><label for="username">Username: </label><input type='text' name='username' id='username' /></li>
                        <li class="list-group-item"><label for="email">Email: </label><input type="text" name="email" id="email"/></li>
                        <li class="list-group-item"><label for="password">Password: </label><input type="password" name="password" id="password"/></li>
                        <li class="list-group-item"><label for="confirmpwd">Confirm password: </label><input type="password" name="confirmpwd" id="confirmpwd"/></li>
                        <li class="list-group-item inputClass"><input type="button" value="Register" onclick="return regformhash(this.form, this.form.username,
                                this.form.email, this.form.password,this.form.confirmpwd);"/></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>

    <?php include("includes/scripts.php"); ?>
</body>
</html>