<main class="page-content" id="shop">

    <div class="container">
    
        <div class="row" style="margin: 5% 0;">
        
            <div class="col-lg-3 col-md-12 col-sm-12"></div>
            <div class="col-lg-9 col-md-12 col-sm-12">

            <div class="container-fluid">
                    
                    <h1 class="section-title" id="filtered-title">ALL Products</h1>
        
                            
                    <div class="row" >
        
                        <?php foreach($products as $product):  ?>
                    
                        <div class="col-lg-4 col-md-6-sm-12">
                        
                            <a href="<?php echo site_url('product/'.$product['slug']); ?>">
                                <div class="card">
                                
                                    <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="card-img-top">
                                
                                    <div class="card-body">
                                    
                                        <h4 class="product-title"><?php echo substr($product['title'],0,12); ?><?php if(strlen($product['title'])>13){echo '...';} ?></h4>
        
                                        <?php if($product['sale_price']!=0.00): ?>
                                        <span class="larger-price-card"> ₹ <?php echo $product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span></del>
                                        <?php else: ?>
                                        <span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span>
                                        <?php endif; ?>
        
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