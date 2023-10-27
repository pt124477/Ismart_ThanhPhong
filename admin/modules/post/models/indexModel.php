<?php

function show_category_name()
{
    $item = db_fetch_array("SELECT * FROM `tbl_post_categories`");
    if (!empty($item))
        return $item;
}
function insert_post($category_name, $data)
{
    return db_insert('tbl_post', $data, "`category_name` = '{$category_name}'");
}
function insert_post_id($data)
{
    return db_insert('tbl_post', $data);
}
function check_category_name($category_name)
{
    $item = db_num_rows("SELECT * FROM `tbl_post_categories` WHERE `category_name` = '{$category_name}'");
    if (!empty($item))
        return $item;
}
function check_categoey_id($category_id)
{
    $item = db_num_rows("SELECT * FROM `tbl_post` WHERE `category_id` = '{$category_id}'");
    if (!empty($item))
        return $item;
}
function get_category_id_by_name($category_name)
{
    $item = db_fetch_row("SELECT `category_id` FROM `tbl_post_categories` WHERE `category_name` = '{$category_name}'");
    if (!empty($item))
        return $item;
}
//them image
function insert_image_post($data)
{
    return db_insert('tbl_images', $data);
}
//thêm ảnh vào bản quan hệ ở giữa
function insert_post_image($data)
{
    return db_insert('tbl_post_images', $data);
}
//thêm đường dẫn lấy ảnh
function get_post_by_image_id(){
    $item = db_fetch_array(
        "SELECT `tbl_post`.*, `tbl_images`.image_url
                            FROM `tbl_post`
                            INNER JOIN `tbl_images`  ON `tbl_post`.image_id = `tbl_images`.image_id
                            WHERE `tbl_post`.image_id = `tbl_images`.image_id"

    );
    if (!empty($item))
        return $item;
}

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
function get_post($start = 1, $num_per_page = 5, $where = "")
{

    if (!empty($where))
        $where = "WHERE {$where}";
    $list_pages = db_fetch_array("SELECT * FROM `tbl_post` {$where} LIMIT {$start}, $num_per_page");
    return $list_pages;
}
function get_category_name_by_id()
{
    $item = db_fetch_array("  SELECT `tbl_post`.*, `tbl_post_categories`.category_name
                            FROM `tbl_post`
                            INNER JOIN `tbl_post_categories`  ON `tbl_post`.category_id = `tbl_post_categories`.category_id
                            WHERE `tbl_post`.category_id = `tbl_post_categories`.category_id"
                            
                        );
    if (!empty($item))
        return $item;
}

//edit
function check_post_id($post_id){
    $item = db_num_rows("SELECT * FROM `tbl_post` WHERE `post_id` = '{$post_id}'");
    if (!empty($item))
        return $item;
}
function get_post_by_id($post_id){
    $item = db_fetch_row("SELECT * FROM `tbl_post` WHERE `post_id`= '{$post_id}'");
    if (!empty($item))
        return $item;
}
function update_post($post_id, $data){
    return db_update('tbl_post', $data, "`post_id` = '{$post_id}'");
}
//lay id danh muc
 function get_category_edit(){
    $item = db_fetch_array("SELECT * FROM `tbl_post`");
    if (!empty($item))
        return $item;
 }

//delete
function delete_post($id){
    return db_delete('tbl_post', "`post_id` = '{$id}'");
}

//cat (danh mục)
function get_post_category(){
    $item = db_fetch_array("SELECT * FROM `tbl_post_categories`");
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

function check_category_id($parent_id ){
    foreach($parent_id as $item){
    $item = $item['parent_id'];
    $result_child = db_fetch_array("SELECT * FROM `tbl_post_categories` WHERE `category_id` = $item");
    }
     return $result_child;
}
function update_post_categories($data){
    return db_insert('tbl_post_categories', $data);
}
function update_cat($id, $data){
    return db_update('tbl_post_categories', $data, "`category_id` = '{$id}'");
}
function get_cat_by_id($id){
    $item = db_fetch_row("SELECT * FROM `tbl_post_categories` WHERE `category_id`= '{$id}'");
    if (!empty($item))
        return $item;
}
function delete_cat($id){
    return db_delete('tbl_post_categories', "`category_id` = '{$id}'");  
}
//search
function get_post_search($search){
    $item = db_fetch_array("SELECT * FROM `tbl_post` WHERE `post_title` LIKE '%$search%' OR `post_content` LIKE '%$search%'");
    if (!empty($item))
        return $item;
}