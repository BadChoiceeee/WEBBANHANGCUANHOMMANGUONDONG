<?php 
session_start();
$is_homepage = false;
require_once('components/header.php'); 
//lay tu khoa
$danhmuc = $_GET['danhmuc'];
$tukhoa = $_GET['tukhoa'];
?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Danh mục sản phẩm</h4>
                            <ul>
                            <?php
                            require('./db/connectDB.php');
                            $sql_str = "SELECT * FROM categories ORDER BY name";
                            $result = mysqli_query($conn, $sql_str);

                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <li><a href="#"><?php echo htmlspecialchars($row['name']); ?></a></li>
                            <?php
                            }
                            ?>
                        </ul>
                        </div>
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Sản phẩm mới nhất</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                            $sql_str = "SELECT * FROM products ORDER BY created_at desc limit 0,3 ";
                                            $result = mysqli_query($conn, $sql_str);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $anh_arr = explode(';', $row['images']);
                                        ?>
                                        <a href="sanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                            <img src="<?= htmlspecialchars("admin/".$anh_arr[0]) ?>" alt="" style="width: 110px; height: 110px; object-fit: cover;">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?php echo htmlspecialchars($row['name']); ?></h6>
                                                <span><?php echo htmlspecialchars($row['price']); ?></span>
                                            </div>
                                        </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                            $sql_str = "SELECT * FROM products ORDER BY created_at desc limit 3,6 ";
                                            $result = mysqli_query($conn, $sql_str);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $anh_arr = explode(';', $row['images']);
                                        ?>
                                        <a href="sanpham.php?id=<?=$row['id']?>" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                            <img src="<?= htmlspecialchars("admin/".$anh_arr[0]) ?>" alt="" style="width: 110px; height: 110px; object-fit: cover;">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?php echo htmlspecialchars($row['name']); ?></h6>
                                                <span><?php echo htmlspecialchars($row['price']); ?></span>
                                            </div>
                                        </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <?php
                                            $sql_str = "SELECT * FROM products ORDER BY created_at desc limit 6,9 ";
                                            $result = mysqli_query($conn, $sql_str);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $anh_arr = explode(';', $row['images']);
                                        ?>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                            <img src="<?= htmlspecialchars("admin/".$anh_arr[0]) ?>" alt="" style="width: 110px; height: 110px; object-fit: cover;">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6><?php echo htmlspecialchars($row['name']); ?></h6>
                                                <span><?php echo htmlspecialchars($row['price']); ?></span>
                                            </div>
                                        </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <h3> Kết quả tìm kiếm </h3>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select>
                                        <option value="0">Default</option>
                                        <option value="0">Default</option>
                                    </select>
                                </div>
                            </div>

                            <?php
                            if($danhmuc=='*'){
                                $sql_str = "SELECT * from products where 
                                (name like '%$tukhoa%'
                                or description like '%$tukhoa%'
                                or summary like '%$tukhoa%')
                                order by name";
                            }else{
                                $sql_str = "SELECT * from products where 
                                (category_id = $danhmuc)
                                and 
                                (name like '%$tukhoa%'
                                or description like '%$tukhoa%'
                                or summary like '%$tukhoa%')
                                order by name";
                                }
                                $result = mysqli_query($conn, $sql_str);
                            ?>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6>Có <span><?= mysqli_num_rows($result) ?></span> sản phẩm</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $anh_arr = explode(';', $row['images']);
                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="<?= htmlspecialchars("admin/".$anh_arr[0]) ?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="sanpham.php?id=<?=$row['id']?>"><?php echo htmlspecialchars($row['name']); ?></a></h6>
                                    <h5><?php echo htmlspecialchars($row['price']); ?></h5>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Giảm giá</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                            <?php
                                require('./db/connectDB.php');
                                $sql_str = "SELECT products.id as pid, products.name AS pname, categories.name AS cname, ROUND((price - disscounted_price) / price * 100) AS discount, images, price, disscounted_price FROM products, categories WHERE products.category_id = categories.id ORDER BY discount DESC LIMIT 0, 6;";
                                $result = mysqli_query($conn, $sql_str);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $anh_arr = explode(';', $row['images']);
                            ?>
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="<?= htmlspecialchars("admin/".$anh_arr[0]) ?>">
                                            <div class="product__discount__percent">-<?php echo htmlspecialchars($row['discount']); ?>%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span><?php echo htmlspecialchars($row['cname']); ?></span>
                                            <h5><a href="sanpham.php?id=<?=$row['pid']?>"><?php echo htmlspecialchars($row['pname']); ?></a></h5>
                                            <div class="product__item__price"><?php echo htmlspecialchars($row['disscounted_price']); ?><span><?php echo htmlspecialchars($row['price']); ?> </span></div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

<?php require_once('components/footer.php'); ?>