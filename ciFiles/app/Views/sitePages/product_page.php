<main class="page-content" id="product-page">


    <section id="product-details-section">
    
        <div class="container">
        
            <div class="row">

                <div class="col-lg-6 col-md-12 col-sm-12" style="margin-bottom: 5%;">
                
                
                    <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" id="product-page-main-product-image" style="width: 100%; border: 1px solid darkgray;">
                
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                
                    <h1 class="product-title"><?php echo $product['title']; ?></h1>

                    <?php if($product['sale_price']!=0.00): ?>
                        <span class="larger-price-card"> ₹ <?php echo $product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span></del>
                    <?php else: ?>
                        <span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span>
                    <?php endif; ?>

                    <div class="container-fluid">
                    
                        <div class="row">
                        
                            <div  class="col-lg-4 col-md-6 col-sm12 form-group" style="padding-left: 0;">
                            
                                <label for="product-material">Material:</label>

                                <select class="form-control" id="product-material">
                                    <?php $materials = explode(',',$product['materials']); foreach($materials as $material): ?>
                                    <option value="<?php echo $material; ?>"><?php echo ucfirst($material); ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <div class="col-lg-4 col-md-6 col-sm12 form-group" style="padding-left: 0;">
                            
                                <label for="product-size">Size:</label>

                                <select class="form-control" id="product-size">
                                    <?php $sizes = explode(',',$product['sizes']); foreach($sizes as $size): ?>
                                    <option value="<?php echo $size; ?>"><?php echo ucfirst($size); ?></option>
                                    <?php endforeach; ?>

                                </select>

                            </div>
                            <div class="col-lg-8 col-md-12 col-sm-12 form-group" style="padding-left: 0;">
                                <label for="product-quantity">Quantity:</label>

                                <select class="form-control" id="product-quantity">
                                    <?php for($i=1;$i<=5;$i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <br>
                            <div class="col-lg-12 col-md-12 col-sm-12" style="padding:0;">
                                
                                <p id="atc-success" class="text-success" style="color: darkgreen !important;"></p>
                                <p id="atc-failure" class="text-danger"></p>
                                        
                                <button type="button" id="addToCartButton" class="btn btn-success" style="background-color: black; color:white;">ADD to Cart</button>
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

<script>
    $("button#addToCartButton").click(function (e) { 
        e.preventDefault();
        let productMaterial = $("select#product-material").val();
        let productSize = $("select#product-size").val();
        let productQuantity = $("select#product-quantity").val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('add-to-cart-exe'); ?>",
            data: {
                product_id : '<?php echo $product['id']; ?>',
                material : productMaterial,
                size : productSize,
                quantity : productQuantity
            },
            success: function (response) {
                if(response=='success'){
                    $("p#atc-success").html('Added to Cart Successfully');
                    setTimeout(function() {
                        $("p#atc-success").html('');
                    }, 3000);

                }else{
                    $("p#atc-failure").html('Added to Cart Successfully');
                    setTimeout(function() {
                        $("p#atc-failure").html('');
                    }, 3000);
                }
            }
        });
    });

</script>