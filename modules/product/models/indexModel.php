<?php 
function get_product_by_category_id($category_id){
    $item = db_fetch_array("SELECT * FROM `tbl_product` WHERE `category_id` = {$category_id}");
    if (!empty($item))
        return $item;
}
function get_product(){
    $item = db_fetch_array("SELECT * FROM `tbl_product`");
    if (!empty($item))
        return $item;
}
function get_product_by_image_id(){
    $item = db_fetch_array(
        "SELECT `tbl_product`.*, `tbl_images`.image_url
                            FROM `tbl_product`
                            INNER JOIN `tbl_images`  ON `tbl_product`.image_id = `tbl_images`.image_id
                            WHERE `tbl_product`.image_id = `tbl_images`.image_id"

    );
    if (!empty($item))
        return $item;
}
function get_product_by_id($id){
    $item = db_fetch_array("SELECT * FROM `tbl_product` WHERE `product_id` = {$id}");
    if (!empty($item))
        return $item;
}