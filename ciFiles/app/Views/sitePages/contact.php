<div class="login-section section " style="margin-bottom: 3%;">
    <div class="container">
        <div id="top-header-my-account row card" style="padding: 5% 0; background-color: white;margin: 5% 0;">
            <h1 style="background-color: white !important; color: black !important;" class="text-center"><?php echo $title; ?></h1>
        </div>
        <div class="login-section section container" style="margin-bottom: 3%;">
            <style>
                input,textarea{
                    border: 1px solid black !important;
                }
            </style>
            <div class="row">
            
                <div class="col-lg-6 col-md-12 col-sm-12">

                <div class="  text-left" style="margin: 5% 0;">
                        <h2><span class="color-blue" style="color: red;">SEND</span> A MESSAGE</h2>
                    </div>
                
                    <form action="<?php echo site_url('contact-form-exe'); ?>" method="post">
                    
                        <p class="text-success"><?php echo $success; ?></p>

                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <input class="form-control" type="text" name="full_name" id="full_name" required>
                        </div>
                    
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email" required>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" name="message" id="message"></textarea>
                        </div>

                        <button type="submit" class="btn" style="background-color: red; color: white;">Send</button>

                    </form>

                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">

                <div class="  text-left" style="margin: 5% 0;">
                        <h2><span class="color-blue" style="color: red;">CONTACT</span> DETAILS</h2>
                    </div>


                    <h2 class="text-dark">Email:</h2>
                    <p class="text-dark" style="font-size: 150%;">hello@kimaara.com</p>
                    <h2 class="text-dark">Location:</h2>
                    <p class="text-dark" style="font-size: 150%;">Mumbai, India</p>

                </div>
            
            </div>
        </div>
    </div>
    </div>
<style>
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        background-color: red;
    }
</style>