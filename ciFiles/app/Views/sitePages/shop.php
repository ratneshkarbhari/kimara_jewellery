
<main class="page-content" id="shop">

    <div class="container-fluid">
    
        <div class="row" style="margin: 5% 0;">
        
            <div class="col-lg-3 col-md-12 col-sm-12 d-none">
            
                <h4 class="section-title">Filter Products</h4>
                <br>
                <h5>by categories</h5>
                <?php foreach($categories as $category): ?>
                    <div class="form-check">
                        <input class="form-check-input filter-ip" filter-type="category" type="checkbox" value="<?php echo $category['id']; ?>" id="category-<?php echo $category['id']; ?>">
                        <label class="form-check-label" for="category-<?php echo $category['id']; ?>">
                            <?php echo $category['title']; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">

            <div class="container-fluid" style="padding: 0;">
                    
                    <h1 class="section-title" id="filtered-title">ALL Products</h1>
        
                            
                    <div class="row" >
        
                        <?php foreach($products as $product):  ?>
                    
                        <div class="col-lg-3 col-md-6-sm-12 text-center custom-half-grid" style="margin-bottom: 5%;">
                        
                            <a href="<?php echo site_url('product/'.$product['slug']); ?>">
                                <div class="card">
                                
                                    <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="card-img-top">
                                
                                    <div class="card-body">
                                    
                                    <h6 class="product-title"><?php if(strlen($product['title'])>9){
                                        echo substr($product['title'],0,9).'...';
                                        }else {
                                        echo $product['title'];
                                        } ?></h6>                                        <?php if($product['sale_price']!=0.00): ?>
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
        
                        <?php endforeach; ?>
        
                    </div>
                
                </div>
            
            
            </div>
        
        </div>
    
    </div>

</main>