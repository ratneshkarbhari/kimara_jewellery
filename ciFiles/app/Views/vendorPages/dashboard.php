<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">

    <div class="container">


        <h3 class="page-title"><?php echo $title; ?></h3>
        <?php if($_SESSION['approved']=='yes'): ?>
        <p>Store Link: <?php echo site_url("store?store_code=".$_SESSION["store_code"]); ?></p>

        <?php endif; ?>
    
        <?php if($_SESSION['approved']=='yes'): ?>

            <div class="row text-center" style="margin: 3% 0;">
        
                <div class="col-lg-4 col-md-6 col-sm-12">
                
                    <a href="<?php echo site_url('manage-account-vendor'); ?>">
                        <div class="card custom-card-dashboard">
                        
                            Account
                        
                        </div>
                    </a>
                
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="<?php echo site_url('manage-store-vendor'); ?>">
                        <div class="card custom-card-dashboard">
                        
                            Store
                        
                        </div>
                    </a>
                
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <a href="<?php echo site_url('manage-products-vendor'); ?>">
                        <div class="card custom-card-dashboard">
                        
                            Products
                        
                        </div>
                    </a>
                
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                
                    <a href="<?php echo site_url('manage-sales'); ?>">
                        <div class="card custom-card-dashboard">
                        
                            Sales
                        
                        </div>
                    </a>
                
                </div>
            
            </div>

        <?php elseif($_SESSION['approved']=='no'): ?>
            <h4>Your Account is not yet approved, wait for the approval process it will be completed shortly.</h4>
        <?php elseif($_SESSION['approved']=='not-submitted'): ?>
            <h4 style="margin: 3% 0;">Submit Documents for Approval</h4>
            <form action="<?php echo site_url("submit-vendor-for-approval"); ?>" enctype="multipart/form-data" method="post">
                <input type="hidden" name="vendor_user_id" value="<?php echo $_SESSION['id']; ?>">
                <div class="form-group">
                    <label for="contact_number">Contact Number</label>
                    <input type="text" name="contact_number" class="form-control" style="border: 1px solid black;" id="contact_number">
                </div>
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
        <?php elseif ($_SESSION['approved']=='rejected') : ?>
            <h4>Your Account is rejected. Connect on +919137976398 if you have any questions.</h4>
        <?php endif; ?>
    </div>

</main>