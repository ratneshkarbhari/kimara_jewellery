<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4 page-content">
    <div class="container">
    
        <h1 class="page-title"><?php echo $title; ?></h1>


        <form action="<?php echo site_url('filter-sales-by-date'); ?>" method="post" class="row">
        
            <div class="form-group col-lg-4 col-md-12 col-sm-12">
                <label for="date_start">Date Start</label>
                <input placeholder="<?php echo date('d-m-Y'); ?>" type="text" name="date_start" class="form-control" id="date_start">
            </div>
            <div class="form-group col-lg-4 col-md-12 col-sm-12">
                <label for="date_end">Date End</label>
                <input placeholder="<?php echo date('d-m-Y'); ?>" type="text" name="date_end" class="form-control" id="date_end">
            </div>
            <div class="form-group col-lg-4 col-md-12 col-sm-12">
                <button type="submit" class="btn btn-primary btn-block" style="margin-top: 7%;">Filter Date</button>
            </div>        
        </form>

        <?php if(count($orders)>0): ?>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <td style="font-size: 1.2rem; font-weight: 500;">Public Order ID</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Date</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Store</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Code</td>
                        <td style="font-size: 1.2rem; font-weight: 500;">Amount (₹)</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $total_sales = 0.00; foreach($orders as $order): ?>
                    <tr>
                        <td><a class="analytic-link" href="<?php echo site_url('order-details/'.$order['public_order_id']); ?>"><?php echo $order['public_order_id']; ?></a></td>
                        <td><?php echo $order["date"]; ?></td>
                        <td><a class="analytic-link" href="<?php echo site_url('orders-from-store/'.$order['store']); ?>"><?php echo $order['store']; ?></a></td>
                        <td><a class="analytic-link" href="<?php echo site_url('orders-from-code/'.$order['code']); ?>"><?php echo $order['code']; ?></a></td>
                        <td><?php $total_sales=$total_sales+$order['amount_paid']; echo $order['amount_paid']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php else: ?>

        <h6>No Sales Found</h6>

        <?php endif; ?>

    </div>
    
</main>

<style>
    a.analytic-link{
        color: blue !important;
    }
</style>