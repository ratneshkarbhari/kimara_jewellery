<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h3 class="page-title"><?php echo $title; ?></h3>

        <p class="text-danger"><?php echo $error; ?></p>
    
        <p class="text-success"><?php echo $success; ?></p>

        <form enctype="multipart/form-data" action="<?php echo site_url('add-slide-exe'); ?>" method="post">
            <div class="form-group">
                <label for="link">Link</label>
                <input class="form-control" type="text" name="link" id="link">
            </div>
            <div class="form-group">
                <label for="desktop_image">Desktop Image</label>
                <input class="form-control" type="file" name="desktop_image" id="desktop_image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="touch_image">Touch Image</label>
                <input class="form-control" type="file" name="touch_image" id="touch_image" accept="image/*">
            </div>
            <button type="submit" class="btn btn-success">Add Slide</button>
        </form>


        <div class="items-container">
        
        
        <?php if(count($slides)>0): ?>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td style="font-size: 1.2rem; font-weight: 500;">Link</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Image Desktop</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Image Touch</td>
                            <td style="font-size: 1.2rem; font-weight: 500;">Actions</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($slides as $slide): ?>
                        <tr>
                            <td><?php echo $slide['link']; ?></td>
                            <td><?php echo site_url('assets/images/banners/'.$slide['desktop_image']); ?></td>
                            <td><?php echo site_url('assets/images/banners/'.$slide['touch_image']); ?></td>
                            <td>
                                <form action="<?php echo site_url('delete-slide-exe'); ?>" style="display: inline;" method="post">
                                    <input type="hidden" name="id" value="<?php echo $slide['id']; ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>

            <h6>No Slides Added</h6>

        <?php endif; ?>

        </div>


    </div>
</main>