
<main class="page-content" id="shop">

<div class="container-fluid">

    <div class="row" style="margin: 5% 0;">
    
        <div class="col-lg-3 col-md-12 col-sm-12">
        
            <!-- <h4 class="section-titlex">Filter Products</h4> -->
            <div id="filterBox">
                <!-- <link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"> -->

                <h5>by price</h5>

                <div class="form-group">
                    <label for="max_price">Max Price:  <span id="max-price-display"></span></label><br>
                    <input style="width: 70%;" filter-type="max_price" type="range" name="max_price" min="0" max="30000" class="price-slider filter-trigger" id="max_price" filter-type="max_price" name="max_price" class="from-control">
                </div>


                <h5>by categories</h5>
                <?php foreach($categories as $category): ?>
                    <div class="form-check">
                        <input class="form-check-input filter-trigger filter-category" filter-type="category" type="checkbox" value="<?php echo $category['id']; ?>" id="category-<?php echo $category['id']; ?>">
                        <label class="form-check-label" for="category-<?php echo $category['id']; ?>">
                            <?php echo $category['title']; ?>
                        </label>
                    </div>
                <?php endforeach; ?>
                <br>
                <h5>by collection</h5>
                <div class="form-check" style="padding-left: 0;">
                    <input id="best-sellers" type="checkbox" class=" filter-trigger filter-collection" value="best-sellers">
                    <label for="best-sellers">Best Sellers</label>
                </div>
                <div class="form-check" style="padding-left: 0;">
                    <input id="top-rated" type="checkbox" class=" filter-trigger filter-collection" value="top-rated">
                    <label for="top-rated">Top Rated</label>
                </div>
            
            </div>
        
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12">

            <div class="container-fluid" style="padding: 0;">
                    
                <!-- <h1 class="section-title text-center" id="filtered-title">ALL Products</h1> -->
    
                        
                <div id="productsBox" class="row" >
    
                    <?php foreach($products as $product):  ?>
                
                    <div class="col-lg-3 col-md-6-sm-12 text-center custom-half-grid" style="margin-bottom: 5%; padding: 5px;">
                    
                        <a href="<?php echo site_url('product/'.$product['slug'].'?store_code='.$_COOKIE["store_code"]); ?>">
                            <div class="card">
                            
                                <img src="<?php echo site_url('assets/images/preloader.gif'); ?>" data-src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="card-img-top lazy ">
                            
                                <div class="card-body">
                                
                                <h6 class="product-title"><?php if(strlen($product['title'])>9){
                                    echo substr($product['title'],0,9).'...';
                                    }else {
                                    echo $product['title'];
                                    } ?></h6>                                        <?php if($product['sale_price']!=0.00): ?>
                                    <span class="larger-price-card"> ₹ <?php echo $product['sale_price']; ?></span> | <del><span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span></del>
                                    <?php else: ?>
                                    <span class="smaller-price-card"> ₹ <?php echo $product['price']; ?></span>
                                    <?php endif; ?>

                                    <br><br>

                                    <button class="btn btn-primary">BUY NOW</button>
    
                                </div>
    
                            </div>
                        </a>
    
                    </div>
    
                    <?php endforeach; ?>
    
                </div>
                
            </div>
        
        
        </div>
    
    </div>

</div>

</main>

<style>
.page-content{
padding-top: 0 !important;
}
</style>
<script>
$("input.filter-trigger").change(function (e) { 
    e.preventDefault();
    $("div#productsBox").html('Fetching Products for filter');
    let max_price = $("input#max_price").val();
    var selected_categories = [];
    var selected_collections = [];
    $("input.filter-category:checked").each(function(i){
        selected_categories[i] = $(this).val();
    });
    $("input.filter-collection:checked").each(function(i){
        selected_collections[i] = $(this).val();
    });
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('filter-endpoint-vendor'); ?>",
        data: {
            'max_price' : max_price,
            'selected_categories' : selected_categories,
            'selected_collections' : selected_collections,
            'prod_ids' : '<?php echo json_encode($prodIdArray); ?>'
        },
        success: function (response) {
            // console.log(response);
            $("div#productsBox").html(response);
        }
    });
});
$(".price-slider").change(function (e) { 
    e.preventDefault();
    console.log($(this).val());
    $("span#max-price-display").html('₹ '+$(this).val());
});
</script>