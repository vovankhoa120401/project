<?php
if (!isset($_SESSION)) {
    session_start();
}

class cart
{
    public $name;
    public function getAllCart()
    {

        if (isset($_SESSION["cart"])) {

            $array_respone = [
                "success" => true,
                "status_code" => 200,
                "data" => $_SESSION["cart"],
                "message" => "lấy thành công giỏ hàng",
                "error" => false,
            ];
            return ($array_respone);
        } else {

            $array_respone = [
                "success" => false,
                "status_code" => 100,
                "data" => $_SESSION["cart"],
                "message" => "lấy giỏ hàng khoong thành công",
                "error" => true,
            ];
            return ($array_respone);
        }
    }

    public function addcart($id, $amount)
    {

        if (empty($_SESSION["cart"]["totalPrice"])) {
            $_SESSION["cart"]["totalPrice"] = 0;
        }
        if (empty($_SESSION["cart"]["product"])) {
            $_SESSION["cart"]["product"] = [];
        }

        $id = intval($_POST["id"]);
        // kiểm tra sản phẩm đã có trong giỏ hàng hay chưa
        if (isset($_SESSION["cart"]["product"][$id]) == true) {
            $total = $_SESSION["cart"]["totalPrice"] - $_SESSION["cart"]["product"][$id]['amount'] * $_SESSION["cart"]["product"][$id]['price'];

                $_SESSION["cart"]["product"][$id]["amount"] = $amount;
            //thiet lap lai cai san pham do trong gio hang
            $_SESSION["cart"]["product"][$id] = array(
                "amount" => $_SESSION["cart"]["product"][$id]["amount"],
                "price" => $_SESSION["cart"]["product"][$id]["price"],
                "subTotal" => $_SESSION["cart"]["product"][$id]["price"] * $_SESSION["cart"]["product"][$id]["amount"],
            );


            $_SESSION["cart"]["totalPrice"] = $total + $_SESSION["cart"]["product"][$id]['subTotal'];

            //theem thông tin sản phẩm 1 lan nua
            $_SESSION["cart"]["product"][$id] = array(
                "id" => $_POST["id"],
                "name" => $_POST["name"],
                "amount" => $_SESSION["cart"]["product"][$id]["amount"],
                "price" => $_SESSION["cart"]["product"][$id]["price"],
                "subTotal" => $_SESSION["cart"]["product"][$id]["subTotal"],
                "picture" => $_POST["picture"],
            );
            $array_respone = [
                "success" => true,
                "status_code" => 200,
                "data" => [$id, $_SESSION["cart"]["product"][$id]['subTotal'], $_SESSION["cart"]["product"][$id]['name'],$_SESSION["cart"]["product"][$id]['price'], $_SESSION["cart"]['totalPrice'], count($_SESSION["cart"]["product"]),$_SESSION["cart"]["product"][$id]["amount"],$_SESSION["cart"]["product"][$id]["picture"]],
                "message" => "đã thêm vào giỏ hàng thành công",
                "error" => false,
            ];
            echo json_encode($array_respone);
        } else {
            $total = $_SESSION["cart"]["totalPrice"] - $_SESSION["cart"]["product"][$id]['amount'] * $_SESSION["cart"]["product"][$id]['price'];
            if ($amount != 1) {
                $_SESSION["cart"]["product"][$id]["amount"] = $_SESSION["cart"]["product"][$id]["amount"] + $amount;
            }

            $_SESSION["cart"]["product"][$id] = array(
                "amount" => 1,
                "price" => $_POST["price"]
            );

            $_SESSION["cart"]["totalPrice"] = $_SESSION["cart"]["totalPrice"] + $_SESSION["cart"]["product"][$id]["price"];
            //theem thông tin sản phẩm
            $_SESSION["cart"]["product"][$id] = array(
                "id" => $_POST["id"],
                "name" => $_POST["name"],
                "amount" => $_SESSION["cart"]["product"][$id]["amount"],
                "price" => $_POST["price"],
                "subTotal" => $_POST["price"],
                "picture" => $_POST["picture"],
            );

            $array_respone = [
                "success" => true,
                "status_code" => 100,
                "data" => [$id, $_SESSION["cart"]["product"][$id]['subTotal'], $_SESSION["cart"]["product"][$id]['name'],$_SESSION["cart"]["product"][$id]['price'], $_SESSION["cart"]['totalPrice'], count($_SESSION["cart"]["product"]),$_SESSION["cart"]["product"][$id]["amount"],$_SESSION["cart"]["product"][$id]["picture"]],
                "message" => "đã thêm vào giỏ hàng thành công",
                "error" => false,
            ];
            echo json_encode($array_respone);
        }
    }

    public function delProduct($id){
        $_SESSION["cart"]['totalPrice'] = $_SESSION["cart"]['totalPrice'] - $_SESSION["cart"]["product"][$id]['subTotal'];
        unset($_SESSION["cart"]["product"][$id]);
        if(count($_SESSION["cart"]["product"]) == 0) {
            $_SESSION["cart"]['totalPrice'] = 0;
        }
        
        $array_respone = [
            "success" => true,
            "status_code" => 200,
            "data" => [$id,count($_SESSION["cart"]["product"]),$_SESSION["cart"]['totalPrice']],
            "message" => "đã xóa sản phẩm khỏi giỏ hàng thành công",
            "error" => false,
        ];
        echo json_encode($array_respone);
    }
}
