<?php $__env->startSection('title', 'Account Settings'); ?>

<?php $__env->startSection('page_css'); ?>
        <!-- telephone plugin -->
<link rel="stylesheet" href="<?php echo e(url('css/telephonePlugin/intlTelInput.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('admin/vendors/cropper/cropper.css')); ?>">

<style>
        .password-progress {
            margin-top: 10px;
            margin-bottom: 0;
        }
        #valid-msg{
            color: green;
        }
        #error-msg{
            color: red;
        }
        .intl-tel-input{
            width: 100%;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


        <!-- page content -->
<div class="right_col" role="main">
    <?php echo Breadcrumbs::render('account_settings'); ?>

    <div class="">



        <?php if(isset($errors)): ?>
        <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php endif; ?>
        <?php if(\Session::has('msg')): ?>

        <?php endif; ?>
        <div class="clearfix"></div>

        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                            <h3>Account Settings</h3>
                    <div class="x_title">
                        <ul class="nav navbar-right panel_toolbox">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                            <li><a class="close-link"><i class="fa fa-close"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">

                        <form id="update_profile_form" action="<?php echo e(route('user-profile-update')); ?>" class="form-horizontal form-label-left"  novalidate method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                            <span class="section">Edit Profile</span>
                           <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="image">Change Image
                                </label>
                                    <div class="col-md-5 col-sm-5 col-xs-8">
                                        <img src="<?php echo e(url(Auth::user()->picture)); ?>" id="base_image" alt="..." style="max-width: 150px; max-height: 150px">
                                        
                                            
                                        
                                        <input type="file" name="new_profile_picture" class="form-control">
                                    </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="name" class="form-control col-md-7 col-xs-12" data-validate-length-range="3" data-validate-words="2" name="name" placeholder="both name(s) e.g Jon Doe" required="required" type="text" value="<?php echo e($user_credentials->name); ?>">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo e($user_credentials->email); ?>">
                                </div>
                            </div>
                            <?php if(Auth::user()->user_type != \App\Libraries\Enumerations\UserTypes::$ADMIN): ?>
                            <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">Mobile Phone <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden" id="countryCode" name="countryCode" value="<?php echo e(isset($user_detail->country_code) ? $user_detail->country_code : ''); ?>">
                                    <input type="hidden" id="iso2" name="iso2" value="<?php echo e(isset($user_detail->iso) ? $user_detail->iso : ''); ?>">
                                    <input type="tel" id="phone_number" name="phone_number" value="<?php echo e(isset($user_detail->phone) ? $user_detail->phone : ''); ?>" class="form-control" placeholder="" >
                                    <span id="valid-msg" class="hide"><i class="fa fa-check" aria-hidden="true"></i> Valid</span>
                                    <span id="error-msg" class="hide"><i class="fa fa-times" aria-hidden="true"></i> Invalid</span>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="save_pd_btn" type="submit" class="btn btn-success">Change Profile</button>
                                </div>
                            </div>
                        </form>


                        <form action="<?php echo e(route('password-change')); ?>" class="form-horizontal form-label-left" novalidate method="post" >
                            <input type="hidden" name="_token" value="<?php echo e(Session::token()); ?>">
                            <span class="section">Change Password</span>
                            <div class="item form-group">
                                <label for="password" class="control-label col-md-3">Old Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password_old" type="password" name="password_old" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="password" class="control-label col-md-3">Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repeat Password</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input id="password_confirmation" type="password" name="password_confirmation" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <button id="save_pw_btn" type="submit" class="btn btn-success">Change Password</button>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /page content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_js'); ?>
        <!-- telephone plugin -->
<script src="<?php echo e(asset('js/telephonePlugin/intlTelInput.min.js')); ?> "></script>
<script>
    $(document).ready(function() {
//        $('#save_pd_btn').attr('disabled',true);
        $("#save_pd_btn").click(function(e) {
            e.preventDefault();
            var codeNo = $("#phone_number").intlTelInput("getSelectedCountryData");
            var iso2 = codeNo.iso2;

            var dialNo = codeNo.dialCode;
            dialNo = '+' + dialNo;
            $("#countryCode").val(dialNo);
            $("#iso2").val(iso2);
            $("#update_profile_form").submit();
        });
        var telInput = $("#phone_number")
        errorMsg = $("#error-msg"),
                validMsg = $("#valid-msg");
        var initCountry = $("#iso2").val();
        if (initCountry == "")
            initCountry = "au";
        // initialise plugin
        telInput.intlTelInput({
            preferredCountries: ["au"],
            initialCountry: initCountry,
            utilsScript: "<?php echo e(asset('js/telephonePlugin/utils.js')); ?>",
        });
        var reset = function() {
            telInput.removeClass("error");
            errorMsg.addClass("hide");
            validMsg.addClass("hide");
        };

        telInput.blur(function () {
            //e.preventDefault();
            var str = telInput.val().replace(/[\s\-]+/g,'');

            if ($.isNumeric(str) == false || telInput.intlTelInput("isValidNumber") == false) {
                errorMsg.removeClass("hide");
                $('#save_pd_btn').attr('disabled',true);
            }else{
                validMsg.removeClass("hide");
                $('#save_pd_btn').attr('disabled',false);
            }
        });
        // on keyup / change flag: reset
        telInput.on("keyup change", reset);
    });
</script>
        <!-- validator -->

<script src="<?php echo e(url('admin/vendors/cropper/cropper.min.js')); ?>"></script>
<script>
        $(document).ready(function(){
            var cropper;
            var div2Width;
            var imageWidth;
            $("#change_picture").click(function()
            {
                $( "#imageFile" ).click();
            });
            $("#picture_change").click(function()
            {
                $( "#imageFile" ).click();
            });
            $( "#imageFile" ).change(function()
            {
                console.log('cropper created');
                var _URL = window.URL || window.webkitURL;
                img = new Image();
                img.onerror = function() { alert('Please chose an image file!'); };
                img.onload = function () {

                    var imageWidth = this.width;
                    $("#imageCropped").hide();
                    $('#image_upload').attr('src',this.src);
                    $("#image-div1").show();
                    $("#change_picture").hide();
                    $("#back").hide();
                    $("#save").hide();
                    $("#discard").show();
                    $("#getCroppedImage").show();
                    $('#modalChangePicture').modal('show');
                };
                img.src = _URL.createObjectURL(this.files[0]);
            });

            $("#getCroppedImage").click(function(){
                var imageSrc = cropper.getCroppedCanvas().toDataURL('image/jpeg');
                $("#image-div1").hide();
                $("#imageCropped").show();
                $("#imageCropped").attr('src', imageSrc );
                $("#save").show();
                $("#discard").show();
                $("#back").show();
                $("#change_picture").hide();
                $("#getCroppedImage").hide();
            });

            $( "#save" ).click(function()
            {
                $(".progress").show();
                var adminnId = <?php echo e(Auth::user()->id); ?>;

                var img = document.getElementById('imageFile');

                var cropedImg = $('#imageCropped').attr('src');

                $('#base_image').attr('src',cropedImg);
                var CSRF_TOKEN = "<?php echo e(csrf_token()); ?>";
                var data = new FormData();
                data.append('file', img.files[0]);
                data.append('cropedImageContent', cropedImg);
                data.append('adminId', adminnId);
                data.append('_token', CSRF_TOKEN);


                var Url = "<?php echo e(route('user_image_upload')); ?>";

                var xhr = new XMLHttpRequest();
                xhr.upload.addEventListener('progress',function(ev){
                    var progress = parseInt(ev.loaded / ev.total * 100);
                    $('#progressBar').css('width', progress + '%');
                    $('#progressBar').html(progress + '%');
                }, false);
                xhr.onreadystatechange = function(ev)
                {
                    console.log(xhr.readyState);
                    if(xhr.readyState == 4){
                        if(xhr.status = '200')
                        {
                            $("#imageCropped").hide();
                            $(".progress").hide();
                            $("#save").hide();
                            $("#back").hide();
                            $("#discard").hide();
                            $("#getCroppedImage").hide();
                            $('#progressBar').css('width','0' + '%');
                            $('#progressBar').html('0' + '%');
                            $('#modalChangePicture').modal('hide');
                        }
                    }
                };

                xhr.open('POST', Url , true);
                xhr.send(data);
                return false;
            });

            $( "#back" ).click(function()
            {
                $("#image-div1").show();
                $("#imageCropped").hide();
                $("#discard").show();
                $("#getCroppedImage").show();
                $("#save").hide();
                $("#back").hide();
                $("#change_picture").hide();
            });

            $( "#discard" ).click(function()
            {
                $('#modalChangePicture').modal('hide');
            });

            $("#modalChangePicture").on('hidden.bs.modal', function () {
                console.log('hide modal');
                cropper.destroy();
                $("#imageFile").val("");
            });

            $('#modalChangePicture').on('shown.bs.modal', function() {
                var div2Width = $("#upImage").width();
                if (this.width<div2Width)
                {
                    document.getElementById('image-div1').style.width = this.width;
                }
                var image = document.getElementById('image_upload');

                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    crop: function(e) {
                        console.log(e.detail.x);
                        console.log(e.detail.y);
                        console.log(e.detail.width);
                        console.log(e.detail.height);
                        console.log(e.detail.rotate);
                        console.log(e.detail.scaleX);
                        console.log(e.detail.scaleY);
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>