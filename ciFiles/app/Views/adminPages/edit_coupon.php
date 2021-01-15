<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
        <h3 class="page-title"><?php echo $title; ?></h3>

        <p class="text-danger"><?php echo $error; ?></p>

        <p class="text-success"><?php echo $success; ?></p>

        <form enctype="multipart/form-data" action="<?php echo site_url('update-coupon'); ?>" method="post">

            <input type="hidden" name="id" value="<?php echo $focus_coupon['id']; ?>">

            <div class="form-group">
                <label for="title">Title</label>
                <input class="form-control" type="text" name="title" id="title" value="<?php echo $focus_coupon['title']; ?>">
            </div>
            <label>Status</label>
            <select class="form-control" name="status" id="status">
                <option value="disabled" <?php if($focus_coupon['status']=='disabled'){echo 'selected';} ?>>Disabled</option>
                <option value="active" <?php if($focus_coupon['status']=='active'){echo 'selected';} ?>>Active</option>
            </select>
            <br>
            <label>Merchant</label>
            <select class="form-control" name="merchant" id="merchant">
                <option value="NA">Not Applicable</option>
                <?php foreach($vendors as $vendor): ?>
                <option value="<?php echo $vendor["id"]; ?>" <?php if($focus_coupon["merchant"]==$vendor["id"]){echo 'selected';} ?>><?php echo $vendor["first_name"].' '.$vendor["last_name"]; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="form-group">
                <label for="code">Code</label>
                <input class="form-control" type="text" name="code" id="code" required  value="<?php echo $focus_coupon['code']; ?>">
            </div>
            <div class="form-group">
                <label for="percentage_discount">Percentage Discount</label>
                <input class="form-control" type="text" name="percentage_discount" id="percentage_discount" required value="<?php echo $focus_coupon['percentage_discount']; ?>">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control"><?php echo $focus_coupon['description']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-success">Update Coupon</button>
        </form>
    </div>
</main>