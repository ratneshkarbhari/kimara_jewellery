<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h1>Coupons</h1>
        <p class="text-danger"><?php echo $error; ?></p>
        <p class="text-success"><?php echo $success; ?></p>
    
        <a style="margin-bottom: 5%;" href="<?php echo site_url('add-coupon'); ?>" class="btn btn-success">+ Add Coupon</a>

        
        <?php if(count($coupons)>0): ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td style="font-size: 1.2rem; font-weight: 500;">Code</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Discount %</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Status</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($coupons as $coupon): ?>
                        <tr>
                            <td><?php echo $coupon['code']; ?></td>
                            <td><?php echo $coupon['percentage_discount']; ?></td>
                            <td><?php echo $coupon['status']; ?></td>
                            <td>
                                <a href="<?php echo site_url('edit-coupon/'.$coupon['code']); ?>" class="btn btn-success">Edit</a>
                                <form action="<?php echo site_url('delete-coupon'); ?>" method="post" class="d-inline">
                                    <input type="hidden" name="id" value="<?php echo $coupon['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <h6>No Coupons Added</h6>

        <?php endif; ?>



    </div>
</main>