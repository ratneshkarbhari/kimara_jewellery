<main class="page-content" id="product-page">


    <section id="product-details-section">
    
        <div class="container-fluid">
        
            <div class="row">

                <div class="col-lg-4 col-md-12 col-sm-12">
                
                
                    <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" id="product-page-main-product-image" style="width: 100%;">
                
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12">
                
                    <h1 class="product-title"><?php echo $product['title']; ?></h1>

                    <?php if($product['sale_price']!=0.00): ?>
                        <span class="larger-price-card"> ₹ <?php echo $product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span></del>
                    <?php else: ?>
                        <span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span>
                    <?php endif; ?>

                    <div class="container-fluid">
                    
                        <div class="row">
                        
                            <div  class="col-lg-4 col-md-6 col-sm12 form-group">
                            
                                <label for="product-material">Material:</label>

                                <select class="form-control" id="product-material">
                                    <?php $materials = explode(',',$product['materials']); foreach($materials as $material): ?>
                                    <option value="<?php echo $material; ?>"><?php echo ucfirst($material); ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="col-lg-4 col-md-6 col-sm12 form-group">
                            
                                <label for="product-size">Size:</label>

                                <select class="form-control" id="product-size">
                                    <?php $sizes = explode(',',$product['sizes']); foreach($sizes as $size): ?>
                                    <option value="<?php echo $size; ?>"><?php echo ucfirst($size); ?></option>
                                    <?php endforeach; ?>

                                </select>

                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12 form-group">
                                <label for="product-material">Quantity:</label>

                                <select class="form-control" id="product-material">
                                    <?php $materials = explode(',',$product['materials']); foreach($materials as $material): ?>
                                    <option value="<?php echo $material; ?>"><?php echo ucfirst($material); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>


                            <div class="col-lg-4 col-md-12 col-sm-12" style="padding:0;">
                            <button type="button" class="btn btn-success">ADD to Cart</button>

                            </div>

                            


                        
                        </div>

                    
                    </div>

                    <div id="description-box" style="margin-top: 10%;">
                    
                    <h3>Description</h3>

                    <p class="product-description"><?php echo $product['description']; ?></p>
                    </div>

                    
                
                </div>
            
            
            </div>
        
        </div>
    
    </section>

</main>