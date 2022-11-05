<?php
include_once '../model/indexModel.php';

if(isset($_POST['addUser'])){
    $userName = $_POST['userName'];
    $fullName = $_POST['fullname'];
    $password = $_POST['password'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $phone_number = $_POST['phone_number'];
    $userID = random_int(100,1000000);

    $customer= new user($userID, $userName, $fullName, $password, $address, $phone_number, $birthday);
    $result = $customer->addUser($customer);
    $_SESSION['info_customer']["userName"] = $userName;
    $_SESSION['info_customer']["fullname"] = $fullName;
    $_SESSION['cart']['totalPrice'] = 0;
    $_SESSION['cart']['product'] = [];

    if ($result['success'] == true ){
        $config = $config['baseUrl'];
header("location: $config/admin/?view=list-user");
    } else {
        $config = $config['baseUrl'];
header("location: $config/admin/?view=add-user");
    }
}   
if(isset($_POST['delUser'])){
    $userId = $_POST['userId'];
    $user = new user(0,0,"","","",0,0,0);
    $user->delUser($userId); 
}
if(isset($_POST['showDeleteuser'])){
    $user = new user(0,0,"","","",0,0,0);
    $user->showDeleteUser();
}
if (isset($_POST['listAction'])){
    if ($_POST['statusUser'] == 0){
        $user = new user(0,0,"","","",0,0,0);
        $user = $user->changeListUserStatus($_POST['listId'], 0);

    }

    if ($_POST['statusUser'] == 1){
        $user = new user(0,0,"","","",0,0,0);
        $user = $user->changeListUserStatus($_POST['listId'], 1);
    }

    if ($_POST['statusUser'] == 2){
        $user = new user(0,0,"","","",0,0,0);
        $user = $user->changeListUserStatus($_POST['listId'], 2);
    }

}

if(isset($_POST['updateUser'])){
    $userName = $_POST['userName'];
    $fullName = $_POST['fullname'];
    $address = $_POST['address'];
    $birthday = $_POST['birthday'];
    $phone_number = $_POST['phone_number'];
    $userId = $_SESSION['user']['userId'];
    $user = new user($_SESSION['user']['userId'],$userName,$fullName,$password,$address,$phone_number, $birthday);
    $result = $user->updateUser($user, $_SESSION['user']['userId']);

    if ($result['success'] == true ){
        $config = $config['baseUrl'];
header("location: $config/admin/?view=list-user");
    } else {
        $config = $config['baseUrl'];
header("location: $config/admin/?view=edit-user&userId=$userId");
    }
}

if (isset($_POST['loginUser'])){
    $userName = $_POST['userName'];
    $password = $_POST['password'];
    $user = new user(0,$userName,"",$password,"",0,0,0);
    $user->checkLogin($user);
}

?>