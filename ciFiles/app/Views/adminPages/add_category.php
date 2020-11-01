<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h2 class="page-title"><?php echo $title; ?></h2>
        <p class="text-success darken-4"><?php echo $success; ?></p>
        <p class="text-danger darken-4"><?php echo $error; ?></p>

        <form action="<?php echo site_url('add-category-exe'); ?>" enctype="multipart/form-data" method="post">

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" id="slug">
            </div>
            <div class="form-group">
                <label>Parent Category</label>
                <br>
                <select class="form-control" name="parent">
                    <option value="0" selected>Independent</option>
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
                <label for="featured_image_rect">Featured Image Rectangular</label><br>
                <input type="file" name="featured_image_rect" id="featured_image_rect" accept="image/*">
            </div>
            <br>
            <div class="form-group">
                <label for="featured_image_square">Featured Image Square</label><br>
                <input type="file" name="featured_image_square" id="featured_image_square" accept="image/*">
            </div>
            <br>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success"> Add Category </button>

        </form>
        
    </div>
</main>