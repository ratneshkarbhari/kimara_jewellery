<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h3 class="page-title"><?php echo $title; ?></h3>

        <p class="text-danger"><?php echo $error; ?></p>
    
        <p class="text-success"><?php echo $success; ?></p>

        <a href="<?php echo site_url('add-collection'); ?>" class="btn btn-success">+ Add Collection</a>


        <div class="items-container">
        
        
        <?php if(count($collections)>0): ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td style="font-size: 1.2rem; font-weight: 500;">id</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Title</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Product Count</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Description</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($collections as $collection): ?>
                        <tr>
                            <td><?php echo $collection['id']; ?></td>
                            <td><?php echo $collection['title']; ?></td>
                            <td><?php echo $products_count = count(explode(',',$collection['products'],TRUE)); ?></td>
                            <td><?php echo $collection['description']; ?></td>
                            <td>
                                <!-- <a class="btn btn-primary" href="<?php echo site_url('edit-collection/'.$collection['slug']); ?>">Edit</a> -->
                                <form action="<?php echo site_url('delete-collection-exe'); ?>" style="display: inline;" method="post">
                                    <input type="hidden" name="id" value="<?php echo $collection['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <h6>No Collection Added</h6>

        <?php endif; ?>

        </div>


    </div>
</main>