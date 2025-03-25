<?php
require('includes/header.php');
?>
<div class="container">
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Thêm Sản Phẩm</h1>
                        </div>
                        <form class="user" method="post" action="addproduct.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user"
                                    id="name" name="name" aria-describedby="emailHelp"
                                    placeholder="Tên sản phẩm">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Tóm tắt sản phẩm:</label>
                                <textarea name="sumary" class="form-control"></textarea>    
                            </div>
                            <div class="form-group">
                                <label class="form-label">Mô tả sản phẩm:</label>
                                <textarea name="description" class="form-control"></textarea>    
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                        id="stock" name="stock" placeholder="Số lượng nhập">
                                </div>
                                <div class="col-sm-4 mb-sm-0"> 
                                    <input type="text" class="form-control form-control-user"
                                        id="giagoc" name="giagoc" placeholder="Giá gốc">
                                </div>
                                <div class="col-sm-4 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                        id="giaban" name="giaban" placeholder="Giá bán">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Danh mục:</label>  
                                <select class="form-control" name="danhmuc">            
                                    <option>Chọn danh mục</option>
                                    <?php
                                    require('../db/connectDB.php');
                                    $sql_str = "SELECT * FROM categories ORDER BY name";
                                    $result = mysqli_query($conn, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?> 
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Thương hiệu:</label>
                                <select class="form-control" name="thuonghieu"> 
                                    <option>Chọn thương hiệu</option>   
                                    <?php
                                    require('../db/connectDB.php');
                                    $sql_str = "SELECT * FROM brands ORDER BY name";
                                    $result = mysqli_query($conn, $sql_str);
                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>        
                                    <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Hình ảnh sản phẩm:</label>
                                <input type="file" name="anhs[]" class="form-control" multiple>
                            </div>
                            <button class="btn btn-primary">Tạo mới</button>
                        </form>
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
require('includes/footer.php');
?>
