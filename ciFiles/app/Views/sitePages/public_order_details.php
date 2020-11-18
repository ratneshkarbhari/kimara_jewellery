<main class="page-content" id="order-details">

    <div class="container">
    
        <div class="row">
        
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
            <div class="col-lg-4 col-md-12 col-sm-12">
            
                <div class="card">
                
                    <div class="card-body">
                    
                        <h4>Order Details</h4>
                        <p>Name: <?php echo $orderData['customer_name']; ?></p>
                        <p>Mobile Number: <?php echo $orderData['contact_number']; ?></p>
                        <p>Email: <?php echo $orderData['customer_email']; ?></p>
                        <p>Date: <?php echo $orderData['date']; ?></p>
                        <p>Shipping Address:</p>
                        <p><?php echo $orderData['shipping_address']; ?></p>
                        <p>Billing Address:</p>
                        <p><?php echo $orderData['billing_address']; ?></p>

                        <h4>Items Ordered:</h4>

                        <?php $productQtyObj = json_decode($orderData['products_qty_json'],TRUE);  ?>

                        <?php foreach($productQtyObj as $ordered_item): foreach($ordered_products as $ordered_product): if($ordered_item['product_id']==$ordered_product['id']): ?>
                            <h6><?php echo $ordered_product['title']; ?></h6>
                            <h6>SKU: <?php echo $ordered_product['sku']; ?></h6>
                            <p style="margin-bottom: 1%;">Material : <?php  echo ucfirst($ordered_item['material']); ?></p>
                            <p style="margin-bottom: 1%;">Size : <?php  echo ucfirst($ordered_item['size']); ?></p>
                            <p style="margin-bottom: 1%;">Quantity : <?php  echo ucfirst($ordered_item['quantity']); ?></p>
                        <?php endif; endforeach; endforeach; ?>

                    </div>
                
                </div>
            
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        
        </div>
    
    </div>

</main>