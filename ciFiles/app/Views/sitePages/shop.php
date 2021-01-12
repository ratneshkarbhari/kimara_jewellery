
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
                
                </div>
            
            </div>
            <div class="col-lg-9 col-md-12 col-sm-12">

                <div class="container-fluid" style="padding: 0;">
                        
                    <!-- <h1 class="section-title text-center" id="filtered-title">ALL Products</h1> -->
        
                            
                    <div id="productsBox" class="row" >
        
                        <?php echo $products_grid_cache; ?>
        
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
</script>