<main class="page-content" id="my-account" style="padding: 5% 0 10% 0;">
    <div class="container">
        <h3 class="page-title" style="margin-bottom: 5%;">My Account</h3>
        <div class="row">
            <div class="col-3" style="padding: 3%; box-shadow: 0px 0px 20px lightgray;">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="true">Edit Profile</a>
                <a class="nav-link" id="v-pills-orders-tab" data-toggle="pill" href="#v-pills-orders" role="tab" aria-controls="v-pills-orders" aria-selected="false">Orders</a>
                <!-- <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">Address</a> -->
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">Settings</a>
                <a class="nav-link" id="logoutLink" href="<?php echo site_url('logout'); ?>">Logout</a>
                <style>
                    a#logoutLink{
                        background-color: red;
                        color: white !important;
                    }
                </style>
                </div>
            </div>
            <div class="col-9">
                <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-home-tab">
                

                </div>
                <div class="tab-pane fade" id="v-pills-orders" role="tabpanel" aria-labelledby="v-pills-orders-tab">
                
                
                </div>
                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">...</div>
                <div class="tab-pane fade" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">...</div>
                </div>
            </div>
        </div>
    </div>
</main>
<style>
a.nav-link.active{
    color: #ffffff !important;
}
</style>