<?php
	session_start();
	include("../../_system/config.php");
	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$parent_id = $_SESSION['parent_id'];
	include("../../_system/database/db.php");
	$db_parent = new DBase("parent", "../../_store");
	$db_account = new DBase("account", "../../_store");
	$db_schooldata = new DBase("school_data", "../../_store");
	$photo_url = $db_account->get("photo_url", "user_id", "$user_id");
	$first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
	$last_name = $db_parent->get("last_name", "parent_id", "$parent_id");
	$suffix_name = $db_parent->get("suffix_name", "parent_id", "$parent_id");
	$name = $first_name . " " . $last_name . " " . $suffix_name;
	$current_sy = $db_schooldata->get("school_year", "school_id", "1");
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
				echo "<img src='../../$photo_url' class='circle'>";
			}
		?>
		<p class="user-name"><?=$name?></p>
		<p class="grey-text">
			<a href="settings/account" class="grey-text">
				@<?=$username?> <i class="material-icons tiny">edit</i><br>
			</a>
			<?=$parent_id?>
		</p>
	</li>
	<li class="collection-item avatar">
		<a href="profile/?parent_id=<?=$parent_id?>" class="black-text">
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