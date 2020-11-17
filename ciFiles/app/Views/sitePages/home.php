<link rel="stylesheet" href="<?php echo site_url('assets/css/owl.carousel.min.css'); ?>" >
    <link rel="stylesheet" href="<?php echo site_url('assets/css/owl.theme.default.min.css'); ?>" >
<main class="page-container" id="home">

    <section id="home-slider-section" class="d-sm-block d-md-block d-lg-none" style="padding: 2% 0;">
        <div id="home-category-slider-mobile" class="owl-carousel text-center">
            <?php foreach($categories as $category): if($category['parent']==0): ?>
            <a href="<?php echo site_url('category/'.$category['slug']); ?>" target="_blank">
                <img style="border-radius: 50%;" src="<?php echo site_url('assets/images/category_featured_images/'.$category['featured_image_circular']); ?>" 
                class="w-100">
                <small><?php echo $category['title']; ?></small>
            </a>
            <?php endif; endforeach; ?>
        </div>
    </section>
    
    <section id="home-slider-section" class="d-none d-lg-block">
        <div id="home-hero-slider" class="owl-carousel owl-theme">
            <?php foreach($slides as $slide): ?>
            <a href="<?php echo $slide['link'] ?>" target="_blank">
                <img src="<?php echo site_url('assets/images/banners/'.$slide['desktop_image']); ?>" class="w-100">
            </a>
            <?php endforeach; ?>
        </div>
    </section>
    <section id="home-slider-section" class="d-sm-block d-md-block d-lg-none">
        <div id="home-hero-slider-mobile" class="owl-carousel owl-theme">

            <?php foreach($slides as $slide): ?>
            <a href="<?php echo $slide['link'] ?>" target="_blank">
                <img src="<?php echo site_url('assets/images/banners/'.$slide['touch_image']); ?>" class="w-100">
            </a>
            <?php endforeach; ?>

        </div>
    </section>
    <section id="static-banners" style="background-color: white !important;">
        <div class="container-fluid text-center">
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-12"></div>
                <div class="col-lg-5 col-md-5 col-sm-12" style="margin-bottom: 3% !important;">
                    <a href="<?php echo site_url('shop'); ?>">
                        <img src="<?php echo site_url('assets/images/b1.jpg'); ?>" class="w-100">
                    </a>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-12" style="margin-bottom: 3% !important;">
                    <a href="<?php echo site_url('shop'); ?>">
                        <img src="<?php echo site_url('assets/images/b2.jpg'); ?>" class="w-100">
                    </a>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-12"></div>
            </div>
        </div>
    </section>
    <section id="daily-deals" class="regular-section">
        <div class="container-fluid">
        
            <h1 class="text-center section-title">Daily Deals</h1>

            <div class="owl-carousel text-center owl-theme" id="daily-deals-carousel">
                
                <?php foreach ($products as $product): if($product['daily_deal']=='yes'): ?>
            
                    <a href="<?php echo site_url('product/'.$product['slug']); ?>"><div class="card"> <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="card-img-top"><div class="card-body">                            <h6 class="product-title"><?php if(strlen($product['title'])>9){
                                        echo substr($product['title'],0,9).'...';
                                        }else {
                                        echo $product['title'];
                                        } ?></h6><span class="larger-price-card"> ₹ <?php echo $product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a>


                <?php endif; endforeach; ?>
            
            </div>

        </div>
    </section>
    <section id="categories" class="regular-section d-none d-lg-block grey-bg">
    
        <div class="container-fluid">
        
            <h1 class="text-center section-title">Categories</h1>

            <div class="row" style="margin-top: 3%;">
                
                <?php foreach($categories as $category): ?>
                <div class="col-lg-4 d-md-6 d-sm-6 " style="margin-bottom: 3%; ">
                
                    <a href="<?php echo site_url('category/'.$category['slug']); ?>">
                    

                        <img src="<?php echo site_url('assets/images/category_featured_images/'.$category['featured_image_rect']); ?>" class="card-img-top">


                        
                    
                    </a>
                
                </div>
                <?php endforeach; ?>
                
            </div>
        
        </div>
    
    </section>
    <section id="categories-mobile" class="regular-section d-sm-block d-md-block d-lg-none grey-bg" style="padding-bottom: 5%;">

        
    
        <div class="container-fluid">
        
            <h1 class="text-center section-title" >Categories</h1>

            <div class="row" style="margin-top: 3%;">
                
                <?php foreach($categories as $category): ?>
                <div class="col-lg-4 d-md-6 d-sm-6 custom-half-grid" style="margin-bottom: 3%;">
                
                    <a href="<?php echo site_url('category/'.$category['slug']); ?>">
                    

                        <img src="<?php echo site_url('assets/images/category_featured_images/'.$category['featured_image_square']); ?>" class="card-img-top">


                        
                    
                    </a>
                
                </div>
                <?php endforeach; ?>
                
            </div>
        
        </div>

    </section>
    <section id="product-collections" class="regular-section ">
        <div class="container-fluid">

            <h1 class="text-center section-title" >Collections</h1>

            <div class="container-fluid">
                <div class="row">
                
                    <div class="col-lg-12 col-md-12 col-sm-12"></div>
                    <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-4"></div>
                        <div class="col-lg-6 col-md-4 col-sm-4">
                            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-itemx" style="margin: 0 auto;"  role="presentation">
                                    <a class="nav-linkx active" style="font-size: 14px;" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Best Sellers</a>
                                </li>
                                <li class="nav-itemx" style="margin: 0 auto;"  role="presentation">
                                    <a class="nav-linkx" style="font-size: 14px;" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">New Arrivals</a>
                                </li>
                                <li class="nav-itemx" style="margin: 0 auto;"  role="presentation">
                                    <a class="nav-linkx" style="font-size: 14px;" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Top Rated</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-4"></div>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="padding-top: 3%;">
                                <div class="row" syyle="margin-top: 3%;">

                                <?php  $bsProducts = array_rand($products,4); foreach($bsProducts as $bspro): ?>

                                    <div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%; padding: 5px;"> <a href="<?php echo site_url('product/'.$products[$bspro]['slug']); ?>"><div class="card"> <img src="<?php echo site_url('assets/images/featured_image_product/'.$products[$bspro]['featured_image']); ?>" class="card-img-top"><div class="card-body">                            <h6 class="product-title"><?php if(strlen($products[$bspro]['title'])>9){
                                    echo substr($products[$bspro]['title'],0,9).'...';
                                    }else {
                                    echo $products[$bspro]['title'];
                                    } ?></h6><span class="larger-price-card"> ₹ <?php echo $products[$bspro]['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $products[$bspro]['price']; ?></span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div>


                                <?php  endforeach;?>


                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="padding-top: 3%;">
                                <div class="row" syyle="margin-top: 3%;">
                                    
                                    <?php $productsReverse = array_reverse($products); $counter = 0; foreach ($productsReverse as $product) : if($counter!=5): ?>

                                        <div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%; padding: 5px;"> <a href="<?php echo site_url('product/'.$product['slug']); ?>"><div class="card"> <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="card-img-top"><div class="card-body">                            <h6 class="product-title"><?php if(strlen($product['title'])>9){
                                        echo substr($product['title'],0,9).'...';
                                        }else {
                                        echo $product['title'];
                                        } ?></h6><span class="larger-price-card"> ₹ <?php echo $product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div>

                                    <?php endif; endforeach ?>
                                
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" style="padding-top: 3%;">
                            
                                <div class="row" syyle="margin-top: 3%;">
                                
                                <?php $topProds = array_rand($products,4); foreach($topProds as $tproduct): ?>


                                    <div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%; padding: 5px;"> <a href="<?php echo site_url('product/'.$products[$tproduct]['slug']); ?>"><div class="card"> <img src="<?php echo site_url('assets/images/featured_image_product/'.$products[$tproduct]['featured_image']); ?>" class="card-img-top"><div class="card-body">                            <h6 class="product-title"><?php if(strlen($products[$tproduct]['title'])>9){
                                    echo substr($products[$tproduct]['title'],0,9).'...';
                                    }else {
                                    echo $products[$tproduct]['title'];
                                    } ?></h6><span class="larger-price-card"> ₹ <?php echo $products[$tproduct]['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $products[$tproduct]['price']; ?></span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div>


                                    <?php  endforeach; ?>


                                </div>
                            
                            </div>
                        </div>
                    
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                    
                    
                    </div>

                    
                    
                </div>
            </div>



        </div>
    </section>
    <section id="featured-products" class="regular-section grey-bg">
        <div class="container-fluid">
                    
            <h1 class="text-center section-title">Featured Products</h1>

                    
            <div class="row" syyle="margin-top: 3%;">

                <?php foreach($products as $product): if($product['featured']=='yes'): ?>
            
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 text-center custom-half-grid" style="margin-bottom: 2%; padding: 5px;">
                
                    <a href="<?php echo site_url('product/'.$product['slug']); ?>">
                        <div class="card">
                        
                            <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="card-img-top">
                        
                            <div class="card-body">
                            
                            <h6 class="product-title"><?php if(strlen($product['title'])>9){
                                echo substr($product['title'],0,9).'...';
                            }else {
                                echo $product['title'];
                            } ?></h6>

                                <?php if($product['sale_price']!=0.00): ?>
                                <span class="larger-price-card"> ₹ <?php echo $product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span></del>
                                <?php else: ?>
                                <span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span>
                                <?php endif; ?>

                                <br><br>

                                <button class="btn btn-primary">BUY NOW</button>

                            </div>

                        </div>
                    </a>

                </div>

                <?php endif; endforeach; ?>

            </div>
        
        </div>
    </section>
    <section id="usp-section" class="regular-section" style="background-color: #c09578; color: white;">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-12 text-center col-md-12 col-sm-12">
                

                    <p style="font-size: 30px;"><img src="<?php echo site_url('assets/icons/truck.svg'); ?>" width="30px" height="30px"> Free Shipping for Order above ₹ 10,000</p>
                
                </div>
            </div>
        </div>
    </section>
</main>
<style>
.slide{
    min-height: 70vh;
    max-height: 70vh;
}

a.nav-link.active{
    color: #fff !important;
}
</style>