<br>
<br>
	<center>
		<p>
			<font size="-1" class="grey-text">
				Version <?=$hcm_version_no . " - " . $hcm_version_release . " (" . $_SESSION['account_type'] . ")"?>
				<br><?=$hcm_version_date?>
				<?php
				if($desktop == True){
					echo "<br>HCM For Windows Version: $hcm_windows_version_user";
				}
				?>
			</font>
		</p>
	</center>
<br>
<br>