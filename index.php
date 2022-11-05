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
$page = isset($_GET['page']) ? $_GET['page'] : 'index';
$path = "./ {$page}.html";

// require './inc/header.php';

if (file_exists($path)) {
    require "{$path}";
}

// require './inc/footer.php';
?>

<script src="<?php echo $config['baseUrl'] ?>/admin/public/js/app.js"></script>
