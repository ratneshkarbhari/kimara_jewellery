<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">

    <div class="container">


    <h3 class="page-title"><?php echo $title; ?></h3>
    
        <?php if($_SESSION['approved']=='yes'): ?>

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

        <?php elseif($_SESSION['approved']=='no'): ?>

            <h4>Your Account is not yet approved, wait for the approval process it will be completed shortly.</h4>


            


        <?php elseif($_SESSION['approved']=='not-submitted'): ?>
            <form action="<?php echo site_url("submit-vendor-for-approval"); ?>" enctype="multipart/form-data" method="post">
                <input type="hidden" name="vendor_user_id" value="<?php echo $_SESSION['id']; ?>">
                <div class="form-group">
                    <label for="adhaar_image">Adhaar Card Image</label>
                    <input type="file" name="adhaar_image" accept="image/*" id="adhaar_image">
                </div>
                <div class="form-group">
                    <label for="pan_image">Pan Card Image</label>
                    <input accept="image/*" type="file" name="pan_image" id="pan_image">
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        <?php endif; ?>
    </div>

</main>