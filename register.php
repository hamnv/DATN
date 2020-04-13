<?php include'header.php'; ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Tutorial-22</title>
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript"
src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.14.0/jquery.validate.min.js">
</script>
<link href="style.css" rel="stylesheet" type="text/css" media="screen">
<script type="text/javascript" src="script.js"></script>
</head>
<body>
<div class="signin-form">
    <div class="container">
        <form class="form-signin" method="post" id="register-form">
            <h2 class="form-signin-heading">Sign Up</h2><hr />
            <div id="error">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Email address" name="user_email" id="user_email" />
                <span id="check-e"></span>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Retype Password" name="cpassword" id="cpassword" />
            </div>
            <hr />
                <div class="form-group">
                <button type="submit" class="btn btn-default" name="btn-save" id="btn-submit">
                	<span class="glyphicon glyphicon-log-in"></span>   Create Account
                </button>
            </div>
        </form>
    </div>
</div>
<script> 
$('document').ready(function()
{
    /* validation */
    $("#register-form").validate({
        rules:
        {
            password: {
                required: true,
                minlength: 6,
            },
            cpassword: {
                required: true,
                equalTo: '#password'
            },
            user_email: {
                required: true,
                email: true
            },
        },
        messages:
        {
            password:{
                required: "Xin hãy nhập mật khẩu",
                minlength: "Mật khẩu tối thiểu 6 ký tự"
            },
            user_email: "Xin hãy nhập email hợp lệ",
            cpassword:{
                required: "Xin hãy nhập lại mật khẩu",
                equalTo: "Mật khẩu không khớp !"
            }
        },
        submitHandler: submitForm
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
        var data = $("#register-form").serialize();

        $.ajax({

            type : 'POST',
            url  : 'register-process.php',
            data : data,
            beforeSend: function()
            {
                $("#error").fadeOut();
                $("#btn-submit").html('<span class="glyphicon glyphicon-transfer"></span>   sending ...');
            },
            success :  function(data)
            {
                if(data==1){

                    $("#error").fadeIn(1000, function(){


                        $("#error").html('<div class="alert alert-danger"> <span class="glyphicon glyphicon-info-sign"></span> Email đã tồn tại !</div>');

                        $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span>   Create Account');

                    });

                }
                else if(data=="registered")
                {

                    $("#btn-submit").html('Signing Up');
                    setTimeout('$(".form-signin").fadeOut(500, function(){ $(".signin-form").load("../index.php"); }); ',5000);

                }
                else{

                    $("#error").fadeIn(1000, function(){

                        $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span>   '+data+' !</div>');

                        $("#btn-submit").html('<span class="glyphicon glyphicon-log-in"></span>   Create Account');

                    });

                }
            }
        });
        return false;
    }
    /* form submit */

});
</script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>