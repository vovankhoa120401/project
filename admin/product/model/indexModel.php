<?php
 include '../../myhelper.php';
    class product {
        public $categoryId;
        public $userId;
        public $productName;
        public $decription;
        public $image;
        public $price;
        public $size;
        public $status;
        public $isActive;

        public function __construct($categoryId, $userId, $productName, $decription, $image, $price, $size, $isActive)
        {
            $this->userId = $userId;
            $this->categoryId = $categoryId;
            $this->productName = $productName;
            $this->decription = $decription;
            $this->image = $image;
            $this->price = $price;
            $this->size = $size;
            $this->isActive = $isActive;
        }

        

        public function addProduct(product $product)
    {
        try {
            $error_code = array();
            if (
                $product->categoryId === ''
                || $product->productName === ''
                || $product->image ===''
                || $product->decription ===''
                || $product->price ===''
                || $product->size ===''
                || $product->isActive ===''
            ) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);

            }
            // $order->password, $order->fullName , $order->address, $order->city
            $query = sprintf("INSERT INTO product (categoryId, userId, productName, image, decription, size, price) VALUES (%s,%s,'%s','%s','%s',%s,%s)", $product->categoryId, $product->userId, $product->productName, $product->image, $product->decription, $product->size, $product->price);
            $row = responeField($query,[],0);
            return json_decode($row,true);

        } catch (Exception $e) {

            $e->getMessage();
            
        }
    }

    public function getAllProduct($current_page){
        try {
            if(isset($_SESSION["total_page_product"]) == false){
                $result = mysqli_query(connection(), 'select count(productId) as total from product');
                $row = mysqli_fetch_assoc($result);
                $total_records = $row['total'];
                $limit = 10;
                $total_page = ceil($total_records / $limit);
                $_SESSION["total_page_product"]= $total_page;
            } 
            $limit = 10;
            if ($current_page > $_SESSION["total_page_product"]){
                $current_page = $_SESSION["total_page_product"];
            }
            else if ($current_page <= 1 ){
                $start = 1;
                 $current_page = 1;
                
            } else {
                $current_page = 0;
                $start = $current_page* $limit; 
            };
            if(empty($start)){
            $start = 1;
            }
            $query = "SELECT * , category.categoryName FROM product INNER JOIN category ON product.categoryId = category.categoryId LIMIT $start, $limit";
            echo responeCheckQuery($query);

        } catch (Exception $e) {
            $e->getMessage();
        }
    }

        public function updateProduct(product $product, $productId){
            try {
                $product->userId = 1;
                $error_code = array();
                if (
                    $product->categoryId === ''
                    || $product->productName === ''
                    || $product->image ===''
                    || $product->decription ===''
                    || $product->price ===''
                    || $product->size ===''
                    || $product->isActive ===''
                ) {

                    $array_respone = [
                        "success" => false,
                        "status_code" => 100,
                        "message" => "error",
                        "error" => "lay du lieu khong lieu thanh cong",
                    ];
                    echo json_encode($array_respone);

                }
                // $order->password, $order->fullName , $order->address, $order->city
                $query = "UPDATE  product  set categoryId =  $product->categoryId, userId = $product->userId, productName = '$product->productName', image= '$product->image', decription = '$product->decription' , size = '$product->size', price = $product->price, isActive = '$product->isActive' WHERE productId = $productId";
                $row = responeField($query,[$productId], 0);
                echo $row;

                $array_respone = [
                    "success" => true,
                    "status_code" => 200,
                    "message" => "ban da them thanh cong danh muc ",
                    "error" => "",
                ];
                return $array_respone;


            } catch (Exception $e) {

                $e->getMessage();

            }
        }

    public function delProduct($productId){
        $query = "UPDATE product SET isActive = '0' WHERE productId = $productId";
        echo responeField($query, [$productId],0); 
        
    }

    public function showDeleteProduct(){
        $query = "SELECT * , category.categoryName FROM product INNER JOIN category ON product.categoryId = category.categoryId WHERE isActive = '0'";
        $row = responeCheckQuery($query);
        echo $row;
    }

    public function showStocking(){
        $query = "SELECT * , category.categoryName FROM product INNER JOIN category ON product.categoryId = category.categoryId WHERE status = '1'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function showOutOfStock(){
        $query = "SELECT * , category.categoryName FROM product INNER JOIN category ON product.categoryId = category.categoryId WHERE status = '0'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function getProductById($id){
        try {

            if ($id <= 0) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return json_encode($array_respone);
                
            }

            $query = "SELECT * , category.categoryName FROM product INNER JOIN category ON product.categoryId = category.categoryId WHERE productId = $id";
            $row = responeCheckQuery($query);
            echo $row;
            }
        
            catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function changeListProductStatus($productId=[] , $status){
        try {
            if ($productId == []) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);

            }

            $query = "UPDATE  product SET status = $status WHERE productId IN (";

            $key = true;
            for($i = 0; $i < Count($productId); $i++)
            {
                if ($key == true) {
                    $key = false;
                } else {
                    $query = $query . ',';
                }

                $query = $query . $productId[$i];
            }
            $query = $query . ')';
            echo responeField($query , $productId, $status);
            
        }
        catch (Exception $e)
        {
            $e->getMessage();
        }  
    }

        public function getListProductsByCatId($catId)
        {
            try {

                if ($catId < 0) {
                    $array_respone = [
                        "success" => false,
                        "status_code" => 100,
                        "message" => "error",
                        "error" => "lay du lieu khong lieu thanh cong",
                    ];
                    echo json_encode($array_respone);
                }
                $query = "SELECT * FROM product WHERE categoryId = $catId ";
                echo responeCheckQuery($query);

            } catch (Exception $e) {

                $e->getMessage();

            }
        }

}
