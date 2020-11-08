<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h2 class="page-title"><?php echo $title; ?></h2>
        <p class="text-success darken-4"><?php echo $success; ?></p>
        <p class="text-danger darken-4"><?php echo $error; ?></p>

        <form action="<?php echo site_url('update-category-exe'); ?>" enctype="multipart/form-data" method="post">

            <input type="hidden" name="id" value="<?php echo $category['id']; ?>">

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" value="<?php echo $category['title']; ?>" name="title" id="title" required>
            </div>
            <div class="form-group">
                <label for="slug">Slug</label>
                <input class="form-control" type="text" name="slug" id="slug" value="<?php echo $category['slug']; ?>">
            </div>
            <div class="form-group">
                <label>Parent Category</label>
                <br>
                <select class="form-control" name="parent">
                    <option value="0" selected>Independent</option>
                    <?php foreach($pcats as $pcat): if($pcat['id']!=$category['id']): ?>
                    <option value="<?php echo $category['id']; ?>" <?php if($category['parent']==$pcat['id']){echo 'selected';} ?>><?php echo $category['title']; ?></option>
                    <?php endif; endforeach; ?>
                </select>
            </div>
            <br>
            <div class="form-group">
                <label>Visibility</label>
                <br>
                <select class="form-control" name="visibility">
                    <option value="visible" <?php if($category['visibility']=='visible'){
                        echo 'selected';
                    } ?>>Visible</option>
                    <option value="hidden" <?php if($category['visibility']=='hidden'){
                        echo 'selected';
                    } ?>>Hidden</option>
                </select>
            </div>
            <br>
            <img src="<?php echo site_url('assets/images/category_featured_images/'.$category['featured_image_rect']); ?>" style="width: 30%;">
            <div class="form-group">
                <label for="featured_image_rect">Featured Image Rectangular</label><br>
                <input type="file" name="featured_image_rect" id="featured_image_rect" accept="image/*">
            </div>
            <br>
            <img src="<?php echo site_url('assets/images/category_featured_images/'.$category['featured_image_square']); ?>" style="width: 30%;">
            <div class="form-group">
                <label for="featured_image_square">Featured Image Square</label><br>
                <input type="file" name="featured_image_square" id="featured_image_square" accept="image/*">
            </div>
            <br>
            <img src="<?php echo site_url('assets/images/category_featured_images/'.$category['featured_image_circular']); ?>" style="width: 30%;">
            <div class="form-group">
                <label for="featured_image_circular">Featured Image Circular</label><br>
                <input type="file" name="featured_image_circular" id="featured_image_circular" accept="image/*">
            </div>
            <br>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"><?php echo $category['description']; ?></textarea>
            </div>
            <br>
            <button type="submit" class="btn btn-success"> Update Category </button>
        </form>
    </div>
</main>