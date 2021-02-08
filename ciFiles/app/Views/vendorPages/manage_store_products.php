<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">

    <div class="container">
    
        <h2 class="page-title"><?php echo $title; ?></h2>

        <h5>by price</h5>

                    <div class="form-group">
                        <label for="max_price_desktop">Max Price:  <span id="max-price-display"></span></label><br>
                        <input style="width: 80%; margin: 0 auto;" min="0" max="10000" value="5000" type="range" class="slider-trigger from-control price-slider filter-trigger" id="max_price_desktop">
                    </div>


                    <h5>by categories</h5>
                    <?php foreach($categories as $category): ?>
                        <div class="form-check d-inline">
                            <input class="form-check-input filter-trigger filter-category" filter-type="category" type="checkbox" value="<?php echo $category['id']; ?>" id="category-<?php echo $category['id']; ?>">
                            <label class="form-check-label" for="category-<?php echo $category['id']; ?>">
                                <?php echo $category['title']; ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
        

        <br><br>    
        <div class="row" id="productsBox">
            <div id="productsBox" class="row">
                <?php foreach($products as $product): ?>
                <div class="col-lg-3 col-md-12 col-sm-12" >
                    
                    <div class="card add-to-store <?php if(is_array($store_product_ids)): if(in_array($product["id"],$store_product_ids)){echo 'selected';} endif; ?>" style="margin-bottom: 5%; <?php if(is_array($store_product_ids)): if(in_array($product["id"],$store_product_ids)){echo 'background-color: purple; color: white;';} endif; ?>" pid="<?php echo $product["id"]; ?>" cid="<?php echo $product["category"]; ?>">
                            <label for="<?php echo $product["slug"]; ?>">
                            <img src="<?php echo site_url("assets/images/featured_image_product/".$product["featured_image"]); ?>" style="width:100%;"></label>
                        <div class="card-body">

                            <h4 id="product-title-<?php echo $product["id"]; ?>" style="<?php if(is_array($store_product_ids)): if(in_array($product["id"],$store_product_ids)){ echo 'color: white !important;';  } ?>"><?php echo $product["title"]; endif; ?></h4>
                            <br>
                            <p>SKU : <?php if (isset($product["sku"])) {
                                echo $product["sku"];
                            } ?></p>
                            <p id="selected-text-<?php echo $product["id"]; ?>"><?php if(in_array($product["id"],$store_product_ids)){
                                echo "selected";
                            } ?></p>
                            <p style="margin-bottom: 6px;">₹ <?php echo $product["sale_price"]; ?> | <del>₹ <?php echo $product["price"]; ?></del></p>
                        </div>
                    </div>
                
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="text-center">
            <button type="button" id="loadMoreProducts" class="btn btn-primary">Load More Products</button>
        </div>
    </div>

</main>
<script>
let offset = 8;
$("button#loadMoreProducts").click(function(){
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('load-twelve-more-products-vendor') ?>",
        data: {
            'offset' : offset,
            'product_ids' : '<?php echo json_encode($store_product_ids); ?>'
        },
        success: function (response) {
            $("div#productsBox").append(response);
            offset = offset+8; 
            lazyLoadInstance.update();
        }
    });
});
$(document).on("click",".add-to-store",function (e) {
    e.preventDefault();
    if(!($(this).hasClass("selected"))){
        $(this).css("background-color","purple");
        $(this).css("color","white");
        $(this).addClass("selected");
        let product_id = $(this).attr("pid");
        let category_id = $(this).attr("cid");
        $("h4#product-title-"+product_id).css("color","white");
        $("p#selected-text-"+product_id).html("selected");
        $("p#selected-text-"+product_id).css("color","white");
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("add-products-to-store-exe") ?>",
            data: {
                "product_id" : product_id,
                'category_id' : category_id,
                "store_product_ids" : '<?php echo json_encode($store_product_ids); ?>',
                'store_id' : '<?php echo $store["id"]; ?>'
            },
            success: function (response) {
                console.log("span#selected-text-"+product_id);                
            }
        });
    }else{
        $(this).css("background-color","white");
        $(this).css("color","black");
        $(this).removeClass("selected");  
        let product_id = $(this).attr("pid");
        let category_id = $(this).attr("cid");
        $("p#selected-text-"+product_id).html("");
        $("h4#product-title-"+product_id).css("color","black");
        $("p#selected-text-"+product_id).css("color","black");
        $.ajax({
            type: "POST",
            url: "<?php echo site_url("remove-products-from-store-exe") ?>",
            data: {
                "product_id" : product_id,
                "store_product_ids" : '<?php echo json_encode($store_product_ids); ?>',
                'store_id' : '<?php echo $store["id"]; ?>'
            },
            success: function (response) {
                console.log(response);
            }
        });
    }
    
});
$(".filter-trigger").on('change',function (e) { 
    e.preventDefault();
    $("button#loadMoreProducts").css("display","none");
    var preloaderImage = '<img src="<?php echo site_url("preloader.gif"); ?>">';
    $("div#productsBox").html(preloaderImage);
    let max_price = $("input#max_price_desktop").val();
    $("span#max-price-display").html('₹ '+max_price);
    let selected_categories = [];
    $("input.filter-category:checked").each(function(i){
        selected_categories[i] = $(this).val();
    });
    $.ajax({
        type: "POST",
        url: "<?php echo site_url('filter-endpoint-x'); ?>",
        data: {
            "store_product_ids" : '<?php echo json_encode($store_product_ids); ?>',
            'store_id' : '<?php echo $store["id"]; ?>',
            'max_price' : max_price,
            'selected_categories' : selected_categories
        },
        success: function (response) {
            $("div#productsBox").html(response);
            lazyLoadInstance.update();

        }
    });
}); 
</script>

<style>
.add-to-store{
    cursor: pointer;
}
</style>