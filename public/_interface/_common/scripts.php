	/* Load Notification in Modal */
	function notif(){
		// Show Ajax Loader
		$("#notificationContent").html(loadingCircle);
		// Start Ajax
		$.ajax({
			type: 'GET',
			url: '_contents/common/notification.php',
			success: function(result){
				// Show fetched content in Modal
				$("#notificationContent").html(result);
				// Slowly fade-in content
				$("#notificationContent").fadeIn(500);
			}
		}).fail(function(){
			// Show an Error if Fail
			$("#notificationContent").html(error);
			// Slowly fade-in content
			$("#notificationContent").fadeIn(500);
		});
	}

	/* Delete All Notification */
	function deleteAllNotification(){
	// Start AJAX
	$.ajax({
		type:'POST',
		url: "action/account/delete_notification_all.php",
		data: {
			content: 'none'
		},
		cache: false,
		success: function(result){
			// If result returns ok
			if(result=="ok"){
				// Refresh notif
				notif();
				// Set Page Title
				setTitle();
			} else {
				// Show an Error to user if Fail Clearing Notifs
				Materialize.toast("Error clearing notifications");
			}
		}
		}).fail(function(){
			// Show an Error if Failed to Pass Through
			Materialize.toast("Error clearing notifications");
		});
	}

	/* Set Page Title */
	function setTitle(){
		// Set Site Title
		var siteTitle = "<?=$site_title?>";
		// Start AJAX
		$.ajax({
			type: 'POST',
			url: 'action/account/notification_count.php',
			cache: false,
			data: {
				user_id: '<?=$user_id?>'
			},
			success: function(result){
				// Hold result as notifCount
				var notifCount = result;
				// Check if Notif Count is empty
				if(!notifCount || notifCount==0){
				// Set Title to be used
				var title = siteTitle;
				// Set Empty Notification Icon
				$("#notificon").html("notifications_none");
				} else {
					// Check if Returned Result is not a Number
					if(isNaN(notifCount)){
						// Set Title to be Used
						var title = siteTitle;
					} else {
						// Construct and Set title
						var title = "(" + notifCount + ") " + siteTitle;
					}
					// Set Notification Icon
					$("#notificon").html("notifications");
				}
				// Set Page Title
				$(document).prop("title", title);
			}
		}).fail(function(){
			// Set Initial Title as Page Title
			$(document).prop("title", siteTitle);
			// Set Paused Notification Title
			$("#notificon").html("notifications_paused");
			// Log the Error to Client Browser for Reference
			console.error('Error fetching notification count');
			});		
	}
