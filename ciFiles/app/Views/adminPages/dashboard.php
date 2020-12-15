
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">

    <div class="container">


    <h3 class="page-title"><?php echo $title; ?></h3>
    
        <div class="row text-center" style="margin: 3% 0;">
        
            <div class="col-lg-6 col-md-6 col-sm-12">
            
                <a href="<?php echo site_url('manage-categories'); ?>">
                    <div class="card custom-card-dashboard">
                    
                        Categories
                    
                    </div>
                </a>
            
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <a href="<?php echo site_url('manage-products'); ?>">
                    <div class="card custom-card-dashboard">
                    
                        Products
                    
                    </div>
                </a>
            
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12">
            
                <a href="<?php echo site_url('manage-orders'); ?>">
                    <div class="card custom-card-dashboard">
                    
                        Orders
                    
                    </div>
                </a>
            
            </div>
        
        </div>
    
    </div>

</main>