<?php
include '../../myhelper.php';
session_start();
class   user {

    private $userID;
    private $userName;
    private $fullName;
    private $password;
    private $address;
    private $birthday;
    private $phone_number;

    public function __construct($userID,$userName,$fullName,$password,$address,$phone_number,$birthday){
        $this->userID = $userID;
        $this->userName = $userName;
        $this->fullName = $fullName;
        $this->password = $password;
        $this->address = $address;
        $this->phone_number = $phone_number;
        $this->birthday = $birthday;

    }


    public function addUser(User $user)
    {

        try {


            $error_code = array();
            if($user->userName === "" || $user->fullName === "" || $user->password === "" || $user->address === "" || $user->phone_number === "" || $user->birthday === ""){

                $error_code['user'] = "xin nhập đầy đủ tất cả thông tin";
            }
            else{
                if (validateUserName($_POST['userName']) != ""){
                $error_code['userName'] = validateUserName($_POST['userName']);

                }
                if (validatePassword($_POST['password']) != ""){
                $error_code['password'] = validatePassword($_POST['password']);
                }

                if(count($error_code)  > 0){
                    $array_respone = array(
                        "success" => false,
                        "status_code" => 100,
                        "message" => $error_code,
                        "error" => false,
                    );
                    echo json_encode($array_respone);
                } else {
                    $passwordHash = getPasswordHash($user->userName, $user->password);
                   
                    $query = sprintf("INSERT INTO users ( userId, userName, fullName, password, address, birthday) VALUE (%s,'%s','%s','%s','%s','%s')", $user->userID, $user->userName, $user->fullName, $passwordHash, $user->address, $user->birthday);
                    echo $query;
                    if(!$result = mysqli_query(connection(), $query)){
                        echo mysqli_error(connection());
                    }
                    else{
                        $array_respone = [
                            "success" => true,
                            "data" => null,
                            "message" => "thêm người dùng thành công thành công",
                            "error" => true,
                        ];
                        echo json_encode($array_respone);
                    }
                }
            }
            
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function updateUser(user $user, $user_id){
        try {
            $error_code = array();
            if (
                $user->userName === ''
                || $user->fullName === ''
                || $user->password ===''
                || $user->address ===''
                || $user->birthday ===''
                || $user->phone_number ===''
            ) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                echo json_encode($array_respone);

            }
            $query = "UPDATE  users  set userName =  '$user->userName', fullname = '$user->fullName', address = '$user->address' , phone_number = '$user->phone_number', birthday = '$user->birthday' WHERE userId = $user_id";
            $row = responeField($query, [$user_id], 0);
            echo $row ;


        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function checkLogin(user $checkLogin)
    {
        
        $error_code = array();
        try {
            if ($checkLogin->userName === "" || $checkLogin->password === "") {
                $error_code['user'] = "tài khoản hoặc mật khẩu không được để trống";
            }
            else{
                $check = checkPassword($checkLogin->userName,$checkLogin->password);
                if($check['success'] == true){
                    $array_repone = [
                        "success" => true,
                        "status_code" => 200,
                        "message" => "Dn thanh cong",
                        "error" => false,
                    ];
                echo json_encode($array_repone);
                } else {
                    $array_repone = [
                        "success" => false,
                        "status_code" => 400,
                        "message" => $check['message'],
                        "error" => false,
                    ];
                    echo json_encode($array_repone); 
                }
            }
        } catch (Exception $e) {
            
            $e->getMessage();
        }
        
    }

    public function getUserById($userId)
    {

        try {

            if ($userId == "") {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "không tìm thấy id của khách hàng",
                ];
                echo json_encode($array_respone);

            }

            $query = "SELECT * FROM users WHERE UserId= $userId";

            return json_decode(responeCheckQuery($query));

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function getAllUser( $current_page)
    {

        try {
            if(isset($_SESSION['total_page_user']) == false){
                $result = mysqli_query(connection(), 'select count(userId) as total from users');
                $row = mysqli_fetch_assoc($result);
                $total_records = $row['total'];
                $limit = 10;
                $total_page = ceil($total_records / $limit);
                $_SESSION['total_page_user']= $total_page;
            }
            $limit = 10;
            $total_page = ceil($total_records / $limit);
            if ($current_page > $total_page){
                $current_page = $total_page;
            }
            else if ($current_page < 1){
                $current_page = 1;
            }
            $start = $current_page * $limit;
            $query = "SELECT * FROM users LIMIT $start, $limit";
            echo $query;
            return  json_decode(responeCheckQuery($query));

        } catch (Exception $e) {

            $e->getMessage();

        }
    }

    public function deluser($userId){
        $query = "UPDATE users SET isActive = '0' WHERE userId = $userId";
        $row = responeField($query,[$userId],0);
        echo $row;
        
    }

    public function showDeleteuser(){
        $query = "SELECT * FROM user WHERE status = '0'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function showActiveuser(){
        $query = "SELECT * FROM user WHERE status = '1'";
        $row = json_decode(responeCheckQuery($query));
        return $row;
    }

    public function changeListUserStatus($userId=[] , $status){
        try {

            if ($userId == []) {

                $array_respone = [
                    "success" => false,
                    "status_code" => 100,
                    "message" => "error",
                    "error" => "lay du lieu khong lieu thanh cong",
                ];
                return $array_respone;

            }

            $query = "UPDATE  users SET isActive = '$status' WHERE userId IN (";

            $key = true;

            foreach ($userId as $catId) {   
                if ($key == true) {
                    $key = false;
                } else {
                    $query = $query . ',';
                }

                $query = $query . $catId;
            }

            $query = $query . ')';
            echo (responeField($query,$userId,$status));
            
        } catch (Exception $e) {
            $e->getMessage();
        }  
    }
    
    

}
