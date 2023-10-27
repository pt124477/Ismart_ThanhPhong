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
function addAction()
{
    if (isset($_POST['btn_add'])) {
        global $error;
        //show_array($_POST);
        //Kiểm tra thông tin
        $error = array();
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Tên sản phẩm không được để trống";
        } else {
            $product_name = $_POST['product_name'];
        }

        //product_desc
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Nội dung sản phẩm không được để trống";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        //product_price
        if (empty($_POST['product_price'])) {
            $error['product_price'] = "Giá sản phẩm không được để trống";
        } else {
            $product_price = $_POST['product_price'];
        }
        //images
        //Thư mục chứa file load
        $upload_dir = 'public/images/';
        //Đường dẫn của file  sau khi upload.
        $image_url =  $_FILES['file']['name'];
        $upload_file = $upload_dir . $image_url;

        //Xử lý khi upload đúng file ảnh
        $type_allow = array('png', 'jpg', 'gif', 'jpeg', 'webp');
        $uploadedFiles = [];
        foreach ($_FILES['file']['name'] as $key => $filename) {
            $type = pathinfo($filename, PATHINFO_EXTENSION);
            // Xử lý tệp và thêm vào mảng $uploadedFiles
            $uploadedFiles[] = $filename;
        }
        if (!in_array(strtolower($type), $type_allow)) {
            $error['type'] = "Đường dẫn ảnh phải là jpg, png, gif, ipeg";
        } else {
            //Kiểm tra ảnh phải nhỏ hơn 20MB ~ 29.000.000
            $file_size = $_FILES['file']['size'];
            if ($file_size > 29000000) {
                $error['file_size'] = "File ảnh phải nhỏ hơn 20MB";
            }

            //Kiểm tra xem có cùng tên trên hệ thôngs hay không
            if (file_exists($upload_file)) {
                $file_name = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
                $new_file_name = $file_name . '- Copy.';
                $new_upload_file = $upload_dir . $new_file_name . $type;

                //Tang chi so khi file do da ton tai
                $k = 1;
                while (file_exists($new_upload_file)) {
                    $new_file_name = $file_name . "- Copy{$k}.";
                    $k++;
                    $new_upload_file = $upload_dir . $new_file_name . $type;
                }
                $upload_file = $new_upload_file;
            }
        }


        if (empty($_FILES['file']['name'])) {
            $error['image_url'] = "Ảnh sản phẩm không được để trống";
        } else {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $upload_file)) {
                $image_url = $_FILES['file']['name'];
            } else {
                $error['image_url'] = "Upload thất bại";
            }
        }

        //product_detail
        if (empty($_POST['product_detail'])) {
            $error['product_detail'] = "Chi tiết sản phẩm không được để trống";
        } else {
            $product_detail = $_POST['product_detail'];
        }
        //danh muc
        if (empty($_POST['category_name'])) {
            $error['category_name'] = "Danh muc sản phẩm không được để trống";
        } else {
            if (check_category_name($_POST['category_name'])) {
                $category_name = $_POST['category_name'];
            } else {
                $error['category_name'] = "Bạn chưa chọn danh muc sản phẩm";
            }
        }
        //id danh muc
        $category_id_post = get_category_id_by_name($category_name);
        $category_id = implode($category_id_post);
        //Kiểm tra khi dữ liệu hợp lệ 
        if (empty($error)) {
            $data = array(
                'image_url' =>  $image_url,
            );
            $image_id = insert_image_product($data);
            $image_ids[] = $image_id;
            foreach ($image_ids as $image_id) {
                $data = array(
                    //'user_id' => $user_id,
                    'product_name' => $product_name,
                    'product_desc' => $product_desc,
                    'product_detail' => $product_detail,
                    'product_price' => $product_price,
                    'image_id' => $image_id,
                    //'category_name' => $category_name,
                    'category_id' => $category_id
                );
            }
            show_array($data);
            $product_id = insert_product($category_name, $data);
            foreach ($image_ids as $image_id) {
                $data = array(
                    'product_id' => $product_id,
                    'image_id' => $image_id,
                );
                // Thêm dữ liệu vào bảng trung gian tbl_product_images.
                insert_product_image($data);
                redirect("?mod=product&action=list_product");
            }
        }
    }
    $show_post_category_name = show_category_name();
    $data['category_id'] = $category_id;
    $data['show_post_category_name'] = $show_post_category_name;
    //show_array($data);
    load_view('add', $data);
}


function list_productAction()
{
    if (isset($_POST['btn-search'])) {
        //phân trang list_pages
        $search = $_POST['search'];
        //phân trang list_pages
        $num_rows = db_num_rows("SELECT * FROM `tbl_product` WHERE `product_name` LIKE '%$search%' OR `product_desc` LIKE '%$search%'");
        $num_per_page = 7;
        //Tổng số bản ghi
        $total_row  =  $num_rows;
        //Tổng số trang
        $num_page = ceil($total_row / $num_per_page);

        //Trang
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        //Xuất phát
        $start = ($page - 1) * $num_per_page;

        $list_product = get_product_search($search);

        $category_name = get_category_name_by_id();
        $product_images = get_product_by_image_id();

        // $list_page = get_list_pages_by_id();
        $data['total_row'] = $total_row;
        $data['num_rows'] = $num_rows;
        $data['num_page'] = $num_page;
        $data['page'] = $page;
        $data['category_name'] = $category_name;
        $data['product_images'] = $product_images;

        $data['list_product'] = $list_product;
    } else {
        //phân trang list_pages
        $num_rows = db_num_rows("SELECT * FROM `tbl_product`");
        $num_per_page = 5;
        //Tổng số bản ghi
        $total_row  =  $num_rows;
        //Tổng số trang
        $num_page = ceil($total_row / $num_per_page);

        //Trang
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;

        //Xuất phát
        $start = ($page - 1) * $num_per_page;

        $list_product = get_product($start, $num_per_page);

        $category_name = get_category_name_by_id();
        $product_images = get_product_by_image_id();
        // $list_page = get_list_pages_by_id();
        $data['total_row'] = $total_row;
        $data['num_rows'] = $num_rows;
        $data['num_page'] = $num_page;
        $data['page'] = $page;
        $data['category_name'] = $category_name;
        $data['product_images'] = $product_images;
        $data['list_product'] = $list_product;
    }
    //show_array($data);
    load_view('list_product', $data);
}
function editAction()
{
    //id 
    $id = $_GET['id'];

    if (isset($_POST['btn-edit'])) {
        //Kiểm tra dữ liệu
        if (empty($_POST['product_name'])) {
            $error['product_name'] = "Tên sản phẩm không được để trống";
        } else {
            $product_name = $_POST['product_name'];
        }

        //product_desc
        if (empty($_POST['product_desc'])) {
            $error['product_desc'] = "Mô tả sản phẩm không được để trống";
        } else {
            $product_desc = $_POST['product_desc'];
        }
        //danh muc
        if (empty($_POST['category_name'])) {
            $error['category_name'] = "Danh muc bài viết không được để trống";
        } else {
            if (check_category_name($_POST['category_name'])) {
                $category_name = $_POST['category_name'];
            }
        }
        //id danh muc
        $category_id_post = get_category_id_by_name($category_name);
        $category_id = implode($category_id_post);
        //Xuất dữ liệu, update qua database
        if (empty($error)) {
            $data = array(
                //'user_id' => $user_id,
                'product_name' => $product_name,
                'product_desc' => $product_desc,
                //'category_name' => $category_name,
                'category_id' => $category_id
            );
            //show_array($data);
            update_product($id, $data);
            redirect("?mod=product&action=list_product");
        }
    }
    //post_id
    $get_product_by_id  = get_product_by_id($id);
    $show_product_category_name = show_category_name();

    $data['get_product_by_id'] = $get_product_by_id;
    $data['category_id'] = $category_id;
    $data['show_product_category_name'] = $show_product_category_name;
    //show_array($data);
    load_view('edit', $data);
}
function deleteAction()
{
    $id = $_GET['id'];
    echo $id;
    delete_product($id);
    redirect("?mod=prodduct&action=list_product");
}
function catAction()
{
    if (isset($_POST['btn-add'])) {
        global $error;
        $error = array();
        //category_id
        if (empty($_POST['parent_id'])) {
            $error['parent_id'] = "Id danh mục không được để trống";
        } else {
            $parent_id = $_POST['parent_id'];
        }
        //caregory_desc
        if (empty($_POST['category_desc'])) {
            $error['category_desc'] = "Id danh mục không được để trống";
        } else {
            $category_desc = $_POST['category_desc'];
        }
        //category_name
        if (empty($_POST['category_name'])) {
            $error['category_name'] = "Id danh mục không được để trống";
        } else {
            $category_name = $_POST['category_name'];
        }

        //kết luận 
        if (empty($error)) {
            $data = array(
                'parent_id' => $parent_id,
                'category_name' => $category_name,
                'category_desc' => $category_desc
            );
            //show_array($data);
            update_product_categories($data);
        }
    }

    $product_categories = get_product_category();
    $data_tree = data_tree($product_categories, 0);
    $data['data_tree'] = $data_tree;
    $data['product_categories'] = $product_categories;

    //show_array($data);
    load_view('cat', $data);
}
function editCatAction()
{
    //id 
    $id = $_GET['id'];

    if (isset($_POST['btn-edit'])) {
        //Kiểm tra dữ liệu
        global $error;
        //Kiểm tra thông tin
        $error = array();

        if (empty($_POST['category_name'])) {
            $error['category_name'] = "Tên danh mục không được để trống";
        } else {
            $category_name = $_POST['category_name'];
        }

        //category_desc
        if (empty($_POST['category_desc'])) {
            $error['category_desc'] = "Nội dung bài viết không được để trống";
        } else {
            $category_desc = $_POST['category_desc'];
        }

        //Kiểm tra khi dữ liệu hợp lệ 
        if (empty($error)) {
            $data = array(
                'category_name' => $category_name,
                'category_desc' => $category_desc,
            );
            //show_array($data);
            update_cat($id, $data);
        }
    }
    $get_cat_by_id = get_cat_by_id($id);
    $data['get_cat_by_id'] = $get_cat_by_id;
    load_view('editCat', $data);
}
function deleteCatAction()
{
    $id = $_GET['id'];
    //echo $id;
    delete_cat($id);
    redirect("?mod=product&action=cat");
}
