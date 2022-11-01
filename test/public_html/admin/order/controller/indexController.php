<?php


include_once '../model/indexModel.php';

if(isset($_POST['order'])){
    $username = $_SESSION['user']['userName'];
    $fullname = $_POST['fullname'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $note = $_POST['note'];
    $product = json_encode($_SESSION['cart']['product']);
    echo $product;
    $order = new order($username,$fullname,$address,$phone_number,$note,$_SESSION['cart']['totalPrice'],$product);
    $order->addOrder($order);

}
if (isset($_POST['delOrder'])) {
    $orderId = $_POST['orderId'];
    $order = new order(0, 0, "", "", "", 0, 0, 0);
    $order->delOrder($orderId);
}
if (isset($_POST['showProcessingOrder'])) {
    $customer = new order(0, 0, "", "", "", 0, 0, 0);
    $customer->showProcessingOrder();
}
if (isset($_POST['showAccomplishedOrder'])) {
    $order = new order(0, 0, "", "", "", 0, 0, 0);
    $order = $order->showAccomplishedOrder();
}

if(isset($_POST['statusOrder'])) {
    if($_POST['statusOrder'] == "Đã hoàn thành") {
        $order = new order(0, 0, "", "", "", 0, 0, 0);
            $order = $order->changeListOrdertatus([$_POST['orderId']], 0);
    } else {
        $order = new order(0, 0, "", "", "", 0, 0, 0);
            $order = $order->changeListOrdertatus([$_POST['orderId']], 1);
    }
}

if(isset($_POST['listAction'])) {
    if ($_POST['listStatusOrder'] == 1) {
    $order = new order(0, 0, "", "", "", 0, 0, 0);
    $order = $order->changeListOrdertatus($_POST['listId'], 1);

    } else  if ($_POST['listStatusOrder'] == 0 ){
        $order = new order(0, 0, "", "", "", 0, 0, 0);
        $order = $order->changeListOrdertatus($_POST['listId'], 0);
    } else {
        $order = new order(0, 0, "", "", "", 0, 0, 0);
        $order = $order->changeListOrdertatus($_POST['listId'], 2);
    }


}


