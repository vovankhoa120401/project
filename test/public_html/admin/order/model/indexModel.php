<?php
 include '../../myhelper.php';
 if(!isset($_SESSION)) 
 { 
     session_start(); 
 }

class order
{

    private $userName;
    private $fullname;
    private $address;
    private $phone_number;
    private $note;
    private $totalPrice;
    private $product;
    public function __construct($username, $fullname, $address, $phone_number,$note, $totalPrice, $product)
    {
        $this->userName = $username;
        $this->fullname = $fullname;
        $this->address = $address;
        $this->phone_number = $phone_number;
        $this->note = $note;
        $this->totalPrice = $totalPrice;
        $this->product = $product;

    }


    public function addOrder(order $order)
    {

        try {
                    $query = sprintf("INSERT INTO tbl_order ( username, fullname, address, phone_number,note, totalPrice, product) VALUE ('%s','%s', '%s','%s', '%s', '%s', '%s')", $order->userName,$order->fullname, $order->address, $order->phone_number,$order->note, $order->totalPrice, $order->product);
                    if (!$result = mysqli_query(connection(), $query)) {
                        echo mysqli_error(connection());
                    } else {
                        $array_respone = [
                            "success" => true,
                            "data" => null,
                            "message" => "thêm người dùng thành công thành công",
                            "error" => true,
                        ];
                        $_SESSION['cart'] = [];
                        echo json_encode($array_respone);
                    }

        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function getOrderById($orderId)
    {

        try {

            if ($orderId == "") {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "không tìm thấy id của khách hàng",
                ];
                echo json_encode($array_respone);

            }

            $query = "SELECT * FROM tbl_order WHERE orderId= $orderId";
            return json_decode(responeCheckQuery($query));

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function getAllOrder()
    {

        try {

            $query = "SELECT * FROM tbl_order";
            return json_decode(responeCheckQuery($query));

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function processingOrder($orderId)
    {
        $query = "UPDATE tbl_order SET status = '0' WHERE orderId = $orderId";

        $row = responeCheckQuery($query);
        echo $row;
        if ($row === []) {
            $array_respone = [
                "success" => false,
                "status_code" => 100,
                "message" => "lấy dữ liệu không thành công",
                "error" => true,
            ];
            echo json_encode($array_respone);
        } else {
            $array_respone = [
                "success" => true,
                "status_code" => 200,
                "message" => "lấy dữ liệu thành công",
                "error" => false,
            ];
            echo json_encode($array_respone);
        }

    }

    public function accomplishedOrder($orderId)
    {
        $query = "UPDATE tbl_order SET status = '0' WHERE orderId = $orderId";

        $row = responeCheckQuery($query);
        echo $row;
        if ($row === []) {
            $array_respone = [
                "success" => false,
                "status_code" => 100,
                "message" => "lấy dữ liệu không thành công",
                "error" => true,
            ];
            echo json_encode($array_respone);
        } else {
            $array_respone = [
                "success" => true,
                "status_code" => 200,
                "message" => "lấy dữ liệu thành công",
                "error" => false,
            ];
            echo json_encode($array_respone);
        }

    }

    public function showProcessingOrder()
    {
        $query = "SELECT * FROM tbl_order WHERE status = '0'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function showAccomplishedOrder()
    {
        $query = "SELECT * FROM tbl_order WHERE status = '1'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function showDelOrder()
    {
        $query = "SELECT * FROM tbl_order WHERE status = '2'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function changeListOrdertatus($orderId = [], $status)
    {
        try {

            if ($orderId == []) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return $array_respone;

            }

            $query = "UPDATE  tbl_order SET status = '$status' WHERE orderId IN (";

            $key = true;

            foreach ($orderId as $catId) {
                if ($key == true) {
                    $key = false;
                } else {
                    $query = $query . ',';
                }

                $query = $query . $catId;
            }

            $query = $query . ')';
            echo responeField($query , $orderId, $status);

        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function getListOrderByUserId($userId)
    {
        try {
            $query = "SELECT * FROM tbl_order WHERE userId = $userId";
            $row = json_decode(responeCheckQuery($query));
            return $row;

        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function getOrderDetail($orderId)
    {
        try {
            $query = "SELECT * FROM tbl_order WHERE orderId = $orderId";
            $row = json_decode(responeCheckQuery($query));
            return $row;

        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    public function delOrder($orderId)
    {
        try {
            $query = "UPDATE tbl_order SET status = '2' WHERE orderId = '$orderId'";
            $row = responeField($query,$orderId,0);
            echo $row;

        } catch (Exception $e) {
        $e->getMessage();
        }
    }
}
