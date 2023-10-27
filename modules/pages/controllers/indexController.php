<?php
function construct() {
    
}
function regAction() {

}
function indexAction(){
    load_view('index');
}
function logoutAction(){
    unset($_SESSION["is_login"]);
    unset($_SESSION["user_login"]);
    redirect("?mod=user&action=login");
}
