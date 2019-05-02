<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?=$template['title']?></title>
    <meta name="description" content="<?=DESCRIPTION?>"/>
    <meta name="keywords" content="<?=KEYWORDS?>"/>

    <!-- Facebook open graph tags -->
    <meta property="og:type" content="website"/>
    <meta property="og:site_name" content="VTCreators"/>
    <meta property="og:url" content="<?=current_url()?>"/>
    <meta property="og:title" content="<?=$template['title']?>"/>
    <meta property="og:description" content="<?=DESCRIPTION?>"/>

    <!-- Twitter card tags -->
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@vtcreators"/>
    <meta name="twitter:title" content="<?=$template['title']?>"/>
    <meta name="twitter:description" content="<?=DESCRIPTION?>"/>

    <!-- Favicon-->
    <link rel="icon" href="<?=BASE?>assets/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="<?=BASE?>assets/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=BASE?>assets/css/fonts.css" rel="stylesheet">

    <link href="<?=BASE?>assets/plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/sweetalert/sweetalert.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/material-design-preloader/md-preloader.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/css/style.css" rel="stylesheet">
    <link href="<?=BASE?>assets/css/themes/all-themes.css" rel="stylesheet" />
    <link href="<?=BASE?>assets/css/custom.css" rel="stylesheet">
    <script src="<?=BASE?>assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript">
        var PATH       = '<?=PATH?>';
        var BASE       = '<?=BASE?>';
        var list_chart = [];
        var token      = '<?=$this->security->get_csrf_hash();?>';
        var module     = '<?=$this->router->fetch_class();?>';
        var Lang = {};
        Lang["yes"]     = '<?=l('Yes')?>';
        Lang["deleted"] = '<?=l('Deleted')?>';
        Lang["selectoneitem"] = '<?=l('Select at least one item')?>';
        Lang["selectonemedia"] = '<?=l('Select at least one Page/Group/Profile/Friend')?>';
        Lang["emptyTable"] = '<?=l('No data available in table')?>';
        Lang["processing"] = '<?=l('Processing')?>';
    </script>
</head>

<body class="theme-<?=THEME?>">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p><?=l('Please wait...')?></p>
        </div>
    </div>
    <div class="page-loader-action">
        <div class="loader">
            <div class="md-preloader pl-size-md">
                <svg viewbox="0 0 75 75">
                    <circle cx="37.5" cy="37.5" r="33.5" class="pl-red" stroke-width="4" />
                </svg>
            </div>
            <p><?=l('Please wait...')?></p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <?=modules::run("blocks/header")?>
    <?=$template['body']?>

    <div class="modal fade box-modal" id="loginModal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-login modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header bg-light-green">
                    <h4 class="modal-title" id="defaultModalLabel"><?=l('Login')?></h4>
                </div>
                <div class="modal-body">
                    <div class="body">
                        <form action="<?=url('user_management/ajax_login')?>" data-redirect="<?=current_url()?>">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="email" placeholder="<?=l('Email')?>" required autofocus>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" placeholder="<?=l('Password')?>" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <button type="submit" class="right btn bg-light-green waves-effect btnActionUpdate"><?=l('Login')?></button>
                            </div>

                            <?php if((FACEBOOK_ID != "" && FACEBOOK_SECRET != "") || (GOOGLE_ID != "" && GOOGLE_SECRET != "") || (TWITTER_ID != "" && TWITTER_SECRET != "")){?>
                            <div class="clearfix"></div>
                            <div class="login-social">
                                <fieldset>
                                    <legend><span><?=l('OR LOGIN VIA')?></span></legend>
                                </fieldset>
                                <div class="list-social">
                                    <?php if(FACEBOOK_ID != "" && FACEBOOK_SECRET != ""){?>
                                    <a href="<?=url("oauth/facebook")?>" title=""><img src="<?=BASE?>assets/images/btn-facebook.png" title="" alt=""></a>
                                    <?php }?>
                                    <?php if(GOOGLE_ID != "" && GOOGLE_SECRET != ""){?>
                                    <a href="<?=url("oauth/google")?>" title=""><img src="<?=BASE?>assets/images/btn-google.png" title="" alt=""></a>
                                    <?php }?>
                                    <?php if(TWITTER_ID != "" && TWITTER_SECRET != ""){?>
                                    <a href="<?=url("oauth/twitter")?>" title=""><img src="<?=BASE?>assets/images/btn-twitter.png" title="" alt=""></a>
                                    <?php }?>
                                </div>
                            </div>
                            <?php }?>
                        </form>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <?php if(REGISTER_ALLOWED == 1){?>
    <div class="modal fade box-modal" id="registerModal" tabindex="-1" role="dialog">
        <div class="modal-login modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header bg-light-blue">
                    <h4 class="modal-title" id="defaultModalLabel"><?=l('Register')?></h4>
                </div>
                <div class="modal-body">
                    <div class="body">
                        <form  action="<?=url('user_management/ajax_register')?>" data-redirect="<?=current_url()?>">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="fullname" placeholder="<?=l('Fullname')?>" required autofocus>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">email</i>
                                </span>
                                <div class="form-line">
                                    <input type="email" class="form-control" name="email" placeholder="<?=l('Email Address')?>" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" minlength="6" placeholder="<?=l('Password')?>" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" name="repassword" minlength="6" placeholder="<?=l('Confirm password')?>" required>
                                </div>
                            </div>
                            <div class="input-group text-center">
                                <button type="submitt" class="btn bg-light-blue waves-effect btnActionUpdate"><?=l('Register')?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php }?>

    <script src="<?=BASE?>assets/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="<?=BASE?>assets/plugins/momentjs/moment.js"></script>
    <script src="<?=BASE?>assets/plugins/geocomplete/jquery.geocomplete.js"></script>
    <script src="<?=BASE?>assets/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>
    <script src="<?=BASE?>assets/plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <script src="<?=BASE?>assets/plugins/gmaps/gmaps.js"></script>
    <script src="<?=BASE?>assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script src="<?=BASE?>assets/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="<?=BASE?>assets/plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="<?=BASE?>assets/js/admin.js"></script>
    <script src="<?=BASE?>assets/js/analytics.js"></script>
    <script src="<?=BASE?>assets/js/script.js"></script>
</body>

</html>
