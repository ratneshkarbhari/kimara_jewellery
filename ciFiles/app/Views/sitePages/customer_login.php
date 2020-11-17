<main class="page-content" id="customer-login" style="padding-top: 10vh !important;">

    <div class="container">

        <div class="row">
        
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-4 col-md-12 col-sm-12">
            
                <h2 class="text-center"><?php echo $title; ?></h2>
                <p class="text-center text-danger"><?php echo $error; ?></p>



                <form action="<?php echo site_url('customer-login-exe'); ?>" method="post">
                
                
                    <div class="form-group">
                    
                        <label for="customer-email">Email</label>
                        <input style="border: 1px solid black;" class="form-control" type="email" name="customer-email" id="customer-email">

                    </div>
                    <div class="form-group">
                    
                        <label for="customer-password">Password</label><small style="position: absolute; right: 5%;"><a class="text-danger" href="<?php echo 
                         site_url('forgot-password'); ?>">Forgot Password ?</a></small>
                        <input style="border: 1px solid black;" class="form-control" type="password" name="customer-password" id="customer-password">

                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="showPwdCustomerLogin">
                        <label class="form-check-label" for="showPwdCustomerLogin">
                            Show Password
                        </label>
                    </div><br>


                    <button type="submit" class="btn btn-success">LOGIN</button>



                    <div class="text-center" style="margin-top: 15%;">
                    
                        <p>Dont have an Account? <a style="color: red;" href="<?php echo site_url('customer-registration'); ?>">Register Here</a></p>
                    
                    </div>
                
                
                </form>
            
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        
        </div>    
    
    </div>

</main>