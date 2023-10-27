
<?php

function construct()
{
    //echo "DÙng chung, load đầu tiên";
    load_model('index');
    load('lib', 'valitation');
    load('lib', 'email');
}

function indexAction()
{
    load_view('index');
}
function regAction()
{
    global $error, $fullname, $username, $password, $email;
    if (isset($_POST['btn_login'])) {
        $error = array();
        //Kiểm tra fullname
        if (empty($_POST['fullname'])) {
            $error['fullname'] = "Không được để trống họ tên";
        } else {
            $fullname = $_POST['fullname'];
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
                $password = $_POST['password'];
            }
        }



        //Kết luận
        if (empty($erro)) {
            if (!user_exists($username, $email)) {
                $active_token = md5($username . time());
                $data = array(
                    'fullname' => $fullname,
                    'username' => $username,
                    'password' => $password,
                    'email' => $email,
                    'active_token' => $active_token
                );
                add_user($data);

                $link_active = base_url("?mod=user&action=active&active_token=$active_token");
                $content = "<p>Chào bạn {$fullname}</p>
                <p>Bạn vui lòng kích vào đường dẫn để đăng nhập: {$link_active}</p>
                <p>Nếu không phải bạn đăng ký tài khoản thì bỏ qua thông tin này</p>";
                send_mail('windlaptrinh.vn@gmail.com', 'Nguyễn Thanh Phong', 'Kích hoạt tài khoản PHP Marter', "{$content}");
                //Thong bao
                //redirect("?mod=user&controller=index&action=login");

            } else {
                $erro['account'] = "username hoặc email đã tồn tại trong hệ thống";
            }
        }
    }
    load_view('reg');
}
function loginAction()
{
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
                $password = $_POST['password'];
            }
        }
        if (empty($error))
            if (check_login($username, $password)) {
                //Lưu trữ phiên đăng nhập 
                $_SESSION['is_login'] = true;
                $_SESSION['user_login'] = $username;
                //Chuyển hướng vào hệ thống
                redirect();
            } else {
                $error['account'] = "Tên đăng nhập hoặc mật khẩu không hợp lệ";
            }
    }

    load_view('login');
}
function activeAction()
{

    $active_token = $_GET['active_token'];
    //echo active_user($active_token);
    if (check_active_token($active_token)) {
        active_user($active_token);
        $link_login = base_url("?mod=user&action=login");
        echo "Bạn đã đăng ký thành công, click vào đây để đăng nhập: <a href= '{$link_login}'> Đăng nhập </a>";
    } else {
        echo "Yêu cầu không hợp lệ hoặc tài khoản của bạn đã được kích hoạt";
    }
}
function resetAction()
{
    global  $error, $username, $email, $password;
    $reset_token = $_GET['reset_token'];
    if (!empty($reset_token)) {
        if (check_reset_token($reset_token)) {
            if ($_POST['btn_newpass']) {

                //Kiểm tra password
                if (empty($_POST['password'])) {
                    $error['password'] = "Mật khẩu không được để trống";
                } else {
                    if (!is_password($_POST['password'])) {
                        $error['password'] = "Mật khẩu không hợp lệ";
                    } else {
                        $password = $_POST['password'];
                    }
                }
            }
            if(empty($error)){
                $data = array(
                    'password' => $password
                );
                update_pass($data, $reset_token);
                //chuyển hướng
                redirect("?mod=user&action=resetOk");
            }
            load_view('newPass');
        } else {
            echo "Yêu cầu không hợp lệ";
        }
    } else {
        if ($_POST['btn_reset']) {
            $error = array();
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
            //Kết luận
            if (empty($error)) {
                if (check_mail($email)) {
                    $reset_token = md5($email . time());
                    $data = array(
                        'reset_token' => $reset_token
                    );
                    //Cập nhập mã reset pass cho user cần reset mật khẩu
                    update_reset_token($data, $email);
                    //Giửi link khôi phục vào email của người dùng
                    $link_url = base_url("?mod=user&action=reset&reset_token={$reset_token}");
                    $content =  "<p>Bạn vui lòng click vào link này để lấy lại mật khẩu: {$link_url}</p>
                    <p>Nếu không phải bạn yêu cầu, vui lòng bỏ qua thông tin này</p>
                    <p>Unitop Siuuu</p>";
                    send_mail($email, '', 'Khôi phục tài khoản PHP MASTER', $content);
                } else {
                    $error['account'] = "Tài khoản không tồn tại trên hệ thống";
                }
            }
        }
        load_view('reset');
    }
}
function resetOkAction(){
    load_view('resetOK');
}
