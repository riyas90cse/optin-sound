<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>AVCC - Admin Login</title>
    <link href="<?php echo e(url('css/style.default.css')); ?>" rel="stylesheet">
    <style>
    	.error{
			color:red;
		}
    </style>
    <script>
    	function validateLoginForm(form){
			var re_email = /^[a-zA-Z_].+@[a-zA-Z_]+?\.[a-zA-Z]{2,4}$/;
			document.getElementById("error_email").innerHTML = "";
			document.getElementById("error_password").innerHTML = "";
			if(form.email.value){
				if(!re_email.test(form.email.value)) {
					document.getElementById("error_email").innerHTML = "The email must be a valid email address.";
					form.email.focus();
					return false;
				}
			}
			if(form.password.value.length < 4){
					document.getElementById("error_password").innerHTML = "The password must be at least 4 characters.";
					form.password.focus();
					return false;
			}
		    return true;
		}
    </script>
</head>
<body class="signin">      
        <section>
            <div class="panel panel-signin" style="max-width: 340px">
            	<?php if(Session::has('status')): ?>
				<div style="margin:10px 10px 0px 10px; text-align: center" class="alert alert-danger">
					<?php echo e(Session::get('status')); ?>

				 </div>
				<?php endif; ?>
            	<?php if(count($errors) > 0): ?>
				 <div style="margin:10px 10px 0px 10px;" class="alert alert-danger">
				    <ul>
				       <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
				          <li><?php echo e($error); ?></li>
				       <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
				    </ul>
				 </div>
				<?php endif; ?>
                <div class="panel-body">
                    <div class="logo text-center">
                        <img src="<?php echo e(url('images/timetable-logo.png')); ?>" height="120px" alt="Logo" >
                    </div>
                    <br />
                    <h4 class="text-center mb5" style="margin-top: 0px">Sign in to your account</h4>
                    <div class="mb30" style="margin-bottom: 20px"></div>
                    <form method="post" action="<?php echo e(url('login')); ?>" onsubmit="return validateLoginForm(this);">
                    	<?php echo e(csrf_field()); ?>

                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input class="form-control" placeholder="E-mail" name="email" id="email" type="text" required="">
                        </div>
                        <p class="error" id="error_email"></p>
                        <div class="input-group mb15">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                            <input class="form-control" placeholder="Password" name="password" id="password" type="password" required="">
                        </div>
                        <p class="error" id="error_password"></p>
                        <div>
                            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In <i class="fa fa-angle-right ml5"></i></button>
                        </div>                      
                    </form>
                </div>
            </div>
        </section>
        <script src="<?php echo e(url('js/custom.js')); ?>"></script>
    </body>
</html>