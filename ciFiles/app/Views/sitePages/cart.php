<main class="page-content" id="cart" style="padding: 5% 0;">
    <section id="cart">
        <div class="container-fluid">
            
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
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5>Subtotal: </h5></td>
                        <td><?php echo '₹ '.$subtotal; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5>Tax: </h5></td>
                        <td><?php echo '₹ '.$taxTotal = $subtotal*0.03; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><h5>GRAND TOTAL: </h5></td>
                        <td><h4><?php echo '₹ '.$grandTotal = $subtotal+$taxTotal; ?></h4></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>