<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">

    <div class="container">
    
        <h2 class="page-title"><?php echo $title; ?></h2>

        <form class="row" action="<?php echo site_url("update-products-exe"); ?>" enctype="multipart/form-data" method="post">

            <button type="submit" style="position: fixed; bottom: 5%; right: 2.5%; z-index: 500;" class="btn btn-success">Save</button>
            <input type="hidden" name="store_id" value="<?php echo $store["id"]; ?>">
            <?php foreach($products as $product): ?>
            <div class="col-lg-3 col-md-12 col-sm-12">
                
                <div class="card" style="margin-bottom: 5%;">
                    <label for="<?php echo $product["slug"]; ?>">
                    <img src="<?php echo site_url("assets/images/featured_image_product/".$product["featured_image"]); ?>" style="width:100%;"></label>
                    <h4><?php echo $product["title"]; ?></h4>
                    <input type="checkbox" name="selected_products[]" id="<?php echo $product["slug"]; ?>" value="<?php echo $product["id"]; ?>" <?php if(is_array($store_product_ids)): if(in_array($product["id"],$store_product_ids)){echo 'checked';} endif; ?>>
                </div>
            
            </div>
            <?php endforeach; ?>
        </form>
    </div>

</main>