<br>
<br>
	<center>
		<p>
			<font size="-1" class="grey-text">
				Version <?=$hcm_version_no . " - " . $hcm_version_release . " (" . $_SESSION['account_type'] . ")"?>
				<br><a onclick="alert('Your Device Info:\n<?=$ua?>');" class="seagreen-text" href="#ua"><?=$hcm_version_date?></a>
			</font>
		</p>
	</center>
<br>
<br>

<div class="modal modal-fixed-footer" id="profilepic">
	<div class="modal-content">
		<h5 class="grey-text">Profile Picture</h5>
		<?php
		if(isset($photo_url)){ echo "<br><img src='../../$photo_url' id='profilepic' width='40%'>";}
		?>
	</div>
	<div class="modal-footer">
		<a class='modal-action modal-close waves-effect waves-red btn-flat'>Close</a>
	</div>
</div>