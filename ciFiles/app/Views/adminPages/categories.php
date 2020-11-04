<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h3 class="page-title"><?php echo $title; ?></h3>

        <p class="text-danger"><?php echo $error; ?></p>
    
        <p class="text-success"><?php echo $success; ?></p>

        <a href="<?php echo site_url('add-category'); ?>" class="btn btn-success">+ Add Category</a>


        <div class="items-container">
        
        
        <?php if(count($categories)>0): ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td style="font-size: 1.2rem; font-weight: 500;">Title</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Parent Category</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Description</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($categories as $category): ?>
                        <tr>
                            <td><?php echo $category['title']; ?></td>
                            <td><?php  
                            
                            foreach($pcats as $pcat){
                                if ($pcat['id']==$category['parent']) {
                                    echo $pcat['title'];
                                }else {
                                    echo 'Independent';
                                }
                            }
                            
                            ?></td>
                            <td><?php echo $category['description']; ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo site_url('edit-category/'.$category['slug']); ?>">Edit</a>
                                <form action="<?php echo site_url('delete-category-exe'); ?>" style="display: inline;" method="post">
                                    <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <h6>No Categories Added</h6>

        <?php endif; ?>

        </div>


    </div>
</main>