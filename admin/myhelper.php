<?php
include 'connection.php';
include 'validate.php';

global $config;
$config['baseUrl'] = "http://localhost/project/";
function responeCheckQuery($query)
{
    if (!$result = mysqli_query(connection(), $query)) {
        $array_respone = [
            "success" => false,
            "data" => null,
            "message" => "lấy dữ liệu không thành công",
            "error" => true,
        ];
        return json_encode($array_respone);
    }

    $list = array();
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = $row;
        }
    }

    $array_respone = [
        "success" => true,
        "data" => $list,
        "message" => "lấy dữ liệu thành công",
        "error" => false,
    ];
    return json_encode($array_respone);
}

function responeField($query, $params=[], $params2)
{
    if (!$result = mysqli_query(connection(), $query)) {
        $array_respone = [
            "success" => false,
            "data" => null,
            "message" => "lấy dữ liệu không thành công",
            "error" => true,
        ];
        return json_encode($array_respone);
    }

    $array_respone = [
        "success" => true,
        "data" => [$params,$params2],
        "message" => "lấy dữ liệu thành công",
        "error" => false,
    ];
    return json_encode($array_respone);
}

function getPasswordHash($userName, $password){
    $usernameHash = md5($userName);
    $passwordHash = $usernameHash.md5($password);
    return $passwordHash; 
}

function checkPassword($userName,$password){
    $passwordHash = getPasswordHash($userName,$password);
    $query = "SELECT * FROM users WHERE userName = '$userName' AND isActive = '2' ";
    $row = json_decode(responeCheckQuery($query));
    $respone = "";
    if($row->data == []){
        $respone = "account not invalid";
    }
    else
    {
        if($passwordHash != $row->data[0] -> password){
            $respone = "password incorrect";
        }  
        else{
            $_SESSION['user']['userId'] = $row->data[0]->userId;
            $_SESSION['user']['fullname'] = $row->data[0]->fullname;
            $_SESSION['user']['userName'] = $row->data[0]->userName;
            $_SESSION['user']['address'] = $row->data[0]->address;
            $_SESSION['user']['phone_number'] = $row->data[0]->phone_number;
        }
    }
    if(!$respone == ""){
        $array_respone = [
            "success" => false,
            "message" => $respone,
        ];
        return $array_respone;
    }
    else{
        $array_respone = [
            "success" => true,
            "message" => "",
        ];
        return $array_respone;
    }
}
function getDatatree($data, $parent_id = 0, $level = 0){
    $result = [];
    foreach($data as $item){
        if($item['parentId'] == $parent_id){
            $item['level'] = $level;
            $result[] = $item;
            unset($data[$item['categoryId']]);
            $child = getDatatree($data, $item['categoryId'], $level + 1 );
            $result = array_merge($result, $child);
        }
    }
    return $result;
}

function moneyFormatIndia($number, $decimals = 0 , $dec_point = '.', $thousands_sep = ','){
    $thecash = number_format ( $number ,  $decimals,  $dec_point ,  $thousands_sep );

    return $thecash; // writes the final format where $currency is the currency symbol.
}
