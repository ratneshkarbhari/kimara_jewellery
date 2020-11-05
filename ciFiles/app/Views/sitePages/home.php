<main class="page-container" id="home">
    <section id="home-slider-section">
        <div id="home-hero-slider" class="owl-carousel">
            <a href="https://www.facebook.com" target="_blank">
                <div class="slide" style="background-position: center; background-image: url('<?php echo site_url('assets/images/banners/banner1.jpg'); ?>');">
                    
                </div>
            </a>
            <a href="https://www.facebook.com" target="_blank">
                <div class="slide" style="background-position: center; background-image: url('<?php echo site_url('assets/images/banners/banner2.jpg'); ?>');">
                    
                </div>
            </a>
            <a href="https://www.facebook.com" target="_blank">
                <div class="slide" style="background-position: center; background-image: url('<?php echo site_url('assets/images/banners/banner3.jpg'); ?>');">
                    
                </div>
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
        
            <h1 class="text-center section-title">Categories</h1>

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
    <section id="featured-products" class="regular-section grey-bg">
        <div class="container-fluid">
                    
            <h1 class="text-center section-title">Featured Products</h1>

                    
            <div class="row" syyle="margin-top: 3%;">

                <?php foreach($products as $product): if($product['featured']=='yes'): ?>
            
                <div class="col-lg-3 col-md-6-sm-12 text-center" style="margin-bottom: 2%;">
                
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
</style>