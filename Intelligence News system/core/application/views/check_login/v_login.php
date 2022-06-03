<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>

<link rel="stylesheet" href="assets/css/bootstrap.css">
<link rel="stylesheet" href="assets/css/nova-login.css">
<style>
body { 
    background-image: url('assets/img/bg-login/bg.png');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center; 
	background-size:120%;
}
</style>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">
					<div class="tab-pane active" id="login">
               		    <img class="profile-img" src="assets/img/logo/Logo.png"alt="">
               			<form class="form-signin" action="index.php/check_login" method="POST">
                                        <?php 
                                            if(isset($data) && $data != ""){
                                                echo '<div class="alert alert-danger alert-dismissable mt-20">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <strong>แจ้งเตือน!</strong> <p>รหัสผู้ใช้งานหรือรหัสผ่านไม่ถูกต้อง</p>
                    </div>';
                                            }
                                        ?>
               				<input type="text" class="form-control" name="ua_username" required autofocus>
               				<input type="password" class="form-control" name="ua_password" required>
               				<input type="submit" class="btn btn-lg btn-default btn-block" value="เข้าสู่ระบบ" />
                                        <br>
	               			<label>
				            	<input type="checkbox" name="rememberme" value="1"> จดจำรหัสผู้ใช้งาน
				        </label>
				</form>
               			<div id="tabs" data-tabs="tabs">
<!--               				<p class="text-center"><a href="#register" data-toggle="tab">Need an Account?</a></p>-->
              			</div>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
