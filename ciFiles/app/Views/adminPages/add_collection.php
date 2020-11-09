<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h2 class="page-title"><?php echo $title; ?></h2>
        <p class="text-success darken-4"><?php echo $success; ?></p>
        <p class="text-danger darken-4"><?php echo $error; ?></p>

        <form action="<?php echo site_url('add-collection-exe'); ?>" enctype="multipart/form-data" method="post">

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" id="slug">
            </div>
            <div id="product" class="form-group container-fluid">
                <div class="row">
                    <?php foreach($products as $product): ?>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" class="w-100">
                        <div class="text-center">
                            <input type="checkbox" value="<?php echo $product['id']; ?>" name="collection_products[]" class="form-check">
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>            
            </div>
            <div class="form-group">
                <label for="featured_image">Featured Image </label><br>
                <input type="file" name="featured_image" id="featured_image" accept="image/*">
            </div>
            <br>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success"> Add Collection </button>

        </form>
        
    </div>
</main>