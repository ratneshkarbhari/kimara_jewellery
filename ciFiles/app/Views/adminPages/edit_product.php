<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h2 class="page-title"><?php echo $title; ?></h2>
        <p class="text-success darken-4"><?php echo $success; ?></p>
        <p class="text-danger darken-4"><?php echo $error; ?></p>

        <form action="<?php echo site_url('update-product-exe'); ?>" enctype="multipart/form-data" method="post">

            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" value="<?php echo $product['title']; ?>" id="title" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" value="<?php echo $product['slug']; ?>" id="slug">
            </div>

            <div class="container-fluid">
            
                <div class="row">
                
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="price">Price</label>
                        <input class="form-control" type="text" name="price" id="price" value="<?php echo $product['price']; ?>">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="sale_price">Sale Price</label>
                        <input value="<?php echo $product['sale_price']; ?>" class="form-control" type="text" name="sale_price" id="sale_price">
                    </div>
                
                </div>
            
            </div>

            <div class="form-group">
                <label>Featured Product?</label>
                <br>
                <select class="form-control" name="featured">
                    <option value="no" <?php if($product['featured']=='no'){
                        echo 'selected';
                    } ?>>No</option>
                    <option value="yes" <?php if($product['featured']=='yes'){
                        echo 'selected';
                    } ?>>Yes</option>
                </select>
            </div>

            <div class="form-group">
                <label>Daily Deal</label>
                <br>
                <select class="form-control" name="daily_deal">
                    <option value="no" <?php if($product['daily_deal']=='no'){
                        echo 'selected';
                    } ?>>No</option>
                    <option value="yes" <?php if($product['daily_deal']=='yes'){
                        echo 'selected';
                    } ?>>Yes</option>
                </select>
            </div>
            
            
            <div class="form-group">
                <label>Category</label>
                <br>
                <select class="form-control" name="category">
                    <!-- <option value="0" selected>Independent</option> -->
                    <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>" <?php if($product['category']==$category['id']){echo 'selected';} ?>><?php echo $category['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label>Visibility</label>
                <br>
                <select class="form-control" name="visibility">
                    <option value="visible" <?php if($product['visibility']=='visible'){echo 'selected';} ?>>Visible</option>
                    <option value="hidden" <?php if($product['visibility']=='hidden'){echo 'selected';} ?>>Hidden</option>
                </select>
            </div>
            <br>
            <img src="<?php echo site_url('assets/images/featured_image_product/'.$product['featured_image']); ?>" style="width: 30%;">
            <div class="form-group">
                <label for="featured_image">Replace Featured Image</label><br>
                <input type="file" name="featured_image" id="featured_image" accept="image/*">
            </div>
            <br>
            <div class="form-group">
                <label for="sizes">Sizes (Provide values separated by ,)</label>
                <input class="form-control" type="text" name="sizes" id="sizes" value="<?php echo $product['sizes']; ?>">
            </div>
            <div class="form-group">
                <label for="materials">Materials (Provide values separated by ,)</label>
                <input class="form-control" type="text" name="materials" id="materials" value="<?php echo $product['materials']; ?>">
            </div>
            <br>
            <div class="form-group">
                <label for="stock_count">Stock Count</label>
                <input class="form-control" type="number" min="1" name="stock_count" id="stock_count" value="<?php echo $product['stock_count']; ?>">
            </div>
            <br>
            <?php $gallery_images = explode(',',$product['gallery_images']); foreach($gallery_images as $gal_img): ?>
                <img src="<?php echo site_url('assets/images/gallery_images_product/'.$gal_img); ?>" style="width: 20%;">
            <?php endforeach; ?>
            <div class="form-group">
                <label for="gallery_images">Replace Gallery Images</label><br>
                <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple>
            </div>
            <br>
            <div class="form-group">
                <label for="gallery_videos">Replace Gallery Videos</label><br>
                <input type="file" name="gallery_videos[]" id="gallery_videos" accept="video/*">
            </div>
            <br>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"><?php echo $product['description']; ?></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success"> Update Product </button>

        </form>
        
    </div>
</main>