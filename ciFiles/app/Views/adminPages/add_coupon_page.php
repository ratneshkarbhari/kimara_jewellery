<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
        <h3 class="page-title"><?php echo $title; ?></h3>

        <p class="text-danger"><?php echo $error; ?></p>

        <p class="text-success"><?php echo $success; ?></p>

        <form enctype="multipart/form-data" action="<?php echo site_url('create-coupon-exe'); ?>" method="post">
            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title">
            </div>
            <label>Status</label>
            <select class="form-control" name="status" id="status">
                <option value="disabled">Disabled</option>
                <option value="active">Active</option>
            </select>
            <br>
            <label>Merchant</label>
            <select class="form-control" name="merchant" id="merchant">
                <option value="NA">Not Applicable</option>
            <?php foreach($vendors as $vendor): ?>
                <option value="<?php echo $vendor["id"]; ?>"><?php echo $vendor["first_name"].' '.$vendor["last_name"]; ?></option>
            <?php endforeach; ?>
            </select>
            <div class="form-group">
                <label for="code">Code</label>
                <input class="form-control" type="text" name="code" id="code" required>
            </div>
            <div class="form-group">
                <label for="percentage_discount">Percentage Discount</label>
                <input class="form-control" type="text" name="percentage_discount" id="percentage_discount" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Create Coupon</button>
        </form>
    </div>
</main>