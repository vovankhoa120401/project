<?php
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
if(empty($_SESSION['cart'])){
    $_SESSION['cart'] = [];
}
if(empty($_SESSION['user']["userName"])){
    $_SESSION['user']["userName"] = "";
}
include_once 'admin/myhelper.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$path = "./pages/{$page}.php";

require './inc/header.php';

if (file_exists($path)) {
    require "{$path}";
} else {
    require "./pages/404.php";
}

require './inc/footer.php';
?>

<script src="<?php echo $config['baseUrl'] ?>/admin/public/js/app.js"></script>
