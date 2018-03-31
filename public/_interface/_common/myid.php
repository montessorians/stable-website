<div class="modal modal-fixed-footer blue-grey" id="myid">
  		<div class="modal-content">
  			<center>
  				<a href="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=<?=$student_id?>" target="_blank" rel="noopener">
  					<img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=https://hcmontessori.000webhostapp.com/pay.php?student_id=<?=$student_id?>" class='responsive-img round'>
  				</a>
  				<p class="white-text">
  					<font size="4pt"><?=$student_id?></font><br>
  					<font size="-1"><?=$name?></font>
  				</p>
  				</center>
  		</div>
		<div class="modal-footer blue-grey lighten-2">
  			<a class="modal-action modal-close waves-effect waves-red btn-flat">
  				Close
  			</a>
  		</div>
  </div>
