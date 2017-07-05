<style>
	.modal-content-edit{
		padding:0px !important;
		position:absolute;
		height:calc(100% - 56px);
		max-height:100%;
		width:100%;
		overflow-y:auto;
	}
	.modal-text {
		padding-left: 30px;
		padding-top: 10px;
		padding-bottom: 10px;
	}
</style>
  <div class="modal modal-fixed-footer" id="notifications">
  		<div class="modal-content-edit">
  			<h5 class="modal-text grey-text"><strong>Notifications</strong></h5>
  			<div id="notificationContent"></div>
  		</div>
  		<div class="modal-footer">
  			<a class="modal-action modal-close waves-effect waves-green btn-flat">
  				Close
  			</a>
			<a class="waves-effect waves-red btn-flat" id="clearNotif">
  				Clear All
  			</a>
  		</div>
  </div>