<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <?php if($count < getMaximumAccount() || !empty($result)){?>
        <div class="card">
            <div class="header">
                <h2>
                    <i class="fa fa-plus-square" aria-hidden="true"></i> <?=l('Update Facebook account')?> 
                </h2>
            </div>
            <div class="body pt0">
                <div class="row">
                    <div class="col-sm-12 mb0">
                        <form method="POST" action="<?=cn('ajax_update')?>" data-action-token="<?=cn('ajax_get_page_token')?>" data-redirect="<?=cn()?>">
                            <ul class="nav nav-tabs tab-col-pink mb15 " role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_md_col_1" data-toggle="tab"><?=l('STEP 1: GET ACCESS TOKEN')?></a>
                                </li>
                            </ul>
                            <b><?=l('Facebook username')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="hidden" class="form-control" name="id" value="<?=!empty($result)?$result->id:0?>">
                                    <input type="text" class="form-control" name="username" placeholder="Username">
                                </div>
                            </div>
                            <b><?=l('Facebook password')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>
                            </div>
                            <b><?=l('Facebook App')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <select id="app" name="app" class="form-control">
                                    <option value="6628568379">Facebook For Iphone</option>
                                    <option value="350685531728">Facebook For Android</option>
                                </select>
                            </div>
                            <button type="button" class="btn bg-light-green waves-effect btnFBGetToken"><?=l('Get Access Token')?></button>
                            <div class="row">
                                <div class="col-md-12 open_iframe">
                                    
                                </div>
                            </div>
                            <ul class="nav nav-tabs tab-col-pink mb15" role="tablist" style="margin-top: 20px;">
                                <li role="presentation" class="active">
                                    <a href="#home_md_col_1" data-toggle="tab"><?=l('STEP 2: ADD ACCESS TOKEN')?></a>
                                </li>
                            </ul>
                            <b><?=l('Access Token')?> (<span class="col-red">*</span>)</b>
                            <div class="form-group">
                                <div class="form-line">
                                    <textarea rows="4" class="form-control no-resize access_token" name="access_token" placeholder="Enter access token"></textarea>
                                </div>
                            </div>
                            <button type="button" class="btn bg-red waves-effect btnFBAccountUpdate"><?=l('Submit')?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php }else{?>
    <div class="card">
        <div class="body">
            <div class="alert alert-danger">
                <?=l('Oh sorry! You have exceeded the number of accounts allowed, You are only allowed to update your account')?>
            </div>
            <a href="<?=cn()?>" class="btn bg-grey waves-effect"><?=l('Back')?></a>
        </div>
    </div>
    <?php }?>
    </div>
</div>

<style type="text/css">
    iframe{
        max-width: 100%;
    }
</style>