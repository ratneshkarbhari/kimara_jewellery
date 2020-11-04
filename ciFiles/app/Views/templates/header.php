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
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
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
                    <a class="nav-link d-inline" href="<?php echo site_url('customer-login'); ?>"><img src="<?php echo site_url('assets/icons/shopping-bag.svg'); ?>" width="30px" height="30px"></a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="border: none; padding: 0;">
                        
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto ml-auto">
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
                            <ul class="navbar-nav mr-auto ml-auto">
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
    <header id="site-header-mobile" style="background-color: white;" class="d-lg-block d-xl-none d-md-block d-sm-block" class="sticky-top">
        
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="mobilenav" style="padding: 0.5rem 0.7rem;">

            <a href="#" id="sideNavOpenLink" class="nav-link"><img src="<?php echo site_url('assets/icons/menu.svg'); ?>" width="15px" height="15px"></a>

                
            <a class="navbar-brandx mr-auto" style="margin-left: 3%; width: 50%;" href="<?php echo site_url(''); ?>"><img style="width: 100%;" src="<?php echo site_url('assets/images/logonew.png'); ?>" id="logonew"></a>
            
            <a class="nav-link" href="#"><img src="<?php echo site_url('assets/icons/search.svg'); ?>" width="15px" height="15px"></a>
            <a class="nav-link" href="<?php echo site_url('cart'); ?>"><img src="<?php echo site_url('assets/icons/shopping-bag.svg'); ?>" width="15px" height="15px"></a>
        </nav>
        <div id="sidenavMobileCloser"></div>
       <div id="sidenavMobile">
          <a href="" class="sidenav-link"></a>
       </div>
       
    </header>