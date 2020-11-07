

    <nav id="mobileBottomNav" class="container" style="padding: 0.5rem 0.7rem; width: 100%; margin: auto;" >
        
        <a href="<?php echo site_url(''); ?>" class="nav-linkx w-20 d-inline-block text-center "><img src="<?php echo site_url('assets/icons/home.svg'); ?>" width="15px" height="15px"><br><small>Home</small></a>
        <a class="nav-linkx w-20 d-inline-block text-center" href="<?php echo site_url('my-account'); ?>"><img src="<?php echo site_url('assets/icons/heart.svg'); ?>" width="15px" height="15px"><br><small>Wishlist</small></a>
        <a class="nav-linkx w-20 d-inline-block text-center" href="<?php echo site_url('cart'); ?>"><span class="cart-count-circle" style="
    position: absolute;
    top: 4%;
    background-color: black;
    padding-left: 0%;
    right: 33%;
    font-size: 12px;
    color: white;
    font-weight: bolder;
    padding: 1%;
    padding-left: 2%;
    padding-right: 2%;
    padding-bottom: 2%;
    "><?php echo $cart_item_count; ?></span><img src="<?php echo site_url('assets/icons/shopping-bag.svg'); ?>"  width="15px" height="15px"><br><small>Cart</small></a>
        <a class="nav-linkx w-20 d-inline-block text-center" href="<?php echo site_url('my-account'); ?>"><img src="<?php echo site_url('assets/icons/user.svg'); ?>"  width="15px" height="15px"><br><small>Account</small></a>
    </nav>


    <footer id="site-footer">
    
        <div class="container">
        
            <p class="text-center text-light" style="margin-bottom: 0;">&copy; Kimara Jewellery 2020 | All Rights Reserved</p>
        
        </div>
    
    </footer>

    <script src="<?php echo site_url('assets/js/jquery.min.js'); ?>"></script>
    <script src="<?php echo site_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous"></script>
    <script src="<?php echo site_url('assets/js/app.min.js'); ?>"></script>

</body>
</html>