<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h3 class="page-title"><?php echo $title; ?></h3>

        <p class="text-danger"><?php echo $error; ?></p>
    
        <p class="text-success"><?php echo $success; ?></p>

        <a href="<?php echo site_url('add-product'); ?>" class="btn btn-success">+ Add Product</a>


        <div class="items-container">
        
        
        <?php if(count($products)>0): ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td style="font-size: 1.2rem; font-weight: 500;">Title</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Category</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Description</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product): ?>
                        <tr>
                            <td><?php echo $product['title']; ?></td>
                            <td><?php  
                            
                            foreach($categories as $category){
                                if ($product['id']==$product['category']) {
                                    echo $product['title'];
                                }else {
                                    echo 'Independent';
                                }
                            }
                            
                            ?></td>
                            <td><?php echo $product['description']; ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo site_url('edit-product/'.$product['slug']); ?>">Edit</a>
                                <form action="<?php echo site_url('delete-product-exe'); ?>" style="display: inline;" method="post">
                                    <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <h6>No Products Added</h6>

        <?php endif; ?>

        </div>


    </div>
</main>