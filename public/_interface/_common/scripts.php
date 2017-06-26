	function notif(){
		$("#notificationContent").html(loadingCircle);
		$.ajax({
			type: 'GET',
			url: '_contents/common/notification.php',
			success: function(result){
				$("#notificationContent").html(result);
				$("#notificationContent").fadeIn(500);
			}
		}).fail(function(){
			$("#notificationContent").html(error);
			$("#notificationContent").fadeIn(500);
		});
	}

	function deleteAllNotification(){
	$.ajax({
		type:'POST',
		url: "action/account/delete_notification_all.php",
		data: {
			content: 'none'
		},
		cache: false,
		success: function(result){
			if(result=="ok"){
				notif();
				setTitle();
			} else {
				Materialize.toast("Error clearing notifications");
			}
		}
		}).fail(function(){
			Materialize.toast("Error clearing notifications");
		});
	}

	function setTitle(){
		var siteTitle = "<?=$site_title?>";
		$.ajax({
			type: 'POST',
			url: 'action/account/notification_count.php',
			cache: false,
			data: {
				user_id: '<?=$user_id?>'
			},
			success: function(result){
				var notifCount = result;
				if(!notifCount || notifCount==0){
				var title = siteTitle;
				$("#notificon").html("notifications_none");
				} else {
					var title = "(" + notifCount + ") " + siteTitle;
					$("#notificon").html("notifications");
				}
				$(document).prop("title", title);
			}
		}).fail(function(){
			$(document).prop("title", siteTitle);
			$("#notificon").html("notifications_paused");
			console.log('Error fetching notification count');
			});		
	}
