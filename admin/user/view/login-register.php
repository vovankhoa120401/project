<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
$_SESSION['user']['userName'] = "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="./public/css/style.css">
    <script src="<?php echo $config['baseUrl'] ?>/admin/public/ckeditor/ckeditor.js"></script>
    
  </script>
    <title>Admintrator</title>
</head>
    <div class="container">
    <div class="row">
                </div>
        <div class="col-md-12">
            <h1>login</h1>
        </div>
        <div class="panel-body">
            <form action="">
                <div class="form-group">
                    <label for="usr">your's ID: </label>
                    <input required="true" type="text" class="form-control" name="userName" id="usr">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input required="true" type="password" class="form-control" name="password" id="pwd">
                </div>
                <b class="btn btn-success">Login</b>

            </form>

        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(".btn-success").click(function() {
        var userName = $("#usr").val();
        var password = $("#pwd").val();
        var login = "loginUser";
        $.ajax({
            url: "https://xuankhai.000webhostapp.com/admin/user/controller/indexController.php",
            type: "POST",
            data: {
                userName: userName,
                password: password,
                loginUser : login,
            },
            dataType: "json",
            success: function(result) {
                if (result['success'] == true) {
                    window.location = "https://xuankhai.000webhostapp.com/";
                }
                else {
                    alert(result['message']);
                }
            },

        });
    });
    </script>

</html>