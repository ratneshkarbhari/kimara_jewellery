<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h1 class="page-title"><?php echo $title; ?></h1>


        <div class="items-container">
        
        
            <form action="<?php echo site_url('update-category-positions'); ?>" method="post">
            
                <div class="form-group">

                    <label for="ig_feed">IG Feed Categories</label><br>
                    <?php foreach($categories as $category): if($category['parent']==0): ?>

                        <input value="<?php echo $category['id']; ?>" type="checkbox" name="ig_feed[]" <?php $ig_feed_cats = $category_positions['ig_feed']; $ig_feed_cat_array = explode(',',$ig_feed_cats); if(in_array($category['id'],$ig_feed_cat_array)){echo 'checked';} ?>> <small><?php echo $category['title']; ?></small>

                        

                    <?php endif; endforeach; ?>
                
                </div>
                <div class="form-group">

                    <label for="homepage">Home Page Categories</label><br>
                    <?php foreach($categories as $category): if($category['parent']==0): ?>

                        <input value="<?php echo $category['id']; ?>" type="checkbox" name="homepage[]" <?php $homepage_cats = $category_positions['homepage']; $homepage_cat_array = explode(',',$homepage_cats); if(in_array($category['id'],$homepage_cat_array)){echo 'checked';} ?>> <small><?php echo $category['title']; ?></small>

                    <?php endif; endforeach; ?>
                
                </div>
                <div class="form-group">

                    <label for="homepage">Sidenav Categories</label><br>
                    <?php foreach($categories as $category): if($category['parent']==0): ?>

                        <input value="<?php echo $category['id']; ?>" type="checkbox" name="sidenav[]" <?php $sidenav_cats = $category_positions['sidenav']; $sidenav_cat_array = explode(',',$sidenav_cats); if(in_array($category['id'],$sidenav_cat_array)){echo 'checked';} ?>> <small><?php echo $category['title']; ?></small>

                    <?php endif; endforeach; ?>

                </div>

            
                <button type="submit" class="btn btn-success">Update</button>

            </form>


        </div>

    </div>
</main>