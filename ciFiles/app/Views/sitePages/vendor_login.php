<main class="page-container" id="vendor-login" >

    <div class="container">

        <div class="row" style="padding-top: 10%;">
        
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-4 col-md-12 col-sm-12">
            

                <h1 class="text-center"><?php echo $title; ?></h1>
                <p class="text-danger text-center"><?php echo $error; ?></p>        


                <form action="<?php echo site_url('vendor-login-exe'); ?>" method="post">
                
                    <div class="form-group">
                    
                        <label for="vendor-email">Email</label>
                        <input class="form-control" type="email" name="vendor-email" id="vendor-email">
                    
                    </div>
                    <div class="form-group">
                    
                        <label for="vendor-password">Password</label>
                        <input class="form-control" type="password" name="vendor-password" id="vendor-password">
                    
                    </div>

                    <button type="submit" style="margin: 3% 0;" class="btn btn-success">Login</button>
                
                </form>

                <br>

                <div class="text-center" style="margin-top: 15%;">
                    
                    <p>Dont have a Vendor Account? <a style="color: red;" href="<?php echo site_url('vendor-registration'); ?>">Register Here</a></p>
                
                </div>
            
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>


        </div>
    
    </div>

</main>

<style>

header,footer{
    display: none;
}

</style>