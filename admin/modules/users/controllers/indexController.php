<?php
function construct()
{
    load('lib', 'valitation');
    load_model('index');
}
function indexAction()
{
    load_view('index');
}
function loginAction()
{
    //echo time();
   // echo date("d/m/Y");
    global $error, $username, $password;
    if (isset($_POST['btn_login'])) {
        $error = array();

        //Kiểm tra username
        if (empty($_POST['username'])) {
            $error['username'] = "Tên không được để trống";
        } else {
            if (!is_username($_POST['username'])) {
                $error['username'] = "Tên đăng nhập không hợp lệ";
            } else {
                $username = $_POST['username'];
            }
        }

        //Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Mật khẩu không được để trống";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không hợp lệ";
            } else {
                $password = md5($_POST['password']);
            }
        }
        if (empty($error))
            if (check_login($username, $password)) {
                //Lưu trữ phiên đăng nhập 
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                //Chuyển hướng vào hệ thống
                redirect("?mod=users&action=index");
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không hợp lệ";
            }
    }

    load_view('login');
}
function updateAction()
{
    /** Cập nhập tài khoản
     * B1: Tạo giao diện
     * Load lại thông tin cũ
     * Validation from
     * Cập nhập thông tin
     */
    if (isset($_POST['btn-update'])) {
        global $error, $username, $password, $fullname, $email;      
        //Kiểm tra dữ liệu
        $error = array();       
        //Kiểm tra password
        if (empty($_POST['password'])) {
            $error['password'] = "Mật khẩu không được để trống";
        } else {
            if (!is_password($_POST['password'])) {
                $error['password'] = "Mật khẩu không hợp lệ";
            } else {
                $password = md5($_POST['password']);
            }
        }

        //Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ tên";
        } else {
            $fullname = $_POST['fullname'];
        }
        //Kiểm tra phone_number
        if (empty($_POST['phone_number'])) {
            $error['phone_number'] = "Không được để trống số điện thoại";
        } else {
            $phone_number = $_POST['phone_number'];
        }
        //Kiểm tra address
        if (empty($_POST['address'])) {
            $error['address'] = "Không được để trống số điện thoại";
        } else {
            $address = $_POST['address'];
        }

        //Kiểm tra email 
        if (empty($_POST['email'])) {
            $error['email'] = "Không được để trống email";
        } else {
            if (!is_email($_POST['email'])) {
                $error['email'] = "Email không đúng định dạng";
            } else {
                $email = $_POST['email'];
            }
        }
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];       
        $address = $_POST['address'];
        $phone_number = $_POST['phone_number'];


        if (empty($error)) {
            $data = array(
                'fullname' => $fullname,
                'username' => $username,
                'password' => $password,
                'email' => $email,
                'address' => $address,
                'phone_number' => $phone_number
            );
            show_array($data);
            update_user_login(user_login(), $data);
        }
    }
    $info_users = get_users_by_username(user_login());
    $data['info_users'] = $info_users;
    //show_array(($data));
    load_view('update', $data);
}
function resetAction()
{
    global $error, $password, $username;
    if (isset($_POST['btn-reset'])) {
        //show_array($_POST);
        //Kiểm tra password
        if (empty($_POST['pass_old'])) {
            $error['pass_old'] = "Mật khẩu không được để trống";
        } else {
            if (!is_password($_POST['pass_old'])) {
                $error['pass_old'] = "Mật khẩu không hợp lệ";
            } else {
                if (check_password_old('thanhphong.vn', md5($_POST['pass_old']))) {
                    // Mật khẩu cũ khớp
                    $pass_old = md5($_POST['pass_old']);
                  
                } else {
                    $error['pass_old'] = "Mật khẩu không khớp";
                }
               
            }
        }

        //Kiểm tra mật khẩu mới khi upate vào
        if (empty($_POST['pass_new'])) {
            $error['pass_new'] = "Mật khẩu không được để trống";
        } else {
            if (!is_password($_POST['pass_new'])) {
                $error['pass_new'] = "Mật khẩu không hợp lệ";
            }else{
                if(($_POST['pass_new'] != $_POST['confirm_pass'])){
                    $error['pass_update'] = "Mật khẩu không nhập không trùng khớp";
                }else{
                    $pass_update = md5($_POST['confirm_pass']);
                }
            }
        }
        if (empty($error)) {
            $data = array(
                //'pass_old' => $pass_old,           
                'password' => $pass_update
            );
            show_array($data);
            update_user_login(user_login(), $data);
        }
    }
    load_view('reset');
}
function logoutAction()
{
    unset($_SESSION['is_login']);
    unset($_SESSION['user_login']);
    redirect("?mod=user&action=login");
}

function list_userAction(){
    load_view('list_user');
}
function addAction(){
    load_view('add');
}
