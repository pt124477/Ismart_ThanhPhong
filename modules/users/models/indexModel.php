<?php
function update_pass($data,$reset_token){
    db_update('tlb_users',$data, "`reset_token`= '{$reset_token}'");
}

function check_reset_token($reset_token){
    $check_user = db_num_rows("SELECT * FROM `tlb_users` WHERE `reset_token` = '{$reset_token}'");
    if($check_user > 0 )
        return true;
    return false;
}
function update_reset_token($data, $email){
    db_update('tlb_users', $data, "`email` = '{$email}'");
}
function check_mail($email){
    $check_user = db_num_rows("SELECT * FROM `tlb_users` WHERE `email` = '{$email}'");
    if($check_user > 0 )
        return true;
    return false;
}

function check_login($username, $password){
    $check_user = db_num_rows("SELECT * FROM `tlb_users` WHERE `username` = '{$username}' AND `password` = '{$password}'");
    if($check_user > 0 )
        return true;
    return false;
}

function add_user($data){
    return db_insert('tlb_users',$data);
}
function user_exists($username, $email){
    $check_user = db_num_rows("SELECT * FROM `tlb_users` WHERE `email` = '{$email}' OR `fullname` = '{$username}'");
    echo $check_user;
    if($check_user > 0)
        return true;
    return false;

}
function get_list_users(){
    $result = db_fetch_array("SELECT * FROM `tlb_users`");
    return $result;
}
function get_user_by_id($id){
    $item = db_fetch_row("SELECT * FROM `tlb_users` WHERE `user_id`= {$id}");
    return $item;
}
//Phần active
function active_user($active_token){
    return db_update('tlb_users', array('is_active' => 1), "`active_token` = '{$active_token}'" );
}
function check_active_token($active_token){
    $check = db_num_rows("SELECT * FROM `tlb_users` WHERE `active_token` = '{$active_token}' AND `is_active` = '0'");
    if($check > 0)
        return true;
    return false;
}
