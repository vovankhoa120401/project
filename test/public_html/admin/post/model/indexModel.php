<?php
    include '../../myhelper.php';
    class post {
        public $categoryId;
        public $postTitle;
        public $content;
        public $image;
        public $status;

        public function __construct( $categoryId, $postTitle, $content,$image, $status)
        {
            $this->categoryId = $categoryId;
            $this->postTitle = $postTitle;
            $this->content = $content;
            $this->image = $image;
            $this->status = $status;

        }

        public function addpost(post $post)
    {
        try {
            $error_code = array();
            if (
                $post->categoryId === '' ||
                $post->postTitle === '' ||
                $post->content === '' ||
                $post->status === ''
            ) {

                $error_code['error_field'] = "bạn chưa nhập đủ các thông tin";


            }
            // $order->password, $order->fullName , $order->address, $order->city
            $query = sprintf("INSERT INTO post (categoryId, postTitle, content, image, status) VALUES (%s,'%s','%s','%s',%s)", $post->categoryId,$post->postTitle, $post->content,$post->image, $post->status);
            if ($result = mysqli_query(connection(), $query)) {
                    $error_code['error_add'] = "tạo mới dữ liệu không thành công";
            } else {
                if(count($error_code) > 0){
                    $array_respone = [
                        "success" => false,
                        "status_code" => 100,
                        "message" => "error",
                        "error" => $error_code,
                    ];
                    return $array_respone;
                }
    
                    $array_respone = [
                        "success" => true,
                        "status_code" => 200,
                        "message" => "ban da them thanh cong danh muc ",
                        "error" => "",
                    ];
                    echo json_encode($array_respone);
            }

            


        } catch (Exception $e) {

            $e->getMessage();
            
        }
    }

        public function updatePost(post $post, $postId)
        {
            try {
                $error_code = array();
                if (
                    $post->categoryId === '' ||
                    $post->postTitle === '' ||
                    $post->content === '' ||
                    $post->status === ''
                ) {

                    $error_code['error_field'] = "bạn chưa nhập đủ các thông tin";


                }
                // $order->password, $order->fullName , $order->address, $order->city
                $query = "Update post set categoryId = $post->categoryId, postTitle = '$post->postTitle', content = '$post->content', image = '$post->image' WHERE postId = $postId;";
                $row = json_decode(responeField($query,[$postId], 0),true);
                return $row;

            } catch (Exception $e) {

                $e->getMessage();

            }
        }

    public function getAllpost($current_page){ //ss
        try {
            if(isset($_SESSION['total_page_post']) == false){
                $result = mysqli_query(connection(), 'select count(postId) as total from post');
                $row = mysqli_fetch_assoc($result);
                $total_records = $row['total'];
                $limit = 10;
                $total_page = ceil($total_records / $limit);
                $_SESSION['total_page_post']= $total_page;
            }
            $limit = 10;
            if ($current_page > $_SESSION['total_page_post']){
                $current_page = $_SESSION['total_page_post'];
            }
            else if ($current_page <= 1 ){
                $current_page = 1;
                $start = 0;
            } else {
                $current_page = 0;
                $start = $current_page* $limit; 
            }
            // $query = "SELECT  post.postId, category.categoryName, post.userId, post.postName, post.decription, post.image, post.price, post.size, post.isActive, post.status, post.createdAt, post.updatedAt FROM post INNER JOIN category ON post.categoryId = category.categoryId ";
            $query = "SELECT * , category.categoryName FROM post INNER JOIN category ON post.categoryId = category.categoryId LIMIT $start,$limit";
            return json_decode(responeCheckQuery($query));

        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function delpost($postId){
        $query = "UPDATE post SET status = '0' WHERE postId = $postId";
        $row = responeField($query, [$postId], 0); 
        echo $row;        
    }

    public function showDeletepost(){
        $query = "SELECT * , category.categoryName FROM post INNER JOIN category ON post.categoryId = category.categoryId WHERE status = '2'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function showActivePost(){
        $query = "SELECT * , category.categoryName FROM post INNER JOIN category ON post.categoryId = category.categoryId WHERE status = '1'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function showPendingPost(){
        $query = "SELECT * , category.categoryName FROM post INNER JOIN category ON post.categoryId = category.categoryId WHERE status = '0'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function getpostById($id){
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

            $query = "SELECT * , category.categoryName FROM post INNER JOIN category ON post.categoryId = category.categoryId WHERE postId = $id";

            $row = json_decode(responeCheckQuery($query));
            return $row;
            }
        
            catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function changeListpostStatus($postId=[] , $status){
        try {

            if ($postId == []) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return $array_respone;

            }

            $query = "UPDATE  post SET status = '$status' WHERE postId IN (";

            $key = true;

            foreach ($postId as $catId) {   
                if ($key == true) {
                    $key = false;
                } else {
                    $query = $query . ',';
                }

                $query = $query . $catId;
            }

            $query = $query . ')';
            echo responeField($query, $postId, $status);
            
        } catch (Exception $e) {
            $e->getMessage();
        }  
    }

}
