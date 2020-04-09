<?php

$urlBackend = Yii::app()->createUrl('backend/index');

$myBackendScript = <<<JS

	var urlBackend = '{$urlBackend}';

	$(function(){
  	backend = {
    	checkConsegne: function()
		{
	        $.ajax({
				url:urlBackend,
				type: "GET",
	          	dataType: 'json',
	          	success: function(response) {
					var a = parseInt($('#noti-consegnati').html());
					var b = parseInt($('#noti-inconsegna').html());
					var c = parseInt($('#noti-incarico').html());
					if ( a != response.consegnati
						|| b != response.inconsegna
						|| c != response.incarico)
					{
						backend.handleResponse(response);
					}
	            		setTimeout(function(){ backend.checkConsegne() }, 60000);
				},
	    		error: function(data) {
	            	setTimeout(function(){ backend.checkConsegne() }, 60000);
	    		}
			});
      	},
    	handleResponse: function(response)
		{
			backend.animateNumbers(response.consegnati,'noti-consegnati');
			backend.animateNumbers(response.inconsegna,'noti-inconsegna');
			backend.animateNumbers(response.incarico,'noti-incarico');
			backend.animateNumbers(response.adulti,'noti-adulti');
			backend.animateNumbers(response.bambini,'noti-bambini');
      	},
			// Animate the element's value from 0 to Value:
			animateNumbers: function(value, id){
				jQuery({someValue: 0}).animate({someValue: value}, {
    			duration: 2500,
    			easing:'swing', // can be anything
    			step: function() { // called on every step
        		// Update the element's text with rounded-up value:
        		$('#'+id).text(Math.ceil(this.someValue) );
    			}
				});
			}
		}
    	//funzioni da richiamare all'avvio
    	setTimeout(function(){ backend.checkConsegne() }, 1500);
  });


JS;
Yii::app()->clientScript->registerScript('myBackendScript', $myBackendScript, CClientScript::POS_HEAD);
?>
