<?php
/**
 * nuova gestione delle notifiche
 */

// // Conto il n. totale di messaggi da leggere
// $criteria=new CDbCriteria();
// $criteria->compare('id_user',Yii::app()->user->objUser['id_user'],false);
// $dataProvider=new CActiveDataProvider('Notifications_readers', array(
//     'criteria'=>$criteria,
// ));
// $countedNews = $dataProvider->totalItemCount;
//
// // Salvo il totale nei settings user
// Settings::saveUser(Yii::app()->user->objUser['id_user'],['unreadNews'=>$countedNews]);

$urlBackend = Yii::app()->createUrl('backend/notify');
$urlNewsRead = Yii::app()->createUrl('backend/updateNews');
$urlNewsReadAll = Yii::app()->createUrl('backend/updateAllNews');
$fileNotify = Yii::app()->request->baseUrl.'/css/sounds/notify.mp3';

$urlCheckInvoices = Yii::app()->createUrl('backend/checkInvoices');

$myBackendScript = <<<JS

	var urlBackend = '{$urlBackend}';
    var urlNewsRead = '{$urlNewsRead}';
	var urlNewsReadAll = '{$urlNewsReadAll}';
    var urlSound = '{$fileNotify}';
		var urlCheckInvoices = '{$urlCheckInvoices}';

		var nomeMese = ["GEN", "FEB", "MAR", "APR", "MAG","GIU","LUG", "AGO", "SET", "OTT", "NOV","DIC"];
		var giorno = ['DOM', 'LUN', 'MAR', 'MER', 'GIO', 'VEN', 'SAB'];

	$(function(){
        backend = {
            checkNotify: function()
			{
                $.ajax({
					url:urlBackend,
					type: "POST",
                    data: { 'countedNews' : $('#countedNews').val() },
                	dataType: 'json',
                    success: function(response) {
    					backend.handleResponse(response);

                        setTimeout(function(){ backend.checkNotify() }, 5000);
    				},
    				error: function(data) {
                        setTimeout(function(){ backend.checkNotify() }, 5000);
    				}
				});
            },

            handleResponse: function(response)
			{
                if (response.playSound == true){
        			backend.playSound();
                    //$('#countedNews').val(response.countedUnread);
                    //VERIFICO QUESTE ULTIME 3 TRANSAZIONI PER AGGIORNARE IN REAL-TIME LO STATO (IN CASO CI SI TROVA SULLA PAGINA TRANSACTIONS)
                    for (var key in response.status) {
                        var status = response.status[key];
                        //backend.updateTransactionRows(status,key);
                    }
                }

                $("#notifiche_dropdown").fadeIn(1000).css("display","");
                $('#quantity_notify').html(response.countedUnread);
        		$('#notifiche__contenuto').html(response.htmlTitle);
                $('#notifiche__contenuto').append(response.htmlContent);
                if (response.countedUnread > 0){
                    $("#quantity_circle").fadeIn(1000).css("display","");
            		$("#quantity_circle").css("background","#ff4b5a");
                }else{
                    $("#quantity_circle").fadeIn(1000).css("display","none");

                }

            },

            updateTransactionRows(item, index)
			{
                console.log('update transaction status id:',index, item);
                //TODO: verifica che l'id sia questo in wallet/index o token/index
                $( "#transactionstatus_"+index ).html(tokenStatus(item)).fadeIn(3000);
            },
						showTime: function(){
			                var cd = new Date;
			                var ora = zeroPadding(cd.getHours(), 2) + ':' + zeroPadding(cd.getMinutes(), 2) + ':' + zeroPadding(cd.getSeconds(), 2);
			                var data = giorno[cd.getDay()] + ' ' + zeroPadding(cd.getDate(), 2) + ' ' + nomeMese[cd.getMonth()] + ' ' + zeroPadding(cd.getFullYear(), 4);
							//$("#orologio").html("<p class='data'>"+data+"</p><p class='tempo'>"+ora+"</p>");
			                $("#orologio").html("<p class='data'>"+data+" "+ora+"</p>");
			                setTimeout(function(){ backend.showTime() }, 1000);//1 secondo
						},

            playSound: function(){
                navigator.vibrate = navigator.vibrate || navigator.webkitVibrate || navigator.mozVibrate || navigator.msVibrate;
                if (navigator.vibrate) {
                    navigator.vibrate(60);
                }
                $('embed').remove();
                $('body').append("<embed src='"+urlSound+"' autostart='true' hidden='true' loop='false'>");
            },
						checkInvoices: function(){
                $.ajax(urlCheckInvoices,
    			{
    				dataType: 'json',
    				success: function(json) {
                        console.log(json);
                        setTimeout(function(){ backend.checkInvoices() }, 600000);//10 minuti
    				},
    				error: function(j) {
                        setTimeout(function(){ backend.showTime() }, 600000);//10 minuti
    				}
    			});
            },
            openEnvelope: function(id_notification){
                event.preventDefault();
                event.stopPropagation();
                var submitUrl = $('#news_'+id_notification).attr('href');

                //console.log(['Backend: Open Envelope'],id_notification);
                //console.log(['Backend: submitUrl'],submitUrl);
                // metto a read il valore del messaggio
                $.ajax({
					url:urlNewsRead,
					type: "POST",
                    data: { 'id_notification' : id_notification },
                	dataType: 'json',
                    success: function(response) {
						if (response.success)
                        	location.href = submitUrl;
    				},
    				error: function(data) {
                        console.log(data);
    				}
				});
            },
			openAllEnvelopes: function(){
	            event.preventDefault();
	            event.stopPropagation();
	            var submitUrl = $('#seeAllMessages').attr('href');
	            $.ajax({
					url:urlNewsReadAll,
					type: "POST",
	                data: { },
	              	dataType: 'json',
	                success: function(response) {
						if (response.success)
	                        location.href = submitUrl;
	    			},
	    			error: function(data) {
	                    console.log(data);
	    			},
				});
			},
        }
    	//funzioni da richiamare all'avvio
        setTimeout(function(){ backend.checkNotify() }, 500);
				setTimeout(function(){ backend.showTime() }, 10);
        setTimeout(function(){ backend.checkInvoices() }, 5000);
    });

		function zeroPadding(num, digit) {
        var zero = '';
        for(var i = 0; i < digit; i++) {
            zero += '0';
        }
        return (zero + num).slice(-digit);
    }

JS;
Yii::app()->clientScript->registerScript('myBackendScript', $myBackendScript, CClientScript::POS_HEAD);
?>
