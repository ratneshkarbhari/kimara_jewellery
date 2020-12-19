<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h3 class="page-title"><?php echo $title; ?></h3>

        <p class="text-danger"><?php echo $error; ?></p>
    
        <p class="text-success"><?php echo $success; ?></p>

        <form action="<?php echo site_url('update-vendor-data'); ?>" enctype="multipart/form-data" method="post">
        
            <input type="hidden" name="vendor_id" value="<?php echo $vendor_data['id']; ?>">

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input value="<?php echo $vendor_data['first_name']; ?>" class="form-control" type="text" name="first_name" id="first_name">
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input value="<?php echo $vendor_data['last_name']; ?>" class="form-control" type="text" name="last_name" id="last_name">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input value="<?php echo $vendor_data['email']; ?>" class="form-control" type="email" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="mobile_number">Mobile Number</label>
                <input value="<?php echo $vendor_data['mobile_number']; ?>" class="form-control" type="text" name="mobile_number" id="mobile_number">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

    </div>
</main>