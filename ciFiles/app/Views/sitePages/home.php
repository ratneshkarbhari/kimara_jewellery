<main class="page-container" id="home">
    <section id="home-slider-section" class="d-none d-lg-block">
        <div id="home-hero-slider" class="owl-carousel">
            <a href="https://www.facebook.com" target="_blank">
                <img src="<?php echo site_url('assets/images/banners/kids_banner.webp'); ?>" class="w-100">
            </a>
            <a href="https://www.facebook.com" target="_blank">
            <img src="<?php echo site_url('assets/images/banners/men_banner1.webp'); ?>" class="w-100">
            </a>
            <a href="https://www.facebook.com" target="_blank">
                <img src="<?php echo site_url('assets/images/banners/manyavar_amitabh.jpg'); ?>" 
                class="w-100">
            </a>
        </div>
    </section>
    <section id="home-slider-section" class="d-sm-block d-md-block d-lg-none">
        <div id="home-hero-slider-mobile" class="owl-carousel">
            <a href="https://www.facebook.com" target="_blank">
                <img src="<?php echo site_url('assets/images/banners/mb1.jpg'); ?>" 
                class="w-100">
            </a>
            <a href="https://www.facebook.com" target="_blank">
                <img src="<?php echo site_url('assets/images/banners/mb1.jpg'); ?>" 
                class="w-100">
            </a>
            <a href="https://www.facebook.com" target="_blank">
                <img src="<?php echo site_url('assets/images/banners/mb1.jpg'); ?>" 
                class="w-100">
            </a>
        </div>
    </section>
    <section id="featured-products" class="regular-section d-none d-lg-block">
    
        <div class="container-fluid">
        
            <h1 class="text-center section-title">Categories</h1>

            <div class="row" style="margin-top: 3%;">
                
                <?php foreach($categories as $category): ?>
                <div class="col-lg-4 d-md-6 d-sm-6 custom-half-grid" style="margin-bottom: 3%;">
                
                    <a href="<?php echo site_url('category/'.$category['slug']); ?>">
                    

                        <img src="<?php echo site_url('assets/images/category_featured_images/'.$category['featured_image_rect']); ?>" class="card-img-top">


                        
                    
                    </a>
                
                </div>
                <?php endforeach; ?>
                
            </div>
        
        </div>
    
    </section>
    <section id="featured-products" class="regular-section d-sm-block d-md-block d-lg-none" style="padding-bottom: 5%;">
    
        <div class="container-fluid">
        
            <h1 class="text-center section-title" style="font-size: 1.5rem !important;">Categories</h1>

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
    <section id="product-collections" class="regular-section grey-bg">
        <div class="container-fluid">

            <h1 class="text-center section-title" style="font-size: 1.5rem !important;">Collections</h1>

            <div class="container">
                <div class="row">
                
                    <div class="col-lg4 col-md-12 col-sm-12"></div>
                    <div class="col-lg4 col-md-12 col-sm-12">
                    
                        <div class="text-center">
                            <ul class="nav nav-pills nav-justified" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Best Sellers</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">New Arrivals</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Top Rated</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" style="padding-top: 3%;">
                                    <div class="row" syyle="margin-top: 3%;"><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-1"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604468903_3ada8ddb6a0dd7aee7ff.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 5.00</span> | <del><span class="smaller-price-card"> ₹ 10.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-2"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604469243_997a9668fe6fd90c20d3.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 10.00</span> | <del><span class="smaller-price-card"> ₹ 20.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-1"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604468903_3ada8ddb6a0dd7aee7ff.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 5.00</span> | <del><span class="smaller-price-card"> ₹ 10.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-2"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604469243_997a9668fe6fd90c20d3.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 10.00</span> | <del><span class="smaller-price-card"> ₹ 20.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div></div>
                                </div>
                                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" style="padding-top: 3%;">
                                    <div class="row" syyle="margin-top: 3%;"><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-1"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604468903_3ada8ddb6a0dd7aee7ff.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 5.00</span> | <del><span class="smaller-price-card"> ₹ 10.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-2"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604469243_997a9668fe6fd90c20d3.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 10.00</span> | <del><span class="smaller-price-card"> ₹ 20.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-1"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604468903_3ada8ddb6a0dd7aee7ff.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 5.00</span> | <del><span class="smaller-price-card"> ₹ 10.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-2"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604469243_997a9668fe6fd90c20d3.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 10.00</span> | <del><span class="smaller-price-card"> ₹ 20.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div></div>
                                </div>
                                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" style="padding-top: 3%;">
                                
                                    <div class="row" syyle="margin-top: 3%;"><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-1"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604468903_3ada8ddb6a0dd7aee7ff.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 5.00</span> | <del><span class="smaller-price-card"> ₹ 10.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-2"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604469243_997a9668fe6fd90c20d3.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 10.00</span> | <del><span class="smaller-price-card"> ₹ 20.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-1"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604468903_3ada8ddb6a0dd7aee7ff.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 5.00</span> | <del><span class="smaller-price-card"> ₹ 10.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div><div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;"> <a href="http://localhost/kimara_jewellery/product/random-product-2"><div class="card"> <img src="http://localhost/kimara_jewellery/assets/images/featured_image_product/1604469243_997a9668fe6fd90c20d3.jpg" class="card-img-top"><div class="card-body"><h6 class="product-title">Random Test Product 2</h6><span class="larger-price-card"> ₹ 10.00</span> | <del><span class="smaller-price-card"> ₹ 20.00</span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a></div></div>
                                
                                </div>
                            </div>
                        </div>                    
                    </div>
                    <div class="col-lg4 col-md-12 col-sm-12"></div>
                    
                </div>
            </div>



        </div>
    </section>
    <section id="featured-products" class="regular-section">
        <div class="container-fluid">
                    
            <h1 class="text-center section-title" style="font-size: 1.5rem !important;">Featured Products</h1>

                    
            <div class="row" syyle="margin-top: 3%;">

                <?php foreach($products as $product): if($product['featured']=='yes'): ?>
            
                <div class="col-lg-3 col-md-6-sm-6 text-center custom-half-grid" style="margin-bottom: 2%;">
                
                    <a href="<?php echo site_url('product/'.$product['slug']); ?>">
                        <div class="card">
                        
                            <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="card-img-top">
                        
                            <div class="card-body">
                            
                            <h6 class="product-title"><?php echo $product['title']; ?></h6>

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
</main>
<style>
.slide{
    min-height: 70vh;
    max-height: 70vh;
}
h1.text-center.section-title{
    font-size: 1.5 rem !important;
}
a.nav-link.active{
    color: #fff !important;
}
</style>