<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- Menu -->
        <div class="user-info bg-<?=THEME?>" style="background-image: none;">
            <div class="image">
                <img src="<?=BASE?>assets/images/user.png" width="48" height="48" alt="User">
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=l('Hi')?>, <?=FULLNAME_USER?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="<?=url('profile')?>" class=" waves-effect waves-block"><i class="material-icons">account_box</i>Update</a></li>
                        <li><a href="<?=url('logout')?>" class=" waves-effect waves-block"><i class="material-icons">lock_open</i>Logout</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu">
            <ul class="list">
                <li class="header"><?=l('MAIN NAVIGATION')?></li>
                <li class="<?=(segment(1) == "dashboard")?"active":""?>">
                    <a href="<?=url('dashboard')?>">
                        <i class="material-icons">home</i>
                        <span><?=l('Dashboard')?></span>
                    </a>
                </li>
                <li class="<?=(segment(1) == "facebook_accounts")?"active":""?>">
                    <a href="<?=url('facebook_accounts')?>">
                        <i class="fa fa-facebook-official fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Facebook accounts')?></span>
                    </a>
                </li>
                <li class="<?=(segment(1) == "save")?"active":""?>">
                    <a href="<?=url('save')?>">
                        <i class="fa fa-floppy-o fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Save post')?></span>
                    </a>
                </li>
                <li class="header"><?=l('LIST TOOLS')?></li>
                
                <!-- Start check expiration -->
                <?php if(check_expiration()  || IS_ADMIN == 1){?>


                <?php if(permission("post")){?>
                <li class="<?=(segment(1) == "post" || segment(2) == "post")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">send</i>
                        <span><?=l('Auto post')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "post")?"active":""?>">
                            <a href="<?=url('post')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "post")?"active":""?>">
                            <a href="<?=url('schedules/post')?>">
                                <span><?=l('Schedule post')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("post_wall_friends")){?>
                <li class="<?=(segment(1) == "post_wall_friends" || segment(2) == "friend")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">person_pin</i>
                        <span><?=l("Auto post to friend's wall")?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "post_wall_friends")?"active":""?>">
                            <a href="<?=url('post_wall_friends')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "friend")?"active":""?>">
                            <a href="<?=url('schedules/friend')?>">
                                <span><?=l('Schedule post')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("post_wall_friends")){?>
                <li class="<?=(segment(1) == "bulk_comment" || segment(2) == "bulk_comment")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-comments-o  fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l("Bulk comment a post")?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "bulk_comment")?"active":""?>">
                            <a href="<?=url('bulk_comment')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "bulk_comment")?"active":""?>">
                            <a href="<?=url('schedules/bulk_comment')?>">
                                <span><?=l('Schedule post')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("post_wall_friends")){?>
                <li class="<?=(segment(1) == "bulk_like" || segment(2) == "bulk_like")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-thumbs-o-up  fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l("Bulk like a post")?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "bulk_like")?"active":""?>">
                            <a href="<?=url('bulk_like')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "bulk_like")?"active":""?>">
                            <a href="<?=url('schedules/bulk_like')?>">
                                <span><?=l('Schedule post')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("repost_pages")){?>
                <li class="<?=(segment(1) == "repost_pages" || segment(2) == "repost_pages" || segment(2) == "replace")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">find_replace</i>
                        <span><?=l('Auto repost pages')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "repost_pages" && segment(2) == "")?"active":""?>">
                            <a href="<?=url('repost_pages')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "replace")?"active":""?>">
                            <a href="<?=url('repost_pages/replace')?>">
                                <span><?=l('Repalce text')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "repost_pages")?"active":""?>">
                            <a href="<?=url('schedules/repost_pages')?>">
                                <span><?=l('Schedule repost pages')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("join_groups")){?>
                <li class="<?=(segment(1) == "join_groups" || segment(2) == "join")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">group_add</i>
                        <span><?=l('Auto join groups')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "join_groups")?"active":""?>">
                            <a href="<?=url('join_groups')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "join")?"active":""?>">
                            <a href="<?=url('schedules/join')?>">
                                <span><?=l('Schedule join group')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("add_friends")){?>
                <li class="<?=(segment(1) == "add_friends" || segment(2) == "add_friends")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">account_circle</i>
                        <span><?=l('Auto add friends')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "add_friends")?"active":""?>">
                            <a href="<?=url('add_friends')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "add_friends")?"active":""?>">
                            <a href="<?=url('schedules/add_friends')?>">
                                <span><?=l('Schedule add friends')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("unfriends")){?>
                <li class="<?=(segment(1) == "unfriends" || segment(2) == "unfriends")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-user-times fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Auto unfriends')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "unfriends")?"active":""?>">
                            <a href="<?=url('unfriends')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "unfriends")?"active":""?>">
                            <a href="<?=url('schedules/unfriends')?>">
                                <span><?=l('Schedule unfriends')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("invite_to_groups")){?>
                <li class="<?=(segment(1) == "invite_to_groups" || segment(2) == "invite_to_groups")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-ticket fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Auto invite to groups')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "invite_to_groups")?"active":""?>">
                            <a href="<?=url('invite_to_groups')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "invite_to_groups")?"active":""?>">
                            <a href="<?=url('schedules/invite_to_groups')?>">
                                <span><?=l('Schedule invite to groups')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("invite_to_pages")){?>
                <li class="<?=(segment(1) == "invite_to_pages" || segment(2) == "invite_to_pages")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-flag-o fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Auto invite to like page')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "invite_to_pages")?"active":""?>">
                            <a href="<?=url('invite_to_pages')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "invite_to_pages")?"active":""?>">
                            <a href="<?=url('schedules/invite_to_pages')?>">
                                <span><?=l('Schedule invite to like page')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("accept_friend_request")){?>
                <li class="<?=(segment(1) == "accept_friend_request" || segment(2) == "accept_friend_request")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">offline_pin</i>
                        <span><?=l('Auto accept friend request')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "accept_friend_request")?"active":""?>">
                            <a href="<?=url('accept_friend_request')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "accept_friend_request")?"active":""?>">
                            <a href="<?=url('schedules/accept_friend_request')?>">
                                <span><?=l('Schedule accept friend request')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>


                <?php if(permission("comment")){?>
                <li class="<?=(segment(1) == "comment" || segment(2) == "comment")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">message</i>
                        <span><?=l('Auto comment')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "comment")?"active":""?>">
                            <a href="<?=url('comment')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "comment")?"active":""?>">
                            <a href="<?=url('schedules/comment')?>">
                                <span><?=l('Schedule comment')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("like")){?>
                <li class="<?=(segment(1) == "like" || segment(2) == "like")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="material-icons">thumb_up</i>
                        <span><?=l('Auto like')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "like")?"active":""?>">
                            <a href="<?=url('like')?>">
                                <span><?=l('Add new')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(2) == "like")?"active":""?>">
                            <a href="<?=url('schedules/like')?>">
                                <span><?=l('Schedule like')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php }?>
                <?php if(permission("search")){?>
                <li class="<?=(segment(1) == "search")?"active":""?>">
                    <a href="<?=url('search')?>">
                        <i class="material-icons">search</i>
                        <span><?=l('Facebook search')?></span>
                    </a>
                </li>
                <?php }?>
                <?php if(permission("analytics")){?>
                <li class="<?=(segment(1) == "analytics")?"active":""?>">
                    <a href="<?=url('analytics')?>">
                        <i class="material-icons">bubble_chart</i>
                        <span><?=l('Analytics page')?></span>
                    </a>
                </li>
                <?php }?> 

                <?php }?>
                <!-- End check expiration -->
                <?php if(permission("", true)){?>
                <li class="header"><?=l('ADMIN AREA')?></li>
                <?php if(!hashcheck()){?>
                <li class="<?=(segment(1) == "package_settings" || segment(1) == "payment_settings" || segment(1) == "payment_history")?"active":""?>">
                    <a href="javascript:void(0);" class="menu-toggle">
                        <i class="fa fa-cc-paypal fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Payment management')?></span>
                    </a>
                    <ul class="ml-menu">
                        <li class="<?=(segment(1) == "package_settings")?"active":""?>">
                            <a href="<?=url('package_settings')?>">
                                <span><?=l('Package settings')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(1) == "payment_settings")?"active":""?>">
                            <a href="<?=url('payment_settings')?>">
                                <span><?=l('Payment settings')?></span>
                            </a>
                        </li>
                        <li class="<?=(segment(1) == "payment_history")?"active":""?>">
                            <a href="<?=url('payment_history')?>">
                                <span><?=l('Payment history')?></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="<?=(segment(1) == "coupon")?"active":""?>">
                    <a href="<?=url('coupon')?>">
                        <i class="fa fa-ticket fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Coupon management')?></span>
                    </a>
                </li>
                <?php }else{?>
                <li class="<?=(segment(1) == "package_settings")?"active":""?>">
                    <a href="<?=url('package_settings')?>">
                        <i class="fa fa-credit-card fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Package settings')?></span>
                    </a>
                </li>
                <?php }?>
                <li class="<?=(segment(1) == "user_management")?"active":""?>">
                    <a href="<?=url('user_management')?>">
                        <i class="fa fa-user fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('User management')?></span>
                    </a>
                </li>
                <li class="<?=(segment(1) == "settings")?"active":""?>">
                    <a href="<?=url('settings')?>">
                        <i class="fa fa-cogs fix-iconfa-sidebar" aria-hidden="true"></i>
                        <span><?=l('Settings')?></span>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2017 <a href="javascript:void(0);"><?=l('VT Creators Team')?></a> Ver1.5.
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
</section>
