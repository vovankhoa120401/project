<?php 
    require('../model/indexModel.php');
    
    if(isset($_POST['addPost'])){
        $categoryId = $_POST['categoryId'];
        $postTitle = $_POST['postTitle'];
        $content = $_POST['content'];
        $status = $_POST['status'];
        $image = $_FILES['uploadFile']['name'];
        $post = new post($categoryId,$postTitle,$content,$image,$status);
        $result = $post->addPost($post);
        if ($result['success'] == true ){
            $config = $config['baseUrl'];
header("location: $config/admin/?views=list-post");
        } else {
            $config = $config['baseUrl'];
header("location: $config/admin/?views=add-post");

        }
    }
    if(isset($_POST['updatePost'])){
    $categoryId = $_POST['categoryId'];
    $postTitle = $_POST['postTitle'];
    $content = $_POST['content'];
    $status = $_POST['status'];
    $image = $_FILES['uploadFile']['name'];
    $postId = $_POST['updatePost'];
    $post = new post($categoryId,$postTitle,$content,$image,$status);
    $result= $post->updatePost($post, $postId);
        if ($result['success'] == true ){
            $config = $config['baseUrl'];
header("location: $config/admin?views=list-post");
        } else {
            $config = $config['baseUrl'];
header("location: $config/admin?views=edit-post&postId=$postId");

        }
    }
if(isset($_POST['delPost'])){
        $postId = $_POST['postId'];
        $post = new post(0,0,"","","");
        $post->delpost($postId); 
    }
    if(isset($_POST['showDeletePost'])){
        $post = new post(0,0,"","","");
        $post->showDeletePost();
    }
if (isset($_POST['listAction'])) {
    if ($_POST['statusPost'] == 0) {
        $post = new post(0, 0, 0, "", "", "");
        $post = $post->changeListPostStatus($_POST['listId'], 0);

    }

    if ($_POST['statusPost'] == 1) {
        $post = new post(0,0 , 0, "", "", "");
        $post = $post->changeListPostStatus($_POST['listId'], 1);

    }

    if ($_POST['statusPost'] == 2) {
        $post = new post(0,0 , 0, "", "", "");
        $post = $post->changeListPostStatus($_POST['listId'], 2);

    }
}
?>