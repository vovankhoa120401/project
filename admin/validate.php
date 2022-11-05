<?php

 function validateUserName($userName){
    $parttern = "/^[A-Za-z0-9_\.]{6,32}$/";
    if(!preg_match($parttern, $userName)){
        $respone = "nhập username đúng định dạng: chứa các ký tự từ a-z, 0-9, chỉ chứa dấu . và dấu gạch dưới";
        return $respone;
    }
    return "";
 }

 function validatePassword($password){
    $parttern = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if(!preg_match($parttern, $password)){
        $respone = "nhập password đúng định dạng: chữ cái đầu viết hoa, có từ 6 đến 32 ký tự";
        return $respone;
    }
    return "";
 }

 function validateEmail($email){
    $parttern = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if(!preg_match($parttern, $email)){
        $respone = "cần nhập email đúng định dạng";
        return $respone;
    }
    return "";
 } 

 function validatePhoneNumber($phone_number){
    $data = '+11234567890';
    if(!preg_match( '/^\+\d(\d{3})(\d{3})(\d{4})$/', $data,  $matches ) )
    {
        $respone = "xin nhập số điện thoại đúng định dạng";
        return $respone;
    }
    else
    {
        $phone_number = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
        return $phone_number;
    }
 }

 function validatePrice($Price){
    $parttern = "/^[0-9_\.]$/";
     if(!preg_match($parttern,$Price)){
        $respone = "nhập giá đúng định dạng: chỉ chứa ký tự từ 0-9";
        return $respone;
     }
     return "";
 }
?>