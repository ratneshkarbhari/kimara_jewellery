<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">

    <div class="container">

        <a class="text-light btn btn-primary" style="float: right;" href="#"  data-toggle="modal" data-target="#resetPwdModal">Reset Password</a>

        <div class="modal fade" id="resetPwdModal" tabindex="-1" aria-labelledby="resetPwdModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                    
                        <form action="<?php echo site_url('update-vendor-password') ?>" method="post">
                        
                            <input type="hidden" name="vendor_id" value="<?php echo $_SESSION['id']; ?>">

                            <div class="form-group">

                                <label for="current_pwd">Current Password</label>
                                <input class="form-control" type="password" name="current_pwd" id="current_pwd">
                            
                            </div>
                            <div class="form-group">

                                <label for="new_pwd">New Password</label>
                                <input class="form-control" type="password" name="new_pwd" id="new_pwd">
                            
                            </div>

                            <div class="form-group">

                                <label for="repeat_new_pwd">Repeat New Password</label>
                                <input class="form-control" type="password" name="repeat_new_pwd" id="repeat_new_pwd">

                            </div>

                            <button type="submit" class="btn btn-primary">Change Password</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>

        <h3 class="page-title"><?php echo $title; ?></h3>
        <p class="text-success"><?php echo $success; ?></p>
        <p class="text-danger"><?php echo $error; ?></p>


        <form action="<?php echo site_url('update-vendor-profile'); ?>" method="post">

            <input type="hidden" name="vendor_id" value="<?php echo $_SESSION['id']; ?>">

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input value="<?php echo $_SESSION['first_name']; ?>" class="form-control" type="text" name="first_name" id="first_name">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input value="<?php echo $_SESSION['last_name']; ?>" class="form-control" type="text" name="last_name" id="last_name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input value="<?php echo $_SESSION["email"]; ?>" class="form-control" type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input value="<?php echo $_SESSION["mobile_number"]; ?>" class="form-control" type="text" name="mobile_number" id="mobile_number">
            </div>

            <button type="submit" class="btn btn-success">Update Account</button>
        
        </form>
        
    </div>

</main>