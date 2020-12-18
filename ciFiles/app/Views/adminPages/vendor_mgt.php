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
                        <td><?php echo $vendor_request_data['contact_number']; ?></td>
                        <td></td>
                        <td></td>
                        <td></td>
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

</main>