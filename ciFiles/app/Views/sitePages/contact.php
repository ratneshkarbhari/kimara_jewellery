<div class="login-section section" style="margin-bottom: 3%;">
    <div class="container">
        
        <div class="login-section section container" style="margin-bottom: 3%;">
            <style>
                input,textarea{
                    border: 1px solid black !important;
                }
            </style>
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="text-left" style="margin: 5% 0;">
                        <h2>CONTACT DETAILS</h2>
                        <p>Ask Us. We will help you. Your questions and feedbacks are always welcome at kimaara.com.</p>
                    </div>


                    <h4 class="text-dark">9022906690</h4>
                    <p>Call or whatsapp. Join in a conversation with one of our Jewelry Consultants to help you make the right decision. Communicate the way you prefer. Our service hours are from 8AM to 10PM on all days.</p>
                    <h4>Email</h4>
                    <p class="text-dark">kimaarasilver@gmail.com</p>
                    <p>Do you have any queries or questions? Send us an e-mail and we will reply to you as soon as possible</p>
                    <h4 class="text-dark">Location:</h4>
                    <p class="text-dark" style="font-size: 150%;">Mumbai, India</p>

                </div>
            
                <div class="col-lg-12 col-md-12 col-sm-12">

                    <div class="text-left" style="margin: 5% 0;">
                        <h2>SEND A MESSAGE</h2>
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

                        <button type="submit" class="btn btn-primary">Send</button>

                    </form>

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