<div class="pricing-table">
	<div class="title"><?=l('PICK THE BEST PLAN FOR YOU!')?></div>
	<?php if(!empty($package)){?>

	<?php foreach ($package as $row) {
		$price = explode(".", $row->price);
		$permission = json_decode($row->permission);
	?>
	<div class="whole">
		<div class="type">
			<p><?=$row->name?></p>
			</div>
		<div class="plan">
			<div class="header">
				<span>$</span><?=$price[0]?><sup><?=(isset($price[1])?$price[1]:"00")?></sup>
				<p class="month">/<?=$row->day?> <?=l('days')?></p>
			</div>
			<div class="content">
				<ul>
					<li class="bg-light-green"><?=$permission->maximum_account?> <?=l('Facebook Accounts')?></li>
					<li><?=$permission->maximum_groups?> <?=l('Groups')?></li>
					<li><?=$permission->maximum_pages?> <?=l('Pages')?></li>
					<li><?=$permission->maximum_friends?> <?=l('Friends')?></li>
					<li><?=l('Auto post')?> <?=permission_list($row->permission, 'post')?></li>
					<li><?=l("Auto post to friend's wall")?> <?=permission_list($row->permission, 'post_wall_friends')?></li>
					<li><?=l("Bulk comment a post")?> <?=permission_list($row->permission, 'bulk_comment')?></li>
					<li><?=l("Bulk like a post")?> <?=permission_list($row->permission, 'bulk_like')?></li>
					<li><?=l("Auto repost pages")?> <?=permission_list($row->permission, 'repost_pages')?></li>
					<li><?=l("Auto join groups")?> <?=permission_list($row->permission, 'join_groups')?></li>
					<li><?=l("Auto add friends")?> <?=permission_list($row->permission, 'add_friends')?></li>
					<li><?=l("Auto unfriends")?> <?=permission_list($row->permission, 'unfriends')?></li>
					<li><?=l("Auto invite to groups")?> <?=permission_list($row->permission, 'invite_to_groups')?></li>
					<li><?=l("Auto invite to like page")?> <?=permission_list($row->permission, 'invite_to_pages')?></li>
					<li><?=l("Auto accept friend request")?> <?=permission_list($row->permission, 'accept_friend_request')?></li>
					<li><?=l("Auto comment")?> <?=permission_list($row->permission, 'comment')?></li>
					<li><?=l("Auto like")?> <?=permission_list($row->permission, 'like')?></li>
					<li><?=l("Facebook search")?> <?=permission_list($row->permission, 'search')?></li>
					<li><?=l("Fanpage analytics")?> <?=permission_list($row->permission, 'analytics')?></li>
				</ul>

			</div>
			<div class="price">
				<?php if(session("uid")){?>
	      			<a href="<?=cn("type?package=".$row->id)?>" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('UPGRADE NOW')?></a>
				<?php }else{?>
					<a href="javascript:void(0);" data-toggle="modal" data-target="#loginModal" class="btn btn-block bg-light-green btn-lg waves-effect"><?=l('UPGRADE NOW')?></a>
	      		<?php }?>
			</div>
		</div>
	</div>
	<?php }?>

	<?php }?>
</div>
<?=modules::run("blocks/footer")?>
