<?php
	include("../_include/setup.php");
	$photo_url = $db_account->get("photo_url", "user_id", "$user_id");
	$first_name = $db_admin->get("first_name", "admin_id", "$admin_id");
	$last_name = $db_admin->get("last_name", "admin_id", "$admin_id");
	$suffix_name = $db_admin->get("suffix_name", "admin_id", "$admin_id");
	$name = $first_name . " " . $last_name . " " . $suffix_name;
?>
<style>
	.collection-title{
		font-size:12pt;
		padding-top:20px;
	}
	i.circle{
		margin-top: 10px;
	}
	.user-name{
		font-size:15pt;
		padding-top:6px;
	}
</style>
<ul class="collection">
	<li class="collection-item avatar">
		<?php
			if(empty($photo_url)){
				echo "<i class=\"material-icons circle red\">person</i>";
			}else{
				echo "<a href='#profilepic'><img src='../../$photo_url' class='circle'></a>";
			}
		?>
		<p class="user-name"><?=$name?></p>
		<p class="grey-text">
			<a href="settings/account" class="grey-text">
				@<?=$username?> <i class="material-icons tiny">edit</i><br>
			</a>
			<?=$admin_id?>
		</p>
	</li>
	<li class="collection-item avatar">
		<a href="profile/?admin_id=<?=$admin_id?>" class="black-text">
			<i class="material-icons circle red">person</i>
			<p class="collection-title grey-text text-darken-2">My Profile</p>
		</a>
	</li>
	<?php
		include("../common/me_public.php");
	?>
</ul>
<?php
	include("../common/versioning.php");
?>
  <script type="text/javascript">
	$('.modal').modal();
  </script>
