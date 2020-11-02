<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> | Kimara Jewellery</title>
    <link rel="stylesheet" href="<?php echo site_url('assets/css/normalize.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />
    <link rel="stylesheet" href="<?php echo site_url('assets/css/app.min.css'); ?>">
</head>
<body>
<script src="<?php echo site_url('assets/js/jquery.min.js'); ?>"></script>
    <header id="desktop">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
            
                <a class="navbar-brand" href="<?php echo site_url(''); ?>"><img src="<?php echo site_url('assets/images/logo.png'); ?>" id="siteLogo"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url(); ?>">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('shop'); ?>">SHOP</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('about'); ?>">ABOUT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo site_url('contact'); ?>">CONTACT</a>
                        </li>
                        
                    </ul>
                </div>

            </div>
            
        </nav>    
    </header>