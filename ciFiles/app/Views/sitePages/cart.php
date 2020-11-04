<main class="page-content" id="cart" style="padding: 5% 0;">
    <?php if(!empty($cart_items)): ?>
    <section id="cart">
        <div class="container-fluid">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product Title</th>
                            <th scope="col">Material</th>
                            <th scope="col">Size</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
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
                            <td><?php echo '₹ '.$product['sale_price']; ?></td>
                            <td>
                                <form method="post" action="<?php echo site_url('update-cart'); ?>" style="display: inline;">
                                <input type="hidden" name="cart-item-id" value='<?php echo $cart_item['id']; ?>'>
                                <input type="number" name="product-qty" value="<?php echo $cart_item['quantity']; ?>" min="1" id="product-qty-<?php echo $cart_item['id']; ?>">
                            </td>
                            <td><?php if($cart_item['product_id']==$product['id']){
                                echo '₹ '.$amount =$product['sale_price']*$cart_item['quantity'];
                                $subtotal=$subtotal+$amount; 
                            } ?></td>
                            <td>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                            <form action="<?php echo site_url('delete-cart-item'); ?>" method="post" style="display: inline;">
                                <input type="hidden" name="cart-item-id" value="<?php echo $cart_item['id']; ?>">
                                <button type="submit" class="btn btn-danger">DELETE</button>
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

                    <button class="btn btn-success btn-block" type="button" id="openLoginPopup">
                    
                        Login to Proceed
                    
                    </button>
                
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12"></div>
            
            </div>
        </div>
    </section>
    <?php else: ?>
    <section id="empty-cart">
        <div class="container">
            <h4>Your Cart is empty, head to the <a href="<?php echo site_url('shop'); ?>">Shop</a> and Add thins here.</h4>
        </div>
    </section>
    <?php endif; ?>
</main>