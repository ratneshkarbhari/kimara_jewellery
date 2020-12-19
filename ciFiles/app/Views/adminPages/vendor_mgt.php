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
                        
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        

        <h4>Vendors Awaiting Approval</h4>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td style="font-size: 1.2rem; font-weight: 500;">Full Name</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Email</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Contact Number</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Adhaar Link</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Pan Link</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Actions</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vendor_requests as $v_req): $vendor_request_data = json_decode($v_req['vendor_data'],TRUE); ?>
                    <tr>
                        <td><?php echo $vendor_request_data['first_name'].' '.$vendor_request_data['last_name']; ?></td>
                        <td><?php echo $vendor_request_data['email']; ?></td>
                        <td><?php echo $vendor_request_data['mobile_number']; ?></td>
                        <td><a style="color: purple;" target="_blank" href="<?php echo  site_url('assets/vendor_docs/'.$v_req['adhaar_image']) ?>">Open</a></td>
                        <td><a style="color: purple;" target="_blank" href="<?php echo  site_url('assets/vendor_docs/'.$v_req['pan_image']) ?>">Open</a></td>
                        <td>
                            <form action="<?php echo site_url('approve-vendor-exe'); ?>" method="post">
                                <input type="hidden" name="vendor_request_id" value="<?php echo $v_req['id']; ?>">
                                <button type="submit" class="btn btn-success">Approve</button>
                            </form>
                            <form action="<?php echo site_url('reject-vendor-exe'); ?>" method="post">
                                <input type="hidden" name="vendor_request_id" value="<?php echo $v_req['id']; ?>">
                                <button type="submit" class="btn btn-danger">Reject</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>

</main>