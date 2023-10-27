<?php
get_header();
get_sidebar();
?>
<div id="wp-content">
    <div id="content" class="container-fluid">
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Thêm danh mục
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="parent_id">Id danh mục cha</label>
                                <input class="form-control" type="text" name="parent_id" id="name">
                            </div>
                            <div class="form-group">
                                <label for="category_desc">Mô tả</label>
                                <textarea class="form-control" type="text" name="category_desc" id="name"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_name">Tên danh mục</label>
                                <input class="form-control" type="text" name="category_name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="">Danh mục cha</label>
                                <select class="form-control" id="">
                                    <?php foreach ($data_tree as $item) { ?>
                                        <optgroup class="optgroup-item">
                                            <option><?php echo str_repeat('—|', $item['level']) . $item['category_name'] ?>
                                        </optgroup>
                                        </option>

                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Trạng thái</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                    <label class="form-check-label" for="exampleRadios1">
                                        Chờ duyệt
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                                    <label class="form-check-label" for="exampleRadios2">
                                        Công khai
                                    </label>
                                </div>
                            </div>



                            <button type="submit" name="btn-add" class="btn btn-primary">Thêm mới</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-header font-weight-bold">
                        Danh mục
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tên danh mục</th>
                                    <th scope="col">Parent id</th>
                                    <th>Tác vụ</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($post_categories as $item) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $item['category_id'] ?></th>
                                        <td><?php echo $item['category_name'] ?></td>
                                        <td><?php echo $item['parent_id'] ?></td>
                                        <td>
                                            <a href="?mod=post&action=editCat&id=<?php echo $item['category_id'] ?>">
                                                <button class="btn btn-success btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></button>
                                            </a>
                                            <a href="?mod=post&action=deleteCat&id=<?php echo $item['category_id'] ?>" onclick="deleteAlert()">
                                                <button class="btn btn-danger btn-sm rounded-0" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script>
    function deleteAlert() {
        // Sử dụng hộp thoại xác nhận
        if (confirm("Bạn có chắc chắn muốn xóa hàng cha? Thao tác này có thể ảnh hưởng đến dữ liệu hàng con.")) {
            // Thực hiện xóa hàng cha ở đây (có thể là AJAX request hoặc gì đó)
            alert("Hàng cha đã được xóa.");
        } else {
            // Người dùng đã hủy thao tác xóa
            alert("Thao tác xóa đã bị hủy.");
        }
    }
</script>
<?php get_footer(); ?>