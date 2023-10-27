<?php
get_header();
get_sidebar();
?>
<div id="wp-content">
    <div id="content" class="container-fluid">
        <div class="card">
            <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
                <h5 class="m-0 ">Danh sách bài viết</h5>
                <div class="form-search form-inline">
                    <form action="" method="POST">
                        <input type="" name="search" class="form-control form-search" placeholder="Tìm kiếm">
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
                            <th scope="col">Ảnh</th>
                            <th scope="col">Tiêu đề</th>
                            <th scope="col">Danh mục</th>
                            <th scope="col">Ngày tạo</th>
                            <th scope="col">Tác vụ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Tạo mảng tương ứng giữa category_id và category_name
                        $categoryMap = array();
                        foreach ($category_name as $category_item) {
                            $categoryMap[$category_item['category_id']] = $category_item['category_name'];
                        } ?>
                        <!-- //cần sữa lại -->
                        <?php 
                        $imageMap = array();
                        foreach ($post_images as $image_item) {
                            $imageMap[$image_item['image_id']] = $image_item['image_url'];
                        } ?>

                        <?php
                        $i = 0;
                        foreach ($list_post as $item) {
                            $i++;
                            $categoryId = $item['category_id'];
                            $categoryName = isset($categoryMap[$categoryId]) ? $categoryMap[$categoryId] : 'chưa có';

                            $imageId = $item['image_id'];
                            $imageUrl = isset($imageMap[$imageId]) ? $imageMap[$imageId] : 'chưa có';

                        ?>
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td scope="row"><?php echo $i ?></td>
                                <td><img class="image_product" src="public/images/<?php echo $imageUrl ?>" alt=""></td>
                                <td><a href=""><?php echo $item['post_title'] ?></a></td>

                                <td><?php echo $categoryName ?></td>


                                <td><?php echo $item['created_at'] ?></td>

                                <td>
                                    <a href="?mod=post&action=edit&id=<?php echo $item['post_id'] ?>">
                                        <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                    </a>
                                    <a href="?mod=post&action=delete&id=<?php echo $item['post_id'] ?>">
                                        <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                    </a>
                                </td>

                            </tr>
                        <?php } ?>



                    </tbody>
                </table>
                <nav aria-label="Page navigation example">
                    <?php echo  get_pagging($num_page, $page, "?mod=post&action=list_post") ?>
                    <p class="num-rows"> Có tổng <?php echo $num_rows ?> bài viết </p>
                </nav>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?>