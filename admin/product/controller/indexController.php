<?php
session_start();
require('../model/indexModel.php');

if (isset($_POST['addProduct'])) {
    $userId = $_SESSION['user']['userId'];
    $categoryId = $_POST['categoryId'];
    $productName = $_POST['productName'];
    $decription = $_POST['decription'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $isActive = $_POST['isActive'];
    $image = $_SESSION['image_name'];
    $product = new Product($categoryId, $userId, $productName, $decription, $image, $price, $size, $isActive);
    $result = $product->addProduct($product);
    if ($result['success'] == true) {
        $config = $config['baseUrl'];
        header("location: $config/admin/?view=list-product");
    } else {
        $config = $config['baseUrl'];
        header("location: $config/admin/?view=add-product");
    }
}

// $product = new Product(0, 0, 0, 0, 0, 0, 0, 0);
// $product->getAllProduct(1);
if (isset($_POST['delProduct'])) {
    $productId = $_POST['productId'];
    $isActive = $_POST['isActive'];
    $product = new Product(0, 0, "", "", "", 0, 0, $isActive);
    echo $product->delProduct($productId);
}

if (isset($_POST['updateProduct'])) {
    $categoryId = $_POST['categoryId'];
    $productName = $_POST['productName'];
    $decription = $_POST['decription'];
    $size = $_POST['size'];
    $price = $_POST['price'];
    $isActive = $_POST['isActive'];
    $image = $_FILES['uploadFile']['name'];
    $productId = $_POST['updateProduct'];
    $product = new Product($categoryId, 0, $productName, $decription, $image, $price, $size, $isActive);
    echo $product->updateProduct($product, $productId);
    // if ($result['success'] == true) {
    //     $config = $config['baseUrl'];
    //     header("location: $config/admin/?view=list-product");
    // } else {
    //     $config = $config['baseUrl'];
    //     header("location: $config/admin/?view=edit-product&productId=$productId");
    // }
}

if (isset($_GET['isShowDeleteProduct'])) {
    $product = new Product(0, 0, "", "", "", 0, 0, 0);
    echo $product->showDeleteProduct();
}
if (isset($_POST['listAction'])) {
    if ($_POST['statusProduct'] == 0) {
        $product = new Product(0, 0, "", "", "", 0, 0, 0);
        echo $product->changeListProductStatus($_POST['listId'], 0);
    }
    if ($_POST['statusProduct'] == 1) {
        echo $_POST['listId'];
        $product = new Product(0, 0, "", "", "", 0, 0, 0);
        echo $product->changeListProductStatus($_POST['listId'], 1);
    }

    if ($_POST['statusProduct'] == 2) {
        $product = new Product(0, 0, "", "", "", 0, 0, 0);
        echo $product->changeListProductStatus($_POST['listId'], 2);
    }
}

if (isset($_GET['getProductByCatId']))
{
    echo $product->getListProductsByCatId($_POST['catId']);
}
