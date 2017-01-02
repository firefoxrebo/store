/**
 * Header JavaScript Document
 */

(function() {
	$('a.notification').bind('click', function(evt) {
		evt.preventDefault();
		evt.stopPropagation();
                function hideNotificationPanel() {
			$('.notificationList').hide();
		}
		var notificationPanel = $(this).next();
                hideNotificationPanel();
		notificationPanel.toggle();
		notificationPanel.bind('click', function(e) {
			e.stopPropagation();
		});
		$('html').bind('click', function(evt) {
			hideNotificationPanel();
		});
	});
})();