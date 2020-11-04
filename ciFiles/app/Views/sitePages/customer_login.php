<main class="page-content" id="customer-login">

    <div class="container">

        <div class="row">
        
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-4 col-md-12 col-sm-12">
            
                <h2 class="text-center"><?php echo $title; ?></h2>
                <p class="text-center text-danger"><?php echo $error; ?></p>

                <div class="text-center">
                
                    <a href="<?php echo $googleLoginUrl; ?>">
                    
                        <img src="<?php echo site_url('assets/images/google-login.png'); ?>">
                    
                    </a>
                
                </div>


                <form action="<?php echo site_url('customer-login-exe'); ?>" method="post">
                
                
                    <div class="form-group">
                    
                        <label for="customer-email">Email</label>
                        <input style="border: 1px solid black;" class="form-control" type="email" name="customer-email" id="customer-email">

                    </div>
                    <div class="form-group">
                    
                        <label for="customer-password">Password</label>
                        <input style="border: 1px solid black;" class="form-control" type="password" name="customer-password" id="customer-password">

                    </div>


                    <button type="submit" class="btn btn-success">LOGIN</button>


                
                
                </form>
            
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        
        </div>    
    
    </div>

</main>