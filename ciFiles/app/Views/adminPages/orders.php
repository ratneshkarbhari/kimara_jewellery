<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h1 class="page-title"><?php echo $title; ?></h1>


        <div class="items-container">
        
        
        <?php if(count($orders)>0): ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td style="font-size: 1.2rem; font-weight: 500;">Public Order ID</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Customer Name</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Email</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Store</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Status</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order): ?>
                        <tr>
                            <td><?php echo $order['public_order_id']; ?></td>
                            <td><?php echo $order['customer_name']; ?></td>
                            <td><?php echo $order['customer_email']; ?></td>
                            <td><?php echo $order['store']; ?></td>
                            <td><?php echo $order['status']; ?></td>
                            <td>
                                <a class="btn btn-primary" data-toggle="modal" data-target="#orderDetailsModal-<?php echo $order['public_order_id']; ?>">See Details</a>
                                <div class="modal fade" id="orderDetailsModal-<?php echo $order['public_order_id']; ?>" tabindex="-1" aria-labelledby="orderDetailsModal--<?php echo $order['public_order_id']; ?>Label" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <h4>Order Details</h4>
                                                <p>Name: <?php echo $order['customer_name']; ?></p>
                                                <p>Mobile Number: <?php echo $order['contact_number']; ?></p>
                                                <p>Email: <?php echo $order['customer_email']; ?></p>
                                                <p>Date: <?php echo $order['date']; ?></p>
                                                <p>Complete Order Details:  <a href="<?php echo site_url('order-details/'.$order['public_order_id']); ?>" target="_blank">Click here</a></p>
                                                <p>Shipping Address:</p>
                                                <p><?php echo $order['shipping_address']; ?></p>
                                                <p>Billing Address:</p>
                                                <p><?php echo $order['billing_address']; ?></p>
                                                <form action="<?php echo site_url('update-order'); ?>" method="post">
                                                    <input type="hidden" name="order_id" value="<?php echo $order['public_order_id']; ?>">
                                                    <div class="form-group">
                                                        <label for="orderStatus-<?php echo $order['id']; ?>">Status</label>
                                                        <select style="border: 1px solid;" name="orderStatus" id="orderStatus-<?php echo $order['id']; ?>" class="form-control">
                                                            <option value="placed" <?php if($order['status']=='placed'){echo 'placed';} ?>>Placed</option>
                                                            <option value="under_process" <?php if($order['status']=='under_process'){echo 'under_process';} ?>>Under Process</option>
                                                            <option value="shipped" <?php if($order['status']=='shipped'){echo 'shipped';} ?>>Shipped</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                    
                                                        <label for="orderStatusDetails-<?php echo $order['public_order_id']; ?>">Status Details</label>
                                                        <textarea style="border: 1px solid;" name="orderStatusDetails" id="orderStatusDetails-<?php echo $order['public_order_id']; ?>" class="form-control"></textarea>

                                                    </div>

                                                    <button type="submit" class="btn btn-success">Update Status</button>
                                                
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <form action="<?php echo site_url('delete-order-exe'); ?>" style="display: inline;" method="post">
                                    <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <h6>No Categories Added</h6>

        <?php endif; ?>

        </div>

    </div>
</main>