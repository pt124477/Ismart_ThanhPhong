<?php
function construct()
{
    load('lib', 'valitation');
    load_model('index');
}
function regAction()
{
}
function indexAction()
{
    load_view('index');
}
function addAction()
{
    /** Cập nhập tài khoản
     * B1: Tạo giao diện
     * Load lại thông tin cũ
     * Validation from
     * Cập nhập thông tin
     */
    if (isset($_POST['btn-add'])) {
        global $error;
        //show_array($_POST);
        //Kiểm tra thông tin
        $error = array();
        //user_id
        if (empty($_POST['user_id'])) {
            $error['user_id'] = "Id người dùng không được để trống";
        } else {
            if (check_user_id($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
            } else {
                $error['user_id'] = "Id người dùng không tồn tại ";
            }
        }
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "Tiêu đề không được để trống";
        } else {
            $page_title = $_POST['page_title'];
        }

        //page_content
        if (empty($_POST['page_content'])) {
            $error['page_content'] = "Nội dung bài viết không được để trống";
        } else {
            $page_content = $_POST['page_content'];
        }

        //Kiểm tra khi dữ liệu hợp lệ 
        if (empty($error)) {
            $data = array(
                'user_id' => $user_id,
                'page_title' => $page_title,
                'page_content' => $page_content
            );
            //show_array($data);
            insert_page($user_id, $data);
        }
    }
    load_view('add', $data);
}
function updateAction()
{
    if (isset($_POST['btn-update'])) {
        global $error;
        $error = array();
        if (empty($_POST['page_id'])) {
            $error['page_id'] = "Id người dùng không được để trống";
        } else {
            if (check_page_id($_POST['page_id'])) {
                $page_id = $_POST['page_id'];
            } else {
                $error['page_id'] = "Id bài viết không tồn tại ";
            }
        }

        //kiểm tra user_id
        if (empty($_POST['user_id'])) {
            $error['user_id'] = "Id người dùng không được để trống";
        } else {
            if (check_user_id($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
            } else {
                $error['user_id'] = "Id không tồn tại trên hệ thống";
            }
        }
        // kiểm tra title
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "Tiêu đề không được để trống";
        } else {
            $page_title = $_POST['page_title'];
        }
        // kiểm tra page_content 
        if (empty($_POST['page_content'])) {
            $error['page_content'] = "Nội dung không được để trống";
        } else {
            $page_content = $_POST['page_content'];
        }
        //Kiểm tra khi dữ liệu hợp lệ 
        if (empty($error)) {
            $data = array(
                'page_id' => $page_id,
                'user_id' => $user_id,
                'page_title' => $page_title,
                'page_content' => $page_content
            );
            //show_array($data);
            update_page($page_id, $data);
        }
    }
    $info_pages = get_page_by_user_id($user_id);
    $data['info_pages'] = $info_pages;
    load_view('update', $data);
}
function list_pagesAction()
{

    if (isset($_POST['btn-search'])) {
        //phân trang list_pages
        $search = $_POST['search'];
        $num_rows = db_num_rows("SELECT * FROM `tbl_pages` WHERE `page_title` LIKE '%$search%' OR `page_content` LIKE '%$search%'");

        $num_per_page = 3;
        //Tổng số bản ghi
        $total_row  =  $num_rows;
        //Tổng số trang
        $num_page = ceil($total_row / $num_per_page);
    
        //Trang
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    
        //Xuất phát
        $start = ($page - 1) * $num_per_page;
    
        $list_page= list_page_search($search);
    
        // $list_page = get_list_pages_by_id();
        $data['total_row'] = $total_row;
        $data['num_rows'] = $num_rows;
        $data['num_page'] = $num_page;
        $data['page'] = $page;
        $data['list_page'] = $list_page;

    } else {
        //phân trang list_pages
        $num_rows = db_num_rows("SELECT * FROM `tbl_pages`");
        $num_per_page = 3;
        //Tổng số bản ghi
        $total_row  =  $num_rows;
        //Tổng số trang
        $num_page = ceil($total_row / $num_per_page);
    
        //Trang
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
    
        //Xuất phát
        $start = ($page - 1) * $num_per_page;
    
        $list_page = get_pages($start, $num_per_page);
    
        // $list_page = get_list_pages_by_id();
        $data['total_row'] = $total_row;
        $data['num_rows'] = $num_rows;
        $data['num_page'] = $num_page;
        $data['page'] = $page;
        $data['list_page'] = $list_page;

        
    }
   
    // show_array($data);
    load_view('list_page', $data);
}
function deleteAction()
{
    $id = $_GET['id'];
    echo $id;
    delete_pages($id);
    redirect("?mod=pages&action=list_pages");
}

function editAction()
{
    $id = $_GET['id'];
    //echo $id;
    if (isset($_POST['btn-update'])) {
        global $error;
        $error = array();
        if (empty($_POST['page_id'])) {
            $error['page_id'] = "Id người dùng không được để trống";
        } else {
            if (check_page_id($_POST['page_id'])) {
                $page_id = $_POST['page_id'];
            } else {
                $error['page_id'] = "Id bài viết không tồn tại ";
            }
        }

        //kiểm tra user_id
        if (empty($_POST['user_id'])) {
            $error['user_id'] = "Id người dùng không được để trống";
        } else {
            if (check_user_id($_POST['user_id'])) {
                $user_id = $_POST['user_id'];
            } else {
                $error['user_id'] = "Id không tồn tại trên hệ thống";
            }
        }
        // kiểm tra title
        if (empty($_POST['page_title'])) {
            $error['page_title'] = "Tiêu đề không được để trống";
        } else {
            $page_title = $_POST['page_title'];
        }
        // kiểm tra page_content 
        if (empty($_POST['page_content'])) {
            $error['page_content'] = "Nội dung không được để trống";
        } else {
            $page_content = $_POST['page_content'];
        }
        //Kiểm tra khi dữ liệu hợp lệ 
        if (empty($error)) {
            $data = array(
                'page_id' => $page_id,
                'user_id' => $user_id,
                'page_title' => $page_title,
                'page_content' => $page_content
            );
            //show_array($data);
            update_page($page_id, $data);
        }
    }
    $info_pages = get_page_by_user_id($user_id);
    $data['info_pages'] = $info_pages;

    $edit_page = get_page_by_id($id);
    $data['edit_page'] = $edit_page;
    // show_array($data);
    load_view('edit', $data);
}
