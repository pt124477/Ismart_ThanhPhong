<?php get_header();
get_sidebar();
?>
<div id="wp-content">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách bài viết</h5>
                <div class="form-search form-inline">
                    <form action="" method="POST">
                        <input type="" class="form-control form-search" name="search" placeholder="Tìm kiếm">
                        <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="analytic">
                    <a href="" class="text-primary">Trạng thái 1<span class="text-muted">(10)</span></a>
                    <a href="" class="text-primary">Trạng thái 2<span class="text-muted">(5)</span></a>
                    <a href="" class="text-primary">Trạng thái 3<span class="text-muted">(20)</span></a>
                </div>
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="">
                        <option>Chọn</option>
                        <option>Tác vụ 1</option>
                        <option>Tác vụ 2</option>
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
                <table class="table table-striped table-checkall">
                    <thead>

                        <tr>
                            <th scope="col">
                                <input name="checkall" type="checkbox">
                            </th>
                            <th scope="col">#</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Nội dung</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $temp = 0; 
                        foreach ($list_page as $item) {
                            $temp++;
                            ?>
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td scope="row"><?php echo $item['page_id'] ?></td>
                                <td><a href=""><?php echo $item['page_title'] ?></a></td>
                                <td><?php echo $item['page_content'] ?></td>
                                <td><?php echo $item['created_at'] ?></td>
                                <td>
                                    <a href="?mod=pages&action=edit&id=<?php echo $item['page_id']?>">
                                        <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                    </a>
                                    <a href="?mod=pages&action=delete&id=<?php echo $item['page_id'] ?>">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Xóa bài viết"><i class="fa fa-trash"></i></button>
                                    </a>
                                </td>

                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <nav aria-label="Page navigation example">

                <?php echo  get_pagging($num_page, $page , "?mod=pages&action=list_pages") ?>
                <p class="num-rows"> Có tổng <?php echo $num_rows ?> bài viết </p>
                <!-- <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">Trước</span>
                                <span class="sr-only">Sau</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>
                    </ul> -->
                </nav>
            </div>
        </div>
    </div>
</div>
<?php get_footer() ?>