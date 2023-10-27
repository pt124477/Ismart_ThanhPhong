<?php
function construct()
{
    load('lib','get_sibar');
    load_model('index');
}

function indexAction()
{

    // load_view('index');
}
function mainAction()
{
    //lấy id xuống dùng để tham chiếu lấy danh sách sản phẩm theo id
    $category_id = $_GET['id'];
    //echo $category_id;

    //load sử dụng lại phần sibar
    $category_name = get_category_name();

    //lấy danh sách sản phẩm theo category_id
    $list_product = get_product_by_category_id($category_id);

    //lấy hình ảnh
    $product_images = get_product_by_image_id();

    //truyền dữ liệu qua data để đẩy ra giao diện
    $data = array();
    $data['category_id'] = $category_id;
    $data['category_name'] = $category_name;
    $data['product_images'] = $product_images;
    $data['list_product'] = $list_product;
    load_view('main', $data);
}
function detailAction(){

    $id = $_GET['id'];
    // echo $id;
    
    //load sử dụng lại phần sibar
    $category_name = get_category_name();

    //lấy hình ảnh
    $product_images = get_product_by_image_id();


    //lấy danh sách sản phâmr cùng category_id
    $list_product = get_product();

    //lấy sản phẩm thông qua i khi get xuống
    $product_item = get_product_by_id($id);


    //truyền dữ liệu qua data để đẩy ra giao diện
    $data = array();
    $data['category_name'] = $category_name;
    $data['product_item'] = $product_item;
    $data['product_images'] = $product_images;
    $data['list_product'] = $list_product;


    load_view('detail', $data);

}
