<?php
function check_password_old($username, $password){
    $item = db_num_rows("SELECT * FROM `tlb_users` WHERE `username`= '{$username}' && `password`= '{$password}'");
    if(!empty($item))
        return $item;
}

function get_users_by_username($username){
    $item = db_fetch_row("SELECT * FROM `tlb_users` WHERE `username`= '{$username}'");
    if(!empty($item))
        return $item;
}
function update_user_login($username, $data){
    return db_update('tlb_users',$data, "`username` = '{$username}'");
    
}
function check_login($username, $password){
    $check_user = db_num_rows("SELECT * FROM `tlb_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if($check_user > 0 )
        return true;
    return false;
}

