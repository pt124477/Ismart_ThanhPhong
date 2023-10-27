<?php
function check_user_id($user_id)
{
    $item = db_num_rows("SELECT * FROM `tlb_users` WHERE `user_id` = '{$user_id}'");
    if (!empty($item))
        return $item;
}
function check_page_id($page_id)
{
    $item = db_num_rows("SELECT * FROM `tbl_pages` WHERE `page_id` = '{$page_id}'");
    if (!empty($item))
        return $item;
}
function insert_page($user_id, $data)
{
    return db_insert('tbl_pages', $data, "`user_id` = '{$user_id}'");
}
function update_page($page_id, $data)
{
    return db_update('tbl_pages', $data, "`page_id` = '{$page_id}'");
}
function get_users_by_username($username)
{
    $item = db_fetch_row("SELECT * FROM `tlb_users` WHERE `username`= '{$username}'");
    if (!empty($item))
        return $item;
}
function get_page_by_user_id($user_id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `user_id`= '{$user_id}'");
    if (!empty($item))
        return $item;
}

//list_pages
function get_list_pages_by_id()
{
    $item = db_fetch_array("SELECT * FROM `tbl_pages`");
    if (!empty($item))
        return $item;
}
function delete_pages($id)
{
    return db_delete('tbl_pages', "`page_id` = '{$id}'");
}
function get_page_by_id($page_id)
{
    $item = db_fetch_row("SELECT * FROM `tbl_pages` WHERE `page_id`= '{$page_id}'");
    if (!empty($item))
        return $item;
}
//phan trang list pages
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
function get_pages($start = 1, $num_per_page = 5, $where = "")
{

    if (!empty($where))
        $where = "WHERE {$where}";
    $list_pages = db_fetch_array("SELECT * FROM `tbl_pages` {$where} LIMIT {$start}, $num_per_page");
    return $list_pages;
}
//search
function list_page_search($search){
    $item = db_fetch_array("SELECT * FROM `tbl_pages` WHERE `page_title` LIKE '%$search%' OR `page_content` LIKE '%$search%'");
    if (!empty($item))
        return $item;
}