<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.css" integrity="sha512-UiVP2uTd2EwFRqPM4IzVXuSFAzw+Vo84jxICHVbOA1VZFUyr4a6giD9O3uvGPFIuB2p3iTnfDVLnkdY7D/SJJQ==" crossorigin="anonymous" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.4.1/lity.min.js" integrity="sha512-UU0D/t+4/SgJpOeBYkY+lG16MaNF8aqmermRIz8dlmQhOlBnw6iQrnt4Ijty513WB3w+q4JO75IX03lDj6qQNA==" crossorigin="anonymous"></script>
<main class="page-content" id="product-page">


    <section id="product-details-section" style="padding: 2% 0;">
    
        <div class="container">
        
            <div class="row">

                <div class="col-lg-6 col-md-12 col-sm-12" style="margin-bottom: 5%;">
                
                
                    <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" data-lity id="product-page-main-product-image" style="width: 100%; border: 1px solid darkgray; cursor: pointer;">

                    <div id="product-gallery-box" margin-top: 2%;>
                        <?php $gallery_images = explode(',',$product['gallery_images']); foreach($gallery_images as $gallery_image): ?>

                            <img style="cursor: pointer;" srcset="<?php echo site_url('assets/images/gallery_images_product/'.$gallery_image); ?>" class="product-gallery-image" src="<?php echo site_url('assets/images/gallery_images_product/'.$gallery_image); ?>" width="100px" height="100px">

                        <?php endforeach; ?>
                    </div>
                    
                    <script>
                    $(".product-gallery-image").click(function (e) { 
                        e.preventDefault();
                        $("img#product-page-main-product-image").attr('src',$(this).attr('srcset'));
                    });
                    </script>
                
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

                                <!-- <select class="form-control" id="product-quantity">
                                    <?php for($i=1;$i<=5;$i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select> -->



                                <button class="btn" id="reduce-qty" type="button" style="border-radius: 0 !important; border: 1px solid gray; color: black; padding: 0.5% 2%; margin: 0 2%; width: 50px; height: 50px; font-size: 20px;">-</button><input type="number" id="product-quantity" style="width: 50px; font-size: 15px; height: 49px; text-align: center;" value="1" min="1" readonly><button class="btn" id="add-qty" type="button" style="border-radius: 0 !important; border: 1px solid gray; color: black; padding: 0.5% 2%; width: 50px; height: 50px; font-size: 20px; margin: 0 2%;">+</button>

                            </div>
                            
                            <div class="col-lg-4 col-md-12 col-sm-12"></div>
                            <p id="atc-success" style="margin-bottom: 0;" class="col-lg-12 col-md-12 col-sm-12 text-success" style="color: darkgreen !important;"></p>
                                <p id="atc-failure" class="col-lg-12 col-md-12 col-sm-12 text-danger"></p>
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding:0;">
                                
                                        
                                <button type="button" id="addToCartButton" class="btn btn-success" style="background-color: black; color:white; margin-bottom: 3%;">ADD to Cart</button>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12" style="padding:0;">
                                
                                <?php $session = session(); if($session->role=='customer'): ?>
                                <button type="button" id="addToWishlistButton" class="btn btn-primary" style="background-color: black; color:white;">ADD to Wishlist</button>
                                <?php else: ?>
                                    <a type="button" id="addToWishlistButton" href="<?php echo site_url('my-account'); ?>" class="btn btn-primary" style="background-color: black; color:white;">ADD to Wishlist</a>
                                <?php endif;  ?>
                                <script>
                                $("button#addToWishlistButton").click(function (e) { 
                                    // 
                                });
                                </script>

                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12"></div>

                            
                        
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
    $("button#add-qty").click(function (e) { 
        e.preventDefault();
        let productQuantity = $("input#product-quantity").val();
        $("input#product-quantity").val(parseInt(productQuantity)+parseInt(1));
    });

    $("button#reduce-qty").click(function (e) { 
        e.preventDefault();
        let productQuantity = $("input#product-quantity").val();
        if(parseInt(productQuantity)!=1){
            $("input#product-quantity").val(parseInt(productQuantity)-parseInt(1));
        }
    });
    $("button#addToCartButton").click(function (e) { 
        e.preventDefault();
        let productMaterial = $("select#product-material").val();
        let productSize = $("select#product-size").val();
        let productQuantity = $("input#product-quantity").val();
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
                    location.reload();
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