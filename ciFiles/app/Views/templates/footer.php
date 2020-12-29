

    <nav id="mobileBottomNav" class="container" style="padding: 0.5rem 0.7rem; width: 100%; margin: auto;" >
        
        <a href="<?php echo site_url(''); ?>" class="nav-linkx w-20 d-inline-block text-center "><img src="<?php echo site_url('assets/icons/home.svg'); ?>" width="15px" height="15px"><br><small>Home</small></a>
        <a class="nav-linkx w-20 d-inline-block text-center" href="<?php echo site_url('my-account'); ?>"><img src="<?php echo site_url('assets/icons/heart.svg'); ?>" width="15px" height="15px"><br><small>Wishlist</small></a>
        <a class="nav-linkx w-20 d-inline-block text-center" href="<?php if($cart_item_count>0){
                        echo site_url('cart');
                    }else {
                        echo '#';
                    }  ?>"><span class="cart-count-circle" style="
    position: absolute;
    top: 4%;
    width: 22px;
    height: 22px;
    line-height: 22px;    
    font-size: 15px;
    background-color: black;
    padding-left: 0%;
    right: 33%;
    font-size: 12px;
    color: white;
    font-weight: bolder;
    padding-left: 2%;
    padding-right: 2%;
    padding-bottom: 3%;
    "><?php echo $cart_item_count; ?></span><img src="<?php echo site_url('assets/icons/shopping-bag.svg'); ?>"  width="15px" height="15px"><br><small>Cart</small></a>
        <a class="nav-linkx w-20 d-inline-block text-center" href="<?php echo site_url('my-account'); ?>"><img src="<?php echo site_url('assets/icons/user.svg'); ?>"  width="15px" height="15px"><br><small>Account</small></a>
    </nav>


    <footer id="site-footer" class="text-light">
    
        <div class="container">

        <div class="row" style="padding: 3% 0;">
                
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
                    <div class="ysera-custommenu default">
                        <h2 class="widgettitle">Quick Menu</h2>
                        <ul class="menu">
                            <li class="menu-item">
                                <a href="<?php echo site_url('shop'); ?>">Shop</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo site_url('customer-login'); ?>">Login</a>
                            </li>
                            <?php $count = 0; foreach($categories as $category): if($category['parent']==0): if ($count<6): ?>
                            <li class="menu-item">
                                <a href="<?php echo site_url('category/'.$category['slug']); ?>"><?php echo $category['title']; ?></a>
                            </li>
                            <?php endif; endif; $count++; endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center hidden-xs">
                    <div class="ysera-newsletter style1">
                        <div class="newsletter-head">
                            <h3 class="title">Newsletter</h3>
                        </div>
                        <div class="newsletter-form-wrap">
                            <div class="list">
                                Sign up for fresh info about our offers and products
                            </div>
                            <p id="nl-sub-error" class="text-light"></p>
                            <input type="email" id="nlSubEmail" class="input-text email email-newsletter form-control" placeholder="Your email letter">
                            <br>
                            <button class="btn btn-submit submit-newsletter btn-primary" type="button" id="nlSubButton">SUBSCRIBE</button>
                            <br><br>

                            <script>
                                $("button#nlSubButton").click(function (e) { 
                                    e.preventDefault();
                                    let nlSubEmail =  $("input#nlSubEmail").val();
                                    if(nlSubEmail==''){
                                        $("p#nl-sub-error").html('Please enter your Email to get latest products and offers in your inbox');
                                    }else{
                                        $.ajax({
                                            type: "POST",
                                            url: "<?php echo site_url('add-email-subscriber'); ?>",
                                            data: {
                                                'nlSubEmail' :  nlSubEmail
                                            },
                                            success: function (response) {
                                                if(response=='invalid-email'){

                                                    $("p#nl-sub-error").html('Please Provide a Valid Email');

                                                }else if(response=='nl-add-success'){
                                                    window.location.href = "<?php echo site_url('nl-sub-thank-you') ?>";
                                                }
                                            }
                                        });
                                    }
                                    
                                });
                            </script>

                        </div>
                    </div>
                </div>
                <div class="box-footer col-xs-12 col-sm-4 col-md-4 col-lg-4 text-center">
                    <div class="ysera-custommenu default">
                        <h2 class="widgettitle">Information</h2>
                        <ul class="menu">
                            <li class="menu-item">
                                <a href="<?php echo site_url('vendor-login'); ?>">Vendor Login</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo site_url('terms-and-conditions'); ?>">Terms and Conditions</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo site_url('privacy-policy'); ?>">Privacy Policy</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo site_url('faqs'); ?>">FAQs</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo site_url('about'); ?>">About</a>
                            </li>
                            <li class="menu-item">
                                <a href="<?php echo site_url('contact'); ?>">Contact Us</a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
            </div>

            <style>
                .menu-item a,h2.widgettitle,h3.title{
                    color: white !important;
                }
                ul.menu{
                    list-style: none;
                    padding-left: 0;
                }
            </style>
        
            <p class="text-center text-light" style="margin: 3% 0;">&copy; Kimaara 2020 | All Rights Reserved</p>
        
        </div>
    
    </footer>

    <script src="<?php echo site_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="<?php echo site_url('assets/js/app.min.js?v=1.3'); ?>"></script>

</body>
</html>