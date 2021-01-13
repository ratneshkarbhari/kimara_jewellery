
<main class="page-content" id="shop">

    <div class="container-fluid">
    
        <div class="row" style="margin: 5% 0;">
        
            <div class="col-lg-3 col-md-12 col-sm-12">
            
                <!-- <h4 class="section-titlex">Filter Products</h4> -->
                <div id="filterBox" style="
    position: absolute;
    left: 5%;
    top: 0%;
">

                    <h5>by price</h5>

                    <div class="form-group">
                        <label for="max_price">Max Price:  <span id="max-price-display"></span></label><br>
                        <input style="width: 120%;" filter-type="max_price" type="range" name="max_price" min="0" max="30000" class="price-slider filter-trigger" id="max_price" filter-type="max_price" name="max_price" class="from-control">
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
                
                </div>
            
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">

                <div class="container-fluid" style="padding: 0;">
                        
                    <!-- <h1 class="section-title text-center" id="filtered-title">ALL Products</h1> -->
        
                            
                    <div id="productsBox" class="row" style="min-height: 300px;">
        
                        <?php foreach($products as $product):  ?>
                    
                        <div class="col-lg-3 col-md-6-sm-12 text-center custom-half-grid" style="margin-bottom: 5%; padding: 5px;">
                        
                            <a href="<?php echo site_url('product/'.$product['slug']); ?>">
                                <div class="card">
                                
                                    <img src="<?php echo site_url('assets/images/placeholder.png'); ?>" data-src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="card-img-top lazy ">
                                
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
$(".price-slider").change(function (e) { 
    e.preventDefault();
    console.log($(this).val());
    $("span#max-price-display").html('₹ '+$(this).val());
});
$("input.filter-trigger").change(function (e) { 
    e.preventDefault();
    $("div#productsBox").html('Fetching Products for filter');
    let max_price = $("input#max_price").val();
    var selected_categories = [];
    $("input.filter-category:checked").each(function(i){
        selected_categories[i] = $(this).val();
        });
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('filter-endpoint'); ?>",
        data: {
            'max_price' : max_price,
            'selected_categories' : selected_categories
        },
        success: function (response) {
            $("div#productsBox").html(response);
        }
    });
});

let offset = 12;
$(window).scroll(function(){
    if ($(window).scrollTop() == ($(document).height()) - ($(window).height())){
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('load-twelve-more-products') ?>",
            data: {
                'offset' : offset
            },
            success: function (response) {
                $("div#productsBox").append(response);
            }
        });
    }
});
</script>