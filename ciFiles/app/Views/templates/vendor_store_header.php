<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | Kimara Jewellery</title>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/normalize.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/app.min.css?v=2.2'); ?>">
    <link rel="icon" href="<?php echo site_url('favicon.png'); ?>" type="image/png"/>
</head>
<body>
<script src="<?php echo site_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/feather.min.js'); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/vanilla-lazyload@17.3.0/dist/lazyload.min.js"></script>
    <header id="desktop" class="sticky-top">
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-5HJTYVW80C"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-5HJTYVW80C');
</script>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <a class="navbar-brand" href="<?php echo site_url('store?store_code='.$store_data["code"]); ?>"><img style="width: 70% !important;" src="<?php echo site_url('assets/store_logos/'.$store_data["logo"]); ?>" id="siteLogoVendor"></a>
                </div>
                <div class="col-lg-7">
                    <form action="<?php echo site_url('vendor-store-product-search'); ?>" class="d-inline" method="post">
                    
                        <input name="store_code"  type="hidden" value="<?php echo $store_data["code"]; ?>">
                        <div class="form-group">
                        <input style="margin-top: 2%; border: 1px solid black;" placeholder="Find what you love" type="search" name="universal-search" id="universal-search" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="col-lg-2">
                    
                    <nav id="top-right-nav" class="ml-auto">
                    <a class="nav-link d-inline" href="<?php echo site_url('customer-login'); ?>"><img src="<?php echo site_url('assets/icons/user.svg'); ?>" width="30px" height="30px"></a>
                    <a class="nav-link d-inline" href="<?php if($cart_item_count>0){
                        echo site_url('cart?store_code='.$store_data["code"]);
                    }else {
                        echo '#';
                    }  ?>"><img src="<?php echo site_url('assets/icons/shopping-bag.svg'); ?>" width="30px" height="30px"><span class="cart-count-circle" style="position: absolute; top: 3%; width: 22px; height: 22px; line-height: 22px;     font-size: 15px; background-color: black; right: 25%; color: white; font-weight: bolder; padding-left: 4%;"><?php echo $cart_item_count; ?></span></a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border: none; padding: 0;">
                        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Categories
                                    </a>
                                    <div class="dropdown-menu" style="width: 250px;" aria-labelledby="navbarDropdown">
                                    <?php foreach($categories as $category): if($category['parent']==0):  ?>

                                    <a class="dropdown-item" href="<?php echo site_url('category/'.$category['slug'].'?store_code='.$store_data["code"]); ?>"><?php echo $category['title']; ?></a>

                                    <?php endif; endforeach; ?>

                                    </div>
                                </li>
                            
                            </ul>
                            
                        </div>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('store?store_code='.$store_data["code"]); ?>">Shop</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('about'); ?>">About</a>
                                </li>         
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('contact'); ?>">Contact</a>
                                </li>                          -->
                            </ul>
                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- <header id="site-header-mobile" style="background-color: white; z-index: 9;" class="" > -->
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top d-lg-block d-xl-none d-md-block d-sm-block" id="mobilenav" style="padding: 0.5rem 0.7rem; border-bottom: 1px solid; box-shadow: 0px 0px 20px darkgray;">

            <a href="#" id="sideNavOpenLink" class="nav-link"><img src="<?php echo site_url('assets/icons/menu.svg'); ?>" width="15px" height="15px"></a>

                
            <a class="navbar-brandx mr-auto ml-auto" style="margin-left: 3%; width: 60%; text-align: center;" href="<?php echo site_url('store?store_code='.$store_data["code"]); ?>"><img style="width: 100%;" src="<?php echo site_url('assets/store_logos/'.$store_data["logo"]); ?>" id="logonew"></a>
            
            <a class="nav-link" id="toggleSearchBar" href="#"><img src="<?php echo site_url('assets/icons/search.svg'); ?>" width="15px" height="15px"></a>
            <div id="searchBox" class="container" style="padding: 5%;">
                <form action="<?php echo site_url('universal-product-search') ?>" method="post">
                                    
                    <div class="form-group container">
                        <label for="universalSearchField">Find What you Love</label>
                        <input class="form-control" style="border: 1px solid; width: 100%;" placeholder="Search for Products you desire" type="search" name="universal-search" id="universalSearchField">                            
                    </div>

                </form>
            </div>
            <div id="searchBarBackdrop">
            
            </div>
            <style>
            div#searchBox{
                background-color: white;
                z-index: 3000;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                width: 100%;
                display: none;
            }
            div#searchBarBackdrop{
                background-color: black;
                opacity: 0.5;
                z-index: 2999;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom:0;
                width: 100%;
                display: none;
            }
            </style>
            <script>
            $("a#toggleSearchBar").click(function (e) { 
                e.preventDefault();
                $("div#searchBox").css('display','block');
                $("div#searchBarBackdrop").css('display','block');
            });
            $("div#searchBarBackdrop").click(function (e) { 
                e.preventDefault();
                $("div#searchBox").css('display','none');
                $(this).css('display','none');
            });
            </script>
            <!-- <a class="nav-link" href="<?php echo site_url('cart'); ?>"><img src="<?php echo site_url('assets/icons/shopping-bag.svg'); ?>" width="15px" height="15px"></a> -->
        </nav>
        <div id="sidenavMobileCloser"></div>
       <div id="sidenavMobile" style="overflow: auto;
    max-height: 500vh;
    height: 100vh;">
           <div id="sidenavLogoBox" style="text-align: center;">
           <img src="<?php echo site_url('assets/store_logos/'.$store_data["logo"]); ?>" id="logonew" style="width: 70%; margin: 10% auto;">
           </div>
           <div id="sidenavCatBox" >
           <?php  foreach($categories as $category): if($category['parent']==0):   ?>

                <a href="<?php echo site_url('category/'.$category['slug']).'?store='.$store_data["code"]; ?>" class="sidenav-link"><?php echo $category['title']; ?></a>

           <?php endif; endforeach; ?>
           </div>

            <div id="other-links-menu" style="position: absolute; margin-top: 20%; left: 0; right: 0;">
                <a href="<?php echo site_url('store/'.$store_data["code"]); ?>" class="sidenav-link">Home</a>
                <a href="<?php echo site_url('about'); ?>" class="sidenav-link">About</a>
                <a href="<?php echo site_url('contact'); ?>" class="sidenav-link">Contact</a>
            </div>

       </div>
       
    <!-- </header> -->