/* 
 * Requires jquery 1.9.1
 */
function MessageService(alertType, alertText) {
	this.alertText = alertText;
	this.alertType = alertType;
	this.displayTime = 2000;
	
	if (this.alertType == 'success') {
		$('#message_service').addClass('message_success');
	} else {
		$('#message_service').addClass('message_error');
	}
	
	this.showMessage = function() {
		//alert(this.alertText);
		$('#message_service').text(this.alertText);
		$('#message_service').show();
		
		if(this.displayTime > 0) {
			$('#message_service').delay(this.displayTime).fadeOut(2000);
		}
		
	};
	
	this.hide = function() {};
	
	
}