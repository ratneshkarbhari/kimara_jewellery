<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h3 class="page-title"><?php echo $title; ?></h3>

        <br>
        <br>
        <h4>Approved Vendors</h4>

        <form class="d-inline" action="<?php echo site_url('vendor-search'); ?>" method="post">
            <div class="form-group">
                <input type="search" style="border: 1px solid black;" name="query" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Search</button>
        </form>
        <br><br>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td style="font-size: 1.2rem; font-weight: 500;">Full Name</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Email</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Contact Number</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($approved_vendors as $av): ?>
                    <tr>
                        <td><?php echo $av['first_name'].' '.$av['first_name']; ?></td>
                        <td><?php echo $av['email']; ?></td>
                        <td><?php echo $av['mobile_number']; ?></td>
                        <td>
                            <a href="<?php echo site_url('edit-vendor-details/'.$av['id']); ?>" class="btn btn-primary">Edit</a>
                            
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        

       
    </div>

</main>