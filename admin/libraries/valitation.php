<?php
//Hàm kiểm tra tên đăng nhập
function is_username($username)
{
    $partten = "/^[A-Za-z0-9_\.]{6,32}$/";
    if (!preg_match($partten, $username, $macths))
        return false;
    return true;
}

//Hàm kiểm tra password 
function is_password($password)
{
    $partten = "/^([A-Z]){1}([\w_\.!@#$%^&*()]+){5,31}$/";
    if (!preg_match($partten, $password, $macths))
        return false;
    return true;
}
// Hàm kiểm tra email
function is_email($email)
{
    $partten = "/^[A-Za-z0-9_.]{6,32}@([a-zA-Z0-9]{2,12})(.[a-zA-Z]{2,12})+$/";
    if (!preg_match($partten, $email, $macths))
        return false;
    return true;
}
//Hamf sét giá trị mặt định
function set_value($lable_file)
{
    global $$lable_file;
    if (!empty($$lable_file)) return $$lable_file;
}

//Hàm xuất lỗi error
function form_error($lable_file)
{
    global $error;
    if (!empty($error[$lable_file])) return "<p class='error'> {$error[$lable_file]} </p>";
}
