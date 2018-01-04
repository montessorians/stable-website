<div class="modal modal-fixed-footer" id="apps">
	<div class="modal-content">
		<h5 class="grey-text"><strong>Apps</strong></h5>
		<div class="row" id="appsRow"></div>
	</div>
	<div class="modal-footer">
		<a class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
	</div>
</div>
<script type="text/javascript">
appsList = [
	{
		"title":"Peace One Day", "url":"http://peaceoneday.org",
		"color":"teal", "icon":"favorite",
	},
	{
		"title":"Online School", "url":"https://holychildmontessori.edu20.org",
		"color":"green", "icon":"school",
	},
	{
		"title":"Cloud Locker","url":"https://holychildmontessori.edu20.org/locker/list",
		"color":"teal","icon":"cloud",
	},
	{
		"title":"Messages","url":"https://holychildmontessori.edu20.org/inbox",
		"color":"indigo","icon":"message",
	}	
];

function appsCardGenerator(title,url,color,icon){
	var cardgen = `
		<div class="col s6">
			<a href="${url}" class="browser-default">
				<div class="card ${color}">
					<div class="card-content">
						<center class="white-text"><i class="medium material-icons">${icon}</i><br>${title}</center>
					</div>
				</div>
			</a>
		</div>
	`;
	return cardgen;
}

$.each(appsList,(index,data)=>{
	var title = data['title'];
	var url = data['url'];
	var color = data['color'];
	var icon = data['icon'];
	cardgen = appsCardGenerator(title,url,color,icon);
	$("#appsRow").append(cardgen);
});
</script>