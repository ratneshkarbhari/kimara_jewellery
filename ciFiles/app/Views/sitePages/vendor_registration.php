<main class="page-content" id="customer-login" style="padding-top: 10vh !important;">

    <div class="container">

        <div class="row">
        
            <div class="col-lg-3 col-md-12 col-sm-12"></div>
            <div class="col-lg-6 col-md-12 col-sm-12">
            
                <h2 class="text-center"><?php echo $title; ?></h2>


                <p id="registration-error" class="text-danger text-center"></p>
                
                <div id="emailProvideBox">
                    <div class="form-group">
                    
                        <label for="customer-email">Email</label>
                        <input style="border: 1px solid black;" class="form-control" type="email" name="customer-email" id="customer-email">

                    </div>


                    <button type="button" id="getVerifCode" class="btn btn-success">GET EMAIL VERIFICATION CODE</button>

                    <script>
                    
                        $("button#getVerifCode").click(function (e) { 
                            e.preventDefault();
                            let enteredEmail = $("input#customer-email").val();
                            if (enteredEmail=='') {
                                $("small#registration-error").html('Please Enter Email to proceed');
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url('get-email-verif-code'); ?>",
                                    data: {
                                        'emailEntered' : enteredEmail
                                    },
                                    success: function (response) {
                                        if(response=='customer-already-exists'){
                                            $("p#registration-error").html('Customer Already Exists');
                                        }else if(response=='email-send-fail'){
                                            $("p#registration-error").html('Email sending Failed');
                                        }else{
                                            $("p#registration-error").html('');
                                            $("div#emailVerifBox").css('display','block');
                                            $("div#emailProvideBox").css('display','none');
                                        }
                                    }
                                });
                            }
                        });
                    
                    </script>
                    
                </div>

                <div id="emailVerifBox" style="display: none;">

                    <div class="form-group">
                    
                        <label for="customer-email-verif-code">Verification Code</label>
                        <input style="border: 1px solid black;" class="form-control" type="text" name="customer-email-verif-code" id="customer-email-verif-code">

                    </div>


                    <button type="button" id="verifyCodeButton" class="btn btn-success">VERIFY EMAIL</button>

                    <script>
                    
                        $("button#verifyCodeButton").click(function (e) {
                            e.preventDefault();
                            let enteredCode = $("input#customer-email-verif-code").val();
                            if (enteredCode=='') {
                                $("p#registration-error").html('Please Enter Code to proceed');
                            } else {
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url('verify-email-exe'); ?>",
                                    data: {
                                        'enteredCode' : enteredCode
                                    },
                                    success: function (response) {
                                        if(response=='code-incorrect'){
                                            $("p#registration-error").html('The Code Provided is incorrect');
                                        }else{
                                            $("p#registration-error").html('');
                                            $("div#accountCreateBox").css('display','block');                                            
                                            $("div#emailVerifBox").css('display','none');
                                        }
                                    }
                                });
                            }
                        });
                    
                    </script>
                    
                </div>
                <div class="container-fluid" id="accountCreateBox" style="display: none;">


                    <div class="row">
                    
                        <div class="col-lg-6 col-md-12 col-sm-12">
                        
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input class="form-control" type="text" name="fname" id="first_name">
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                        
                           <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input class="form-control" type="text" name="lname" id="last_name">
                            </div>
                        
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                        
                            <div class="form-group">
                                <label for="password1">Set a Password</label>
                                <input class="form-control" type="password" name="password1" id="password1">
                            </div>

                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                        
                            <div class="form-group">
                                <label for="password2">Repeat Password</label>
                                <input class="form-control" type="password" name="password2" id="password2">
                            </div>
                        
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                        
                           <button type="button" id="createAccountButton" class="btn btn-success">CREATE ACCOUNT</button>

                        </div>

                        <script>



                            $("button#createAccountButton").click(function (e) { 
                                e.preventDefault();

                                let password1 = $("input#password1").val();
                                let password2 = $("input#password2").val();

                                if (password1!=password2) {
                                    $("p#registration-error").html('Password Re Entered should match');
                                } else {

                                    let fname = $("input#first_name").val();
                                    let lname = $("input#last_name").val();
                                    let passwordset = $("input#password1").val();


                                    $.ajax({
                                        type: "POST",
                                        url: "<?php echo site_url('create-vendor-account-exe'); ?>",
                                        data: {
                                            'fname' : fname,
                                            'lname' : lname,
                                            'password' : passwordset
                                        },
                                        success: function (response) {
                                            if (response=='account-created') {
                                                window.location.replace("<?php echo site_url('vendor-dashboard'); ?>");
                                            }else{
                                                $("p#registration-error").html('Account cant be created');
                                            }
                                        }
                                    });
                                }

                            });

                                

                        
                        </script>    
                    
                    
                    </div>



                </div>


                    <div class="text-center" style="margin-top: 15%;">
                    
                        <p>Already have an Account? <a style="color: red;" href="<?php echo site_url('customer-login'); ?>">Login Here</a></p>
                    
                    </div>
                
                
            
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12"></div>
        
        </div>    
    
    </div>

</main>