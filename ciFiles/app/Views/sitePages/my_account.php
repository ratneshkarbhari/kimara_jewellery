<main class="page-content" id="my-account" style="padding: 5% 0 10% 0;">
    <div class="container">
        <h3 class="page-title" style="margin-bottom: 5%;">My Account</h3>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12" style="padding: 3%; margin-bottom: 5%; box-shadow: 0px 0px 20px lightgray;">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Edit Profile</a>
                <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders" aria-selected="false">Orders</a>
                <!-- <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Address</a> -->
                <!-- <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a> -->
                <a class="nav-link" id="logoutLink" href="<?php echo site_url('logout'); ?>">Logout</a>
                <style>
                    a#logoutLink{
                        background-color: red;
                        color: white !important;
                    }
                </style>
                </div>
            </div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <form action="<?php echo site_url('update-customer-profile'); ?>" method="post">
                        <input type="hidden" name="cust_id" value="<?php echo $userdata['id']; ?>">
                        <div class="container-fluid" style="padding: 0;">
                            <div class="row">
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="first_name">First Name</label>
                                        <input class="form-control" type="text" name="first_name" id="first_name" value='<?php echo $_SESSION['first_name']; ?>'>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="last_name">Last Name</label>
                                        <input class="form-control" type="text"  name="last_name" value='<?php echo $_SESSION['last_name']; ?>' id="last_name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input class="form-control" type="email" name="email" value='<?php echo $_SESSION['email']; ?>' id="email" readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input class="form-control" type="text" name="mobile_number" value="<?php if(isset($_SESSION['mobile_number'])){
                                            echo $_SESSION['mobile_number'];
                                        } ?>" id="mobile_number">
                                    </div>
                                </div>
                                
                                <div class="form-group col-lg-12 col-sm-12 col-md-12">
                                    <button class="btn btn-block text-light" type="submit" style="background-color: darkgreen;">Update Profile</button>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                    

                    <h4>Click on Order to see details:</h4>
    


                        <div class="table-responsive">
                        
                            <table class="table">
                                <thead>
                                    <tr>
                                    
                                        <td>Order ID</td>
                                        <td>Date Placed</td>
                                        <td>Status</td>
                                        <td>View More</td>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($orders)>0): foreach($orders as $order): $productQtyObj = json_decode($order['products_qty_json'],TRUE);   ?>

                                    <tr>
                                        <td><?php echo $order['public_order_id']; ?></td>
                                        <td><?php echo $order['date']; ?></td>
                                        <td><?php echo $order['status']; ?></td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#orderDetail-<?php echo $order['public_order_id']; ?>" style="color: #c09578;">View More</a>
                                            <div class="modal fade" id="orderDetail-<?php echo $order['public_order_id']; ?>">
                                            
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Order Id: <?php echo $order['public_order_id']; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <h5>Date: <?php echo $order['date']; ?></h5>
                                                            <h5>Status: <?php echo $order['status']; ?></h5>

                                                            <h4>Items:</h4>
                                                            <?php foreach($productQtyObj as $productQtyItem): foreach($products as $product): if($product['id']==$productQtyItem['product_id']): ?>
                                                                <h6><?php echo $product['title']; ?></h6>
                                                                <p>Quantity: <?php echo $productQtyItem['quantity']; ?></p>
                                                                <?php if($productQtyItem['size']!='default'){
                                                                    echo $productQtyItem['size'].',';
                                                                } ?><?php if($productQtyItem['material']!='default'){
                                                                    echo $productQtyItem['material'];
                                                                } ?>
                                                            <?php endif; endforeach; endforeach; ?>
                                                        </div>
                                                        <!-- <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                        </div> -->
                                                    </div>
                                                </div>

                                            
                                            </div>
                                        </td>
                                    </tr>    

                                    <?php endforeach; else: ?>

                                    <h4>Your have no past Orders <a style="color: #c09578 !important;" href="<?php echo site_url('shop'); ?>">go back to the shop</a> and get a lil something for you.</h4>

                                    <?php endif; ?>
                                
                                </tbody>

                            </table>

                        </div>



                        <!-- <a style="color: #c09578 !important;" href="<?php echo site_url('order-details/'.$order['public_order_id']); ?>"><h4><?php echo $order['public_order_id']; ?></h4></a> -->

    
                    
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                <!-- <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                </div> -->
            </div>
        </div>
    </div>
</main>
<style>
a.nav-link.active{
    color: #ffffff !important;
}
</style>