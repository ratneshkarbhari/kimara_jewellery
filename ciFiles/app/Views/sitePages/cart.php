<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<main class="page-content" id="cart" style="padding: 5% 0;">
    <?php if(count($cart_items)>0): ?>
    <section id="cart">
        <div class="container-fluid text-center">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product Title</th>
                            <th scope="col">Material</th>
                            <th scope="col">Size</th>
                            <th scope="col">Price (₹)</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total (₹)</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $subtotal = 0.00; ?>
                        <?php  foreach($cart_items as $cart_item): foreach($products as $product): if($cart_item['product_id']==$product['id']): ?>
                        <tr>
                            <td><?php echo $product['title']; ?></td>
                            <td><?php echo ucfirst($cart_item['material']); ?></td>
                            <td><?php echo ucfirst($cart_item['size']); ?></td>
                            <td><?php echo $product['sale_price']; ?></td>
                            <td>
                                <form method="post" action="<?php echo site_url('update-cart'); ?>" style="display: inline;">
                                <input type="hidden" name="cart-item-id" value='<?php echo $cart_item['id']; ?>'>
                                <input type="number" name="product-qty" style="width: 55px; text-align: center;" value="<?php echo $cart_item['quantity']; ?>" min="1" id="product-qty-<?php echo $cart_item['id']; ?>">
                            </td>
                            <td><?php if($cart_item['product_id']==$product['id']){
                                echo $amount =$product['sale_price']*$cart_item['quantity'];
                                $subtotal=$subtotal+$amount; 
                            } ?></td>
                            <td>
                                <button style="margin-bottom: 5%;" type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form action="<?php echo site_url('delete-cart-item'); ?>" method="post" style="display: inline;">
                                <input type="hidden" name="cart-item-id" value="<?php echo $cart_item['id']; ?>">
                                <button style="margin-bottom: 3%;" type="submit" class="btn btn-danger">DELETE</button>
                            </form>
                            </td>
                        </tr>
                        <?php endif; endforeach; endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="row" style="margin-top: 5%; text-align: center;">
            
                <div class="col-lg-4 col-md-12 col-sm-12"></div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                
                    <h3>Payable Total: <?php  echo '₹ '.$subtotal; ?></h3>

                    <br><br>

                    <?php         
                    $session = session();

                    $role = $session->get('role'); if($role!='customer'): ?>

                    <button class="btn btn-success btn-block" data-toggle="modal" data-target="#loginModal"  type="button" id="openLoginPopup">
                    
                        Login to Proceed
                    
                    </button>

                    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content text-left">
                            
                                <div class="modal-body">

                                    <!-- <img style="width: 100%;" src="<?php echo site_url('assets/images/newestlogo.png'); ?>" id="logonew"> -->

                                    <h4 class="text-center">Customer Login</h4>

                                    <p id="loginErrorText" class="text-danger text-center"></p>
                                    
                                    <div class="form-group">
                                    
                                        <label for="customer-email">Email</label>
                                        <input style="border: 1px solid black;" class="form-control" type="email" name="customer-email" id="customer-email">

                                    </div>
                                    <div class="form-group">
                                    
                                        <label for="customer-password">Password</label>
                                        <input style="border: 1px solid black;" class="form-control" type="password" name="customer-password" id="customer-password">

                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="showPwdCustomerLogin">
                                        <label class="form-check-label" for="showPwdCustomerLogin">
                                            Show Password
                                        </label>
                                    </div><br>

                                   



                                    <button type="button" id="ajaxCustomerLoginButton" class="btn btn-success">LOGIN</button>


                                    <div class="text-center" style="margin-top: 10%;">
                                        
                                        <p>Dont have an Account? <a style="color: red;" href="<?php echo site_url('customer-registration'); ?>">Register Here</a></p>
                                    
                                    </div>

                                </div>
                            
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                        <div class="container-fluid text-left">
                            <p id="orderPlacingError" class="text-danger text-center"></p>
                            <div class="form-group">
                                <label for="contactNumber">Contact Number</label>
                                <input class="form-control" style='border: 1px solid;' type="text" name="orderContactNumber" id="contactNumber">
                            </div>
                            <div class="form-group">
                                <label for="shippingAddress">Shipping Address</label>
                                <textarea style='border: 1px solid;' id="shippingAddress" name="shippingAddress" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="billingAddress">Billing Address</label>
                                <textarea style='border: 1px solid;' id="billingAddress" name="billingAddress" class="form-control"></textarea>
                            </div>
                            <button class="btn btn-success btn-block" data-toggle="modal" data-target="#loginModal"  type="button" id="makePayment">
                            Make Payment
                            </button>
                        </div>
                    <?php endif; ?>
                
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12"></div>
            
            </div>
        </div>
    </section>
    <?php else: ?>
    <section id="empty-cart">
        <div class="container">
            <h4>Your Cart is empty, head to the <a href="<?php echo site_url('shop'); ?>">Shop</a> and Add things here.</h4>
        </div>
    </section>
    <?php endif; ?>
</main>
<script>
// CustomerLogin Ajax
$("button#ajaxCustomerLoginButton").click(function (e) { 
    e.preventDefault();
    let customerEmail = $("input#customer-email").val();
    let customerPassword = $("input#customer-password").val();
    if (customerEmail==''||customerPassword=='') {
        $("p#loginErrorText").html('Please enter both email and Password');
    } else {
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('customer-login-api'); ?>",
            data: {
                'customer-email' : customerEmail,
                'customer-password' : customerPassword,
            },
            success: function (response) {
                if(response=='login-success'){
                    location.reload();
                }else{
                    setTimeout(function() {
                        $("p#loginErrorText").html('The Email or Password entered is incorrect');
                    }, 3000);
                }
            }
        });
    }
});
<?php if(isset($_SESSION['role'])&&$_SESSION['role']=='customer'&&isset($orderData['amount'])): ?>
// Make PaymentAjax
$("button#makePayment").click(function (e) { 
    e.preventDefault();
    let orderContactNumber = $("input#contactNumber").val();
    let shippingAddress = $("textarea#shippingAddress").val();
    let billingAddress = $("textarea#billingAddress").val();
    if(orderContactNumber==''||shippingAddress==''||billingAddress==''){
        $("p#orderPlacingError").html('Please enter both Contact Number, Shipping and Billing Address');
    }else{
        localStorage.setItem('orderContactNumber', orderContactNumber);
        localStorage.setItem('shippingAddress', shippingAddress);
        localStorage.setItem('billingAddress', billingAddress);
        var options = {
        "key": "rzp_test_looXFeOiWI0vw6", // Enter the Key ID generated from the Dashboard
        "amount": '<?php echo $orderData['amount']; ?>', 
        "currency": "INR",
        "name": "Kimara Jewellery",
        "description": 'Payment on Kimara Jewellery',
        "image": "<?php echo site_url('assets/images/newestlogo.png'); ?>",
        // "order_id": "<?php echo $orderData['id']; ?>", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
        "handler": function (response){
            console.log(response);
            $.ajax({
                type: "POST",
                url: '<?php echo site_url('create-order'); ?>',
                data: {
                    'payee_customer_email' : '<?php echo $_SESSION['email']; ?>',
                    'payee_customer_name' : '<?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?>',
                    'amount' : '<?php echo ($orderData['amount']/100); ?>',
                    'contact_number' : localStorage.getItem('orderContactNumber'),
                    'shipping_address' : localStorage.getItem('shippingAddress'),
                    'billing_address' : localStorage.getItem('billingAddress'),
                },
                success: function (response) {
                    if (response=='success') {
                        window.location.href = "<?php echo site_url('thank-you'); ?>";
                    }
                }
            });        
        },
        "prefill": {
            "name": "<?php echo $_SESSION['first_name']; ?>",
            "email": "<?php echo $_SESSION['email']; ?>",
            "contact": $("input#contactNumber").val()
        },
        "theme": {
            "color": "#000000"
        }
    };
    var rzp1 = new Razorpay(options);
    rzp1.open();
    e.preventDefault();

    }
});
<?php endif; ?>
</script>