<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">

    <div class="container">
    
        <h3 class="page-title"><?php echo $title; ?></h3>
        <p class="text-success"><?php echo $success; ?></p>
        <p class="text-danger"><?php echo $error; ?></p>

        <form action="<?php echo site_url("create-store"); ?>" enctype="multipart/form-data" method="post">

            <input type="hidden" name="vendor_id" value="<?php echo $_SESSION['id']; ?>">

            <div class="form-group">
            
                <label for="name">Name</label>
                <input required class="form-control" type="text" name="name" id="name">

            </div>
            <div class="form-group">
            
                <label for="code">Code</label>
                <input required class="form-control" type="text" name="code" id="code">

            </div>

            <div class="form-group">
            
                <label for="logo">Logo</label>
                <input class="form-control" type="file" accept="images/*" name="logo" id="logo">

            </div>

            <button type="submit" class="btn btn-success">Save</button>
        
        </form>        

    </div>

</main>