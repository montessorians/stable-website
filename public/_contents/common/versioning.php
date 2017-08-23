<br>
<br>
	<center>
		<p>
			<font size="-1" class="grey-text">
				Version <?=$hcm_version_no . " - " . $hcm_version_release . " (" . $_SESSION['account_type'] . ")"?>
				<br><a onclick="alert('Your Device Info:\n<?=$ua?>');" class="grey-text" href="#ua"><?=$hcm_version_date?></a>
			</font>
		</p>
	</center>
<br>
<br>

<div class="modal modal-fixed-footer" id="profilepic">
	<div class="modal-content">
		<h5 class="grey-text">Profile Picture</h5>
		<?php
		if(isset($photo_url)) echo "<br><img src='../../$photo_url' id='profilepic' width='40%'>";
		?>
		<br>
		<form method="post" enctype="multipart/form-data">
			<div class="file-field input-field">
				<div class="btn btn-small <?=$accent_color?>">
					<span>Image</span>
					<input type="file" id="fileToUpload" name="fileToUpload">
				</div>
				<div class="file-path-wrapper">
					<input class="file-path validate" type="text">
				</div>
			</div>
			<p class="grey-text">Must be in .jpg or .png file. Must be proper and should show your face clearly.</p>
			<br>
			<button class="btn btn-large <?=$primary_color?> waves-effect">Upload</button>
		</form>
	</div>
	<div class="modal-footer">
		<a class='modal-action modal-close waves-effect waves-red btn-flat'>Close</a>
	</div>
</div>