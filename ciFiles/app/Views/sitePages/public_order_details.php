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

                        <h4>Items Ordered:</h4>
                        <?php $products_qty_obj = json_decode($orderData['products_qty_json'],TRUE);

                        foreach($products_qty_obj as $ordered_item):
                        
                            foreach($ordered_products as $orderedPro):

                            if($ordered_item['product_id']==$orderedPro['id']):

                        ?>

                            <h5><?php echo $orderedPro['title']; ?></h5>

                            <h5>Material : <?php echo ucfirst($ordered_item['material']); ?></h5>
                            <h5>Material : <?php echo ucfirst($orderedPro['titlesize']); ?></h5>

                            <?php endif; endforeach; endforeach; ?>
                    </div>
                
                </div>
            
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12"></div>
        
        </div>
    
    </div>

</main>