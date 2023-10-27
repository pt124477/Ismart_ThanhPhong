<?php
function construct()
{
    load_model('index');
}
function indexAction()
{
    //lấy id danh mục
    $category_id = get_category_id();
    //show_array($categoey_id);

    //lấy hình ảnh
    $product_images = get_product_by_image_id();

    
  
    //lấy danh sách sản phẩm
    $show_product = get_product();
    //lấy tên danh mục
    $category_name = get_category_name();
    // show_array($category_name);
    $data = array();
    $data['category_name'] = $category_name;
    $data['category_id'] = $category_id;
    $data['product_images'] = $product_images;

    $data['show_product'] = $show_product;
    load_view('index', $data);
}
function mainAction(){
    $category_id = $_GET['id'];
    echo $category_id;

}
