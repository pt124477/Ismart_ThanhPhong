<?php 
 //lấy tên danh mục

function get_category_name(){
    $item = db_fetch_array("SELECT * FROM `tbl_product_categories`");
    if (!empty($item))
        return $item;
}