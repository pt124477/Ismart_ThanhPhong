<?php 
// function check_login($username, $password){
//     global $list_user;
//     foreach($list_user as $user){
//         if($username == $user['username'] && $password == $user['password']){
//             return true;
//         }
//     }
//     return false;

//}

//Hàm này trả về true nếu tồn tại is_login
function is_login(){
    if(isset($_SESSION['is_login'])){
        return true;
    }
    return false;
}

//Hàm này trả về true nếu tồn tại user_login
function user_login(){
    if(isset($_SESSION['user_login'])){
        return $_SESSION['user_login'];
    }
    return false;
}

//

function info_user($field){
    global $list_user;
    if(isset($_SESSION['is_login'])){
        foreach($list_user as $user){
            if($_SESSION['user_login'] == $user['username']){
                if(array_key_exists($field, $user)){
                    return $user[$field];
                }
            }
        }
    }
    return false;

}
?>