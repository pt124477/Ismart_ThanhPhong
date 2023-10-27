<?php
function show_category_name()
{
    $item = db_fetch_array("SELECT * FROM `tbl_product_categories`");
    if (!empty($item))
        return $item;
}
function insert_product($category_name, $data)
{
    return db_insert('tbl_product', $data, "`category_name` = '{$category_name}'");
}
function insert_image_product($data)
{
    return db_insert('tbl_images', $data);
}
function insert_product_image($data)
{
    return db_insert('tbl_product_images', $data);
}
function insert_post_id($data)
{
    return db_insert('tbl_product', $data);
}
function check_category_name($category_name)
{
    $item = db_num_rows("SELECT * FROM `tbl_product_categories` WHERE `category_name` = '{$category_name}'");
    if (!empty($item))
        return $item;
}
function check_categoey_id($category_id)
{
    $item = db_num_rows("SELECT * FROM `tbl_product` WHERE `category_id` = '{$category_id}'");
    if (!empty($item))
        return $item;
}
function get_category_id_by_name($category_name)
{
    $item = db_fetch_row("SELECT `category_id` FROM `tbl_product_categories` WHERE `category_name` = '{$category_name}'");
    if (!empty($item))
        return $item;
}

//image
function check_image_url($image_url)
{
    $item = db_num_rows("SELECT * FROM `tbl_images` WHERE `image_url` = '{$image_url}'");
    if (!empty($item))
        return $item;
}

//phan list_post 
function get_pagging($num_page, $page, $base_url = "")
{
    //Đầu
    $str_pagging = "<ul class='pagination '>";
    if ($page > 1) {
        $page_prev = $page - 1;
        $str_pagging .= "
        <li class='page-item'>
            <a class='page-link' href='{$base_url}&page={$page_prev}' aria-label='Previous'>
                <span aria-hidden='true'>Trước</span>
         
            </a>
        </li>";
    }

    //Content
    for ($i = 1; $i <= $num_page; $i++) {
        $active = "";
        if ($i == $page)
            $active = "class = 'active'";
        $str_pagging .= "<li {$active} class='page-item'><a class='page-link' href='{$base_url}&page={$i}'>$i</a></li>";
    }
    if ($page < $num_page) {
        $page_next = $page + 1;
        $str_pagging .= "
        <li class='page-item'>
        <a class='page-link' href='{$base_url}&page={$page_next}' aria-label='Previous'>
            <span >Sau</span>
     
        </a>
    </li>";
    }

    //Cuối
    $str_pagging .= "</ul>";
    return $str_pagging;
}
function get_product($start = 1, $num_per_page = 5, $where = "")
{

    if (!empty($where))
        $where = "WHERE {$where}";
    $list_pages = db_fetch_array("SELECT * FROM `tbl_product` {$where} LIMIT {$start}, $num_per_page");
    return $list_pages;
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
function get_category_name_by_id()
{
    $item = db_fetch_array(
        "SELECT `tbl_product`.*, `tbl_product_categories`.category_name
                            FROM `tbl_product`
                            INNER JOIN `tbl_product_categories`  ON `tbl_product`.category_id = `tbl_product_categories`.category_id
                            WHERE `tbl_product`.category_id = `tbl_product_categories`.category_id"

    );
    if (!empty($item))
        return $item;
}

//get_product_search
function get_product_search($search){
    $item = db_fetch_array("SELECT * FROM `tbl_product` WHERE `product_name` LIKE '%$search%' OR `product_detail` LIKE '%$search%'");
    if (!empty($item))
        return $item;
}
//edit list product
function get_product_by_id($product_id){
    $item = db_fetch_row("SELECT * FROM `tbl_product` WHERE `product_id`= '{$product_id}'");
    if (!empty($item))
        return $item;
}
function update_product($product_id, $data){
    return db_update('tbl_product', $data, "`product_id` = '{$product_id}'");
}
//lay id danh muc
 function get_category_edit(){
    $item = db_fetch_array("SELECT * FROM `tbl_product`");
    if (!empty($item))
        return $item;
 }

 function check_post_id($product_id){
    $item = db_num_rows("SELECT * FROM `tbl_product` WHERE `product_id` = '{$product_id}'");
    if (!empty($item))
        return $item;
}
//delete
function delete_product($id){
    return db_delete('tbl_product', "`product_id` = '{$id}'");
}
//cat product
function update_product_categories($data){
    return db_insert('tbl_product_categories', $data);

}
function get_product_category(){
    $item = db_fetch_array("SELECT * FROM `tbl_product_categories`");
    if (!empty($item))
        return $item;
}
function had_child($data, $id){
    foreach($data as $item){
        if($item['parent_id'] == $id){
            return true;
        }   
    }
    return false;
}
function data_tree($data, $parent_id = 0, $level = 0){
    $result = array();
    foreach($data as $item){
        if($item['parent_id'] == $parent_id){
            $item['level'] = $level;
            $result[] = $item;
            if(had_child($data, $item['category_id'])){
                $result_child = data_tree($data, $item['category_id'], $level + 1);
                $result  = array_merge($result, $result_child);
            }
        }
    }
    return $result;
}

//edit cat 
function get_cat_by_id($id){
    $item = db_fetch_row("SELECT * FROM `tbl_product_categories` WHERE `category_id`= '{$id}'");
    if (!empty($item))
        return $item;
}
function delete_cat($id){
    return db_delete('tbl_product_categories', "`category_id` = '{$id}'");  
}