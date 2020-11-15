<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo site_url('assets/drift/drift-basic.min.css'); ?>">
<script src="<?php echo site_url('assets/drift/Drift.min.js'); ?>"></script>
<main class="page-content" id="product-page">


    <section id="product-details-section" style="padding: 2% 0;">
    
        <div class="container">
        
            <div class="row">

                <div class="col-lg-6 col-md-12 col-sm-12" style="margin-bottom: 5%;">
                
                
                    <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" data-zoom="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" id="product-page-main-product-image" style="width: 100%; border: 1px solid darkgray; cursor: pointer;">
                    <p></p>

                    <script>
                    new Drift(document.querySelector("img#product-page-main-product-image"), {
                    paneContainer: document.querySelector("p")
                    });
                    </script>

                    <div id="product-gallery-box" class="owl-carousel" margin-top: 2%;>
                        <?php $gallery_images = explode(',',$product['gallery_images']); foreach($gallery_images as $gallery_image): ?>

                            <img style="cursor: pointer;" srcset="<?php echo site_url('assets/images/gallery_images_product/'.$gallery_image); ?>" class="product-gallery-image" src="<?php echo site_url('assets/images/gallery_images_product/'.$gallery_image); ?>">

                        <?php endforeach; ?>
                    </div>
                    
                    <script>
                    $(".product-gallery-image").click(function (e) { 
                        e.preventDefault();
                        $("img#product-page-main-product-image").attr('src',$(this).attr('srcset'));
                        $("img#product-page-main-product-image").attr('data-zoom',$(this).attr('srcset'));
                    });
                    </script>
                
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                
                    <h1 class="product-title" style='font-size: 26px;text-transform:capitalize;'><?php echo $product['title']; ?></h1>

                    <?php if($product['sale_price']!=0.00): ?>
                        <span class="larger-price-card"> ₹ <?php echo $product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span></del>
                    <?php else: ?>
                        <span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span>
                    <?php endif; ?>

                    <div class="container-fluid">
                    
                        <div class="row" style='margin-top: 5%;'>
                        
                            <?php if($product['materials']!=''): ?>

                            <div  class="col-lg-4 col-md-6 col-sm12 form-group" style="padding-left: 0;">
                            
                                <label for="product-material">Material:</label>

                                <select class="form-control" id="product-material">
                                    <?php $materials = explode(',',$product['materials']); foreach($materials as $material): ?>
                                    <option value="<?php echo $material; ?>"><?php echo ucfirst($material); ?></option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <?php else: ?>
                                <input type="hidden" value="default" id="product-material">
                            <?php endif; ?>
                            <?php if($product['sizes']!=''): ?>
                            <div class="col-lg-4 col-md-6 col-sm12 form-group" style="padding-left: 0;">
                            
                                <label for="product-size">Size:</label>

                                <select class="form-control" id="product-size">
                                    <?php $sizes = explode(',',$product['sizes']); foreach($sizes as $size): ?>
                                    <option value="<?php echo $size; ?>"><?php echo ucfirst($size); ?></option>
                                    <?php endforeach; ?>

                                </select>

                            </div>
                            <?php else: ?>
                            <input type="hidden" name="product-size" value="default">
                            <?php endif; ?>

                            <div class="col-lg-4 col-md-6 col-sm-6 custom-half-grid" style="padding:0; margin-bottom: 3%;">
                                
                                <?php $session = session(); if($session->role=='customer'): ?>
                                    <p id="atw-success" style="margin-bottom: 0;" class="col-lg-12 col-md-12 col-sm-12 text-success" style="color: darkgreen !important;"></p>
                                <p id="atw-failure" class="col-lg-12 col-md-12 col-sm-12 text-danger"></p>
                                <a href="#" type="button" id="addToWishlistButton"style=" font-size: 16px;"> <img src="<?php echo site_url('assets/icons/heart.svg'); ?>" width="16px" height="16px"> Add to Wishlist</a>
                                <?php else: ?>
                                    <a type="button" id="addToWishlistButton" href="<?php echo site_url('my-account'); ?>" style=" font-size: 16px;"> <img src="<?php echo site_url('assets/icons/heart.svg'); ?>" width="16px" height="16px"> Add to Wishlist</a>
                                <?php endif;  ?>
                                <script>
                                $("a#addToWishlistButton").click(function (e) { 

                                    <?php if($product['sizes']==''&&$product['materials']==''): ?>
                                    let productMaterial = 'default';
                                    let productSize = 'default';
                                    <?php else: ?>
                                        let productMaterial = $("select#product-material").val();
                                    let productSize = $("select#product-size").val();
                                    <?php endif; ?>
                                    let product_id = '<?php echo $product['id']; ?>';
                                    let customer_id = '<?php echo $_SESSION['id']; ?>'
                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo site_url('add-to-wishlist-exe'); ?>",
                                        data: {
                                        product_id : product_id,
                                            customer_id : product_id,
                                            material : productMaterial,
                                            size : productSize,
                                        },
                                        success: function (response) {
                                            if(response=='add-to-wishlist-success'){
                                                $("p#atw-success").html('Added to Wishlist Successfully');
                                                setTimeout(function() {
                                                    $("p#atw-success").html('');
                                                }, 3000);
                                                location.reload();
                                            }else{
                                                $("p#atw-failure").html('Added to Cart Successfully');
                                                setTimeout(function() {
                                                    $("p#atw-failure").html('');
                                                }, 3000);
                                            }
                                        }
                                    })
                                });
                                </script>

                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-6 custom-half-grid" style="padding:0; margin-bottom: 3%;">
                            
                            <p id="atx-success" style="margin-bottom: 0;" class="col-lg-12 col-md-12 col-sm-12 text-success" style="color: darkgreen !important;"></p>
                                <p id="atx-failure" class="col-lg-12 col-md-12 col-sm-12 text-danger"></p>

                                <a href="#" data-toggle="modal" data-target="#sizeChartModal" style="font-size: 16px;"> <img src="<?php echo site_url('assets/icons/sliders.svg'); ?>" width="16px" height="16px"> See Size Chart</a>

                            </div>
                            <div class="col-lg-4 col-md-12 col-sm-12"></div>

                            <p id="atc-success" style="margin-bottom: 0;" class="col-lg-12 col-md-12 col-sm-12 text-success" style="color: darkgreen !important;"></p>
                                <p id="atc-failure" class="col-lg-12 col-md-12 col-sm-12 text-danger"></p>
                            
                            <div class="col-lg-4 col-md-6 col-sm-6 form-group custom-half-grid" style="padding-left: 0;">
                                <!-- <label for="product-quantity">Quantity:</label> -->

                                <!-- <select class="form-control" id="product-quantity">
                                    <?php for($i=1;$i<=5;$i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php endfor; ?>
                                </select> -->



                                <button class="btn" id="reduce-qty" type="button" style="border-radius: 0 !important; border: 1px solid gray; color: black; padding: 0.5% 2%; margin: 0%; width: 50px; height: 50px; font-size: 20px;">-</button><input type="number" id="product-quantity" style="width: 50px; font-size: 15px; height: 50px; text-align: center;" value="1" min="1" readonly><button class="btn" id="add-qty" type="button" style="border-radius: 0 !important; border: 1px solid gray; color: black; padding: 0.5% 2%; width: 50px; height: 50px; font-size: 20px; margin: 0%;">+</button>

                            </div>
                            

                            <div class="col-lg-4 col-md-6 col-sm-6 custom-half-grid" style="padding:0;">
                                
                                        
                                <button type="button" id="addToCartButton" class="btn btn-primary" style="background-color: black; color:white; margin-bottom: 3%;">Add to Cart</button>
                            </div>


                            <div class="col-lg-4 col-md-12 col-sm-12"></div>

                            <div class="col-lg-12 col-md-12 col-sm-12 text-left" style="margin-top: 5%; padding-left: 0;">
                                <a style="font-size: 22px;" href="https://api.whatsapp.com/send?phone=919022906690&text=<?php echo urlencode('I am interested in '.site_url('product/'.$product['slug'])); ?>">Connect with <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/1200px-WhatsApp.svg.png" width="50px" height="50px"></a>
                            </div>
                            <div id="description-box" class="col-lg-12 col-md-12 col-sm-12" style="margin-top: 10%;">
                                <p class="product-description text-left"><?php echo $product['description']; ?></p>
                            </div>

                        
                        </div>

                    
                    </div>



                    
                
                </div>
            
            
            </div>
        
        </div>
    
    </section>
    <section id="related-products-section">
        <div class="container">
            <h1 class="text-center section-title">Related Products</h1>
            <div class="owl-carousel owl-theme" id="related-products">
                <?php foreach($related_products as $related_product): if($related_product['id']!=$product['id']): ?>
                    <a href="<?php echo site_url('product/'.$related_product['slug']); ?>"><div class="card text-center"> <img src="<?php echo site_url('assets/images/featured_image_product/'.$related_product['featured_image']); ?>" class="card-img-top"><div class="card-body">                            
                    <h6 class="related_product-title"><?php if(strlen($related_product['title'])>9){
                    echo substr($related_product['title'],0,9).'...';
                    }else {
                    echo $related_product['title'];
                    } ?></h6><span class="larger-price-card"> ₹ <?php echo $related_product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $related_product['price']; ?></span></del> <br><br><button class="btn btn-primary">BUY NOW</button></div></div> </a>
                <?php endif; endforeach; ?>
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
        <?php if($product['sizes']==''&&$product['materials']==''): ?>
        let productMaterial = 'default';
        let productSize = 'default';
        <?php else: ?>
            let productMaterial = $("select#product-material").val();
        let productSize = $("select#product-size").val();
        <?php endif; ?>
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