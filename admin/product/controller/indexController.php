<?php
session_start();
    require('../model/indexModel.php');
    
    if(isset($_POST['addProduct'])){
        $userId = $_SESSION['user']['userId'];
        $categoryId = $_POST['categoryId'];
        $productName = $_POST['productName'];
        $decription = $_POST['decription'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $isActive = $_POST['isActive'];
        $image = $_SESSION['image_name'];
        $product = new Product($categoryId,$userId,$productName,$decription,$image,$price,$size,$isActive);
        $result = $product->addProduct($product);
        if ($result['success'] == true ){
            $config = $config['baseUrl'];
header("location: $config/admin/?view=list-product");
        } else {
            $config = $config['baseUrl'];
header("location: $config/admin/?view=add-product");

        }
    }  
    
    if(isset($_POST['getAllProduct']))
    {
        $product = new Product(0,0,0,0,0,0,0,0);
         $product->getAllProduct(1);
    }
    if(isset($_POST['delProduct'])){
        $productId = $_POST['productId'];
        $isActive = $_POST['isActive'];
        $product = new Product(0,0,"","","",0,0,$isActive);
        $product->delProduct($productId); 
    }

    if(isset($_POST['updateProduct'])){
        $userId = $_SESSION['user']['userId'];
        $categoryId = $_POST['categoryId'];
        $productName = $_POST['productName'];
        $decription = $_POST['decription'];
        $size = $_POST['size'];
        $price = $_POST['price'];
        $isActive = $_POST['isActive'];
        $image = $_FILES['uploadFile']['name'];
        $productId = $_POST['updateProduct'];
        $product = new Product($categoryId,$userId,$productName,$decription,$image,$price,$size,$isActive);
        $result = $product->updateProduct($product, $productId);

        if ($result['success'] == true ){
            $config = $config['baseUrl'];
header("location: $config/admin/?view=list-product");
        } else {
            $config = $config['baseUrl'];
header("location: $config/admin/?view=edit-product&productId=$productId");

        }

    }

    if(isset($_POST['click'])){
        $product = new Product(0,0,"","","",0,0,0);
        $product->showDeleteProduct();
    }
    if (isset($_POST['listAction'])){
        if ($_POST['statusProduct'] == 0){
            $product = new Product(0,0,"","","",0,0,0);
            $product->changeListProductStatus($_POST['listId'], 0);

        }
        if ($_POST['statusProduct'] == 1){
            $product = new Product(0,0,"","","",0,0,0);
            $product = $product->changeListProductStatus($_POST['listId'], 1);

        }

        if ($_POST['statusProduct'] == 2){
            $product = new Product(0,0,"","","",0,0,0);
            $product = $product->changeListProductStatus($_POST['listId'], 2);

        }
    }

?>