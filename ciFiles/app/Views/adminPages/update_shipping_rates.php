<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h1 class="page-title"><?php echo $title; ?></h1>


        <div class="items-container">
        
        
            <form action="<?php echo site_url('update-shipping-rates'); ?>" method="post">
            
                <div class="form-group">

                    <label for="india_shipping">Shipping Rate (India)</label>
                    <input value="<?php echo $shipping_rates['india']; ?>" class="form-control" type="text" name="india_shipping" id="india_shipping">
                
                </div>
                <div class="form-group">

                    <label for="row_shipping">Shipping Rate (ROW)</label>
                    <input value="<?php echo $shipping_rates['row']; ?>" class="form-control" type="text" name="row_shipping" id="row_shipping">

                </div>
                <div class="form-group">

                    <label for="free_shipping_threshold">Free Shipping Threshold</label>
                    <input value="<?php echo $shipping_rates['free_shipping_threshold']; ?>" class="form-control" type="text" name="free_shipping_threshold" id="free_shipping_threshold">

                </div>
            
                <button type="submit" class="btn btn-success">Update</button>

            </form>


        </div>

    </div>
</main>