<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | Kimara Jewellery</title>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/normalize.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/owl.carousel.min.css'); ?>" >
    <link rel="stylesheet" href="<?php echo site_url('assets/css/owl.theme.default.min.css'); ?>" >
    <link rel="stylesheet" href="<?php echo site_url('assets/css/app.min.css'); ?>">
</head>
<body>
<script src="<?php echo site_url('assets/js/jquery.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/js/feather.min.js'); ?>"></script>
    <header id="desktop" class="sticky-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <a class="navbar-brand" href="<?php echo site_url(''); ?>"><img src="<?php echo site_url('assets/images/newestlogo.png'); ?>" id="siteLogo"></a>
                </div>
                <div class="col-lg-7">
                    <form action="" class="d-inline" method="post">
                        <div class="form-group">
                        <input style="margin-top: 2%; border: 1px solid black;" placeholder="Find what you love" type="search" name="universal-search" id="universal-search" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="col-lg-2">
                    
                    <nav id="top-right-nav" class="ml-auto">
                    <a class="nav-link d-inline" href="<?php echo site_url('customer-login'); ?>"><img src="<?php echo site_url('assets/icons/user.svg'); ?>" width="30px" height="30px"></a>
                    <a class="nav-link d-inline" href="<?php echo site_url('cart'); ?>"><img src="<?php echo site_url('assets/icons/shopping-bag.svg'); ?>" width="30px" height="30px"></a>
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
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <?php foreach($categories as $category): if($category['parent']==0):  ?>

                                    <a class="dropdown-item" href="<?php echo site_url('category/'.$category['slug']); ?>"><?php echo $category['title']; ?></a>

                                    <?php endif; endforeach; ?>

                                    </div>
                                </li>
                            
                            </ul>
                            
                        </div>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('shop'); ?>">Shop</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('about'); ?>">About</a>
                                </li>         
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo site_url('contact'); ?>">Contact</a>
                                </li>                         
                            </ul>
                            
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <header id="site-header-mobile" style="background-color: white; position: fixed; z-index: 9;" class="d-lg-block d-xl-none d-md-block d-sm-block" class="sticky-top">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="mobilenav" style="padding: 0.5rem 0.7rem; border-bottom: 1px solid; box-shadow: 0px 0px 20px darkgray;">

            <a href="#" id="sideNavOpenLink" class="nav-link"><img src="<?php echo site_url('assets/icons/menu.svg'); ?>" width="15px" height="15px"></a>

                
            <a class="navbar-brandx mr-auto" style="margin-left: 3%; width: 50%;" href="<?php echo site_url(''); ?>"><img style="width: 100%;" src="<?php echo site_url('assets/images/newestlogo.png'); ?>" id="logonew"></a>
            
            <a class="nav-link" id="toggleSearchBar"  data-toggle="modal" data-target="#searchModal" href="#"><img src="<?php echo site_url('assets/icons/search.svg'); ?>" width="15px" height="15px"></a>
            <div id="searchModal"  class="modal fade" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Find What you Love</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <div class="modal-body">
                        <form action="<?php echo site_url('universal-product-search'); ?>" class="d-inline" method="post">
                                        
                            <div class="form-group">
                                <label for="universalSearchField">Find What you Love</label>
                                <input class="form-control" style="border: 1px solid;" placeholder="Search for Products you desire" type="search" name="universal_search_query" id="universalSearchField">                            
                            </div>
                    
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <a class="nav-link" href="<?php echo site_url('cart'); ?>"><img src="<?php echo site_url('assets/icons/shopping-bag.svg'); ?>" width="15px" height="15px"></a>
        </nav>
        <div id="sidenavMobileCloser"></div>
       <div id="sidenavMobile">
           <div id="sidenavLogoBox" style="text-align: center;">
           <img src="http://localhost/kimara_jewellery/assets/images/newestlogo.png" id="logonew" style="width: 70%; margin: 10% auto;">
           </div>
           <?php foreach($categories as $category): if($category['parent']==0):  ?>

            <a href="<?php echo site_url('category/'.$category['slug']); ?>" class="sidenav-link"><?php echo $category['title']; ?></a>

           <?php endif; endforeach; ?>

            <div id="other-links-menu" style="position: absolute; bottom:0; left: 0; right: 0;">
                <a href="<?php echo site_url('shop'); ?>" class="sidenav-link">Shop</a>
                <a href="<?php echo site_url('about'); ?>" class="sidenav-link">About</a>
                <a href="<?php echo site_url('contact'); ?>" class="sidenav-link">Contact</a>
            </div>

       </div>
       
    </header>