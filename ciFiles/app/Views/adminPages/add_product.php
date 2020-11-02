<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h2 class="page-title"><?php echo $title; ?></h2>
        <p class="text-success darken-4"><?php echo $success; ?></p>
        <p class="text-danger darken-4"><?php echo $error; ?></p>

        <form action="<?php echo site_url('add-product-exe'); ?>" enctype="multipart/form-data" method="post">

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" id="slug">
            </div>

            <div class="container-fluid">
            
                <div class="row">
                
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="price">Price</label>
                        <input class="form-control" type="text" name="price" id="price">
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12">
                        <label for="sale_price">Sale Price</label>
                        <input class="form-control" type="text" name="sale_price" id="sale_price">
                    </div>
                
                </div>
            
            </div>

            <div class="form-group">
                <label>Featured Product?</label>
                <br>
                <select class="form-control" name="featured">
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
            </div>
            
            
            <div class="form-group">
                <label>Category</label>
                <br>
                <select class="form-control" name="category">
                    <!-- <option value="0" selected>Independent</option> -->
                    <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label>Visibility</label>
                <br>
                <select class="form-control" name="visibility">
                    <option value="visible" selected>Visible</option>
                    <option value="hidden">Hidden</option>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label for="featured_image">Featured Image</label><br>
                <input type="file" name="featured_image" id="featured_image" accept="image/*">
            </div>
            <br>
            <div class="form-group">
                <label for="sizes">Sizes (Provide values separated by ,)</label>
                <input class="form-control" type="text" name="sizes" id="sizes">
            </div>
            <div class="form-group">
                <label for="materials">Materials (Provide values separated by ,)</label>
                <input class="form-control" type="text" name="materials" id="materials">
            </div>
            <br>
            <div class="form-group">
                <label for="stock_count">Stock Count</label>
                <input class="form-control" type="number" min="1" value="1" name="stock_count" id="stock_count">
            </div>
            <br>
            <div class="form-group">
                <label for="gallery_images">Gallery Images</label><br>
                <input type="file" name="gallery_images[]" id="gallery_images" accept="image/*" multiple>
            </div>
            <br>
            <div class="form-group">
                <label for="gallery_videos">Gallery Videos</label><br>
                <input type="file" name="gallery_videos[]" id="gallery_videos" accept="video/*">
            </div>
            <br>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success"> Add Product </button>

        </form>
        
    </div>
</main>