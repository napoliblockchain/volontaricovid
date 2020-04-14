<?php

$urlCheckCF = Yii::app()->createUrl('consegne/checkCF');


$validateCF = <<<JS
function validateCF(cf) {
    if (cf.length == 16){
        $.ajax({
            url:'{$urlCheckCF}',
            type: "POST",
            data:{
        	    'codfisc': cf,
                'data': $('#Consegne_data').val(),
             },
            dataType: "json",
            success:function(data){
                $('#cf_alert').prev().hide();
                if (data.success == 2){
                    $('#cf_alert').show().html('<div class="alert alert-danger">Codice Fiscale non conforme.</div>');
                }else if (data.success == 1){
                  	$('#cf_alert').show().html('<div class="alert alert-danger">Codice Fiscale già presente nell\'ultima settimana.</div>');
                    $('#Consegne_trigger_alert').val(1);
                }else{
                    $('#cf_alert').show().html('<div class="alert alert-success">Codice Fiscale valido.</div>');
                    $('#Consegne_trigger_alert').val(0);
                }

        	},
            error: function(j){
        	      console.log(j);
            }
        });
    }
}

JS;
Yii::app()->clientScript->registerScript('validateCF', $validateCF, CClientScript::POS_END);
?>
