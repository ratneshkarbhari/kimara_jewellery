<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<main class="page-content" id="cart" style="padding: 5% 0;">
    <?php if(count($cart_items)>0): ?>
    <section id="cart" >
        <div class="container-fluid text-center">
            <div class="table-responsive d-none d-lg-block">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product Title</th>
                            <!-- <th scope="col">Material</th>
                            <th scope="col">Size</th> -->
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
                            <td><?php echo $product['title']; ?>
                            <?php if($cart_item['material']!='default'){echo $cart_item['material'].',';} ?><?php if($cart_item['size']!='default'){echo $cart_item['size'];} ?>
                            </td>

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
            <div class="cart-items-container d-sm-block d-md-block d-lg-none">
                <?php $subtotal = 0.00; ?>
                <?php  foreach($cart_items as $cart_item): foreach($products as $product): if($cart_item['product_id']==$product['id']): ?>
                <div class="card text-center" style="padding-bottom: 5%; margin-bottom: 5%;">
                    <form action="<?php echo site_url('delete-cart-item'); ?>" method="post" style="display: inline;">
                        <input type="hidden" name="cart-item-id" value="<?php echo $cart_item['id']; ?>">
                        <button style="margin-bottom: 3%;" type="submit" class="btn"><img src="<?php echo site_url('assets/icons/trash.svg'); ?>" width="30px" height="30px"></button>
                    </form>
                    <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="w-50" style="margin: 5% auto;">
                    <h6 class="product-title"><?php echo $product['title']; ?>...</h6>
                    <p class="options"><?php if($cart_item['material']!='default'){echo ucfirst($cart_item['material'].',');}  ?><?php if($cart_item['size']!='default'){echo ucfirst($cart_item['size'].',');}  ?></p>
                    <div class="text-center">
                    <form method="post" action="<?php echo site_url('update-cart'); ?>" style="display: inline; margin: 5% 0;">
                    <button class="btn" id="reduce-qty" type="button" style="border-radius: 0 !important; border: 1px solid gray; color: black; padding: 0.5% 2%; margin: 0 2%; width: 50px; height: 50px; font-size: 20px;">-</button><input type="number" name="product-qty" id="product-quantity" style="width: 50px; font-size: 15px; height: 49px; text-align: center;" value="<?php echo $cart_item['quantity']; ?>" min="1" readonly><button class="btn" id="add-qty" type="button" style="border-radius: 0 !important; border: 1px solid gray; color: black; padding: 0.5% 2%; width: 50px; height: 50px; font-size: 20px; margin: 0 2%;">+</button>
                    <input type="hidden" name="cart-item-id" value='<?php echo $cart_item['id']; ?>'>

                    <h5 class="text-center" style="margin: 5% 0;">₹ <?php echo $itemPrice = $cart_item['quantity']*$product['sale_price']; ?></h5>

                    <button style="margin-bottom: 5%; width: 50%; margin:0 auto;" type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div></div>
                <?php $subtotal= $subtotal+$itemPrice; endif; endforeach; endforeach; ?>
            </div>
            
        </div>
        <div class="container">
        
        </div>
    </section>
    <section id="checkout-login">
        <div class="container">
        <div class="row" style="margin-top: 5%; text-align: center;">
            
                <div class="col-lg-4 col-md-12 col-sm-12"></div>
                <div class="col-lg-4 col-md-12 col-sm-12">
                
                    <h5>Use a Coupon code:</h5>
                    
                    <p class='text-danger' id="couponErrorCode"></p>
                    <input class="form-control" type="text" value="<?php if (isset($_COOKIE['coupon'])) {
                        echo $_COOKIE['coupon'];
                    } ?>" id="couponCodeField">
                    <br>
                    <?php if(isset($_COOKIE['coupon'])): $subtotal = $subtotal-($subtotal*($percentage_discount/100)) ?>
                    <button type="button" class="btn btn-danger btn-block" id="removeCoupon">Remove</button>
                    <script>
                    $("button#removeCoupon").click(function (e) { 
                        e.preventDefault();
                            $.ajax({
                                type: "POST",
                                url: "<?php echo site_url('unset-coupon-cookie'); ?>",
                                
                                success: function (response) {
                                    window.location.reload();
                                }
                            });
                        });
                    </script>
                    <br>
                    <?php else: ?>
                    <button type="button" class="btn btn-success btn-block" id="applyCoupon">Apply</button>
                    <script>
                        $("button#applyCoupon").click(function (e) { 
                            e.preventDefault();
                            let couPonCode = $("input#couponCodeField").val();
                            if (couPonCode=='') {
                                $("p#couponErrorCode").html('Please enter a Coupon code')
                            }else{
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url('set-coupon-cookie'); ?>",
                                    data: {
                                        'code' : couPonCode
                                        'vendor' : $store_data["vendor"]
                                    },
                                    success: function (response) {
                                        window.location.reload();
                                    }
                                });
                            }
                        });
                    </script>
                    <br>
                    <?php endif; ?>
                    <br>
                    
                    <h5>Subtotal: <?php  echo '₹ '.$subtotal; ?></h5>
                    <?php if($subtotal<10000): ?>
                    <label for="location">You are browsing from:</label>
                    <select name="location" id="location" class="form-control">
                        <option value="india" <?php if($_COOKIE['location']=='india'){echo 'selected';} ?>>India</option>
                        <option value="row" <?php if($_COOKIE['location']=='row'){echo 'selected';} ?>>Rest of World</option>
                    </select>
                    <br>
                    <script>
                        $("select#location").change(function (e) { 
                            e.preventDefault();
                            let location = $(this).val();
                            $.ajax({
                                type: "POST",
                                url: '<?php echo site_url('set-location-cookie'); ?>',
                                data: {
                                    'location' : location
                                },
                                success: function (response) {
                                    
                                    window.location.reload();
                                    
                                }
                            });
                        });
                    </script>
                    <h5>Shipping: <?php  echo '₹ '.$shipping = $shipping_rates[$_COOKIE['location']]; ?></h5>
                    <?php else: ?>
                        <h5>Shipping: <?php  echo '₹ '.$shipping = 0.00; ?></h5>
                    <?php endif; ?>
                    <h3>Payable: <?php  echo '₹ '.$payable = $shipping+$subtotal; ?></h3>

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
                        
     
<!-- 
                        <div class="form-group">
                            <label for="contactNumber">Contact Number*</label>
                            <input class="form-control" style='border: 1px solid;' type="text" name="orderContactNumber" id="contactNumber" required>
                        </div>
                        <div class="form-group">
                            <label for="shippingAddress">Shipping Address*</label>
                            <textarea style='border: 1px solid;' id="shippingAddress" name="shippingAddress" class="form-control"></textarea required>
                        </div>
                        <div class="form-group">
                            <label for="billingAddress">Billing Address*</label>
                            <textarea style='border: 1px solid;' id="billingAddress" name="billingAddress" class="form-control"></textarea required>
                        </div>
                        <button class="btn btn-success btn-block" type="button" id="ccod">
                        Place Order
                        </button> -->
                        
                        <script>
                        
                            $("button#ccod").click(function (e) { 
                                e.preventDefault();

                                let orderContactNumber = $("input#contactNumber").val();
                                let shippingAddress = $("textarea#shippingAddress").val();
                                let billingAddress = $("textarea#billingAddress").val();
                                if(orderContactNumber==''||shippingAddress==''||billingAddress==''){
                                    
                                    $("p#orderPlacingError").html('Please enter both Contact Number, Shipping and Billing Address');
                                
                                }else{

                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo site_url('create-cod-order'); ?>",
                                        data: {
                                            'payee_customer_email' : '<?php echo $_SESSION['email']; ?>',
                                            'payee_customer_name' : '<?php echo $_SESSION['first_name'].' '.$_SESSION['last_name']; ?>',
                                            'amount' : '<?php echo ($orderData['amount']/100); ?>',
                                            'contact_number' : localStorage.getItem('orderContactNumber'),
                                            'shipping_address' : localStorage.getItem('shippingAddress'),
                                            'billing_address' : localStorage.getItem('billingAddress'),
                                            'store' : '<?php echo $store_data["code"]; ?>',                                            
                                        },
                                        success: function (response) {
                                            if(response=='success'){
                                                window.location.href = "<?php echo site_url('thank-you'); ?>";
                                            }
                                        }
                                    });    

                                }

                            });

                        </script>
                       
                    <?php endif; ?>
                
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12"></div>
            
            </div>
        </div>
    </section>
</main>
<script>
    $("button#add-qty").click(function (e) { 
        e.preventDefault();
        let productQuantity = $("input#product-quantity").val();
        $("input#product-quantity").val(parseInt(productQuantity)+parseInt(1));
    });

    $("button#reduce-qty").click(function (e) { 
        e.preventDefault();
        let productQuantity = $("input#product-quantity").val();
        if(parseInt(productQuantity)!=1){
            $("input#product-quantity").val(parseInt(productQuantity)-parseInt(1));
        }
    });
</script>
<script>
// Count add delte
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
        // "key": "rzp_live_u5KGjme6VZlvYo", // Enter the Key ID generated from the Dashboard
        "key": "rzp_test_tt5wGNQQXooze8", // Enter the Key ID generated from the Dashboard
        "amount": '<?php echo $orderData['amount']; ?>', 
        "currency": "INR",
        "name": "Kimaara Jewellery",
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
                    'store' : '<?php echo $store_data["code"]; ?>'
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
<?php endif; endif; ?>
</script>