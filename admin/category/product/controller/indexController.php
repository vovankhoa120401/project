<?php

    include_once '../model/indexModel.php';

    if(isset($_POST['addCat'])) {
        $parenId = $_POST['parentId'];
        echo $parentId;
        $categoryName = $_POST['categoryName'];
        $userId = $_POST['userId'];
        $category = new category($userId,$categoryName,$parenId);
        echo $category->addCategory($category);
    }

    if(isset($_GET['getAllCategory']))
    {
        $category = new category(0,'',0);
        echo $category->getAllCategory();
    }

    if(isset($_GET['isGetCatId']))
    {
        $category = new category($_POST['catId'],'',0);
        echo $category->getAllCategory();
    }

    if(isset($_GET['isGetParentCatId']))
    {
        $category = new category(0,'',$_POST['parentCatId']);
        echo $category->getParentCategory();
    }

?>