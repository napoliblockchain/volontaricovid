<?php

$urlCheckAddress = Yii::app()->createUrl('consegne/checkAddress');


$validateAddress = <<<JS
  function selectAddress(via,quart,mun){
    $('#Consegne_indirizzo').val(via);
    $('#Consegne_quartiere').val(quart);
    $('#Consegne_municipalita').val(mun);
    $('#listaIndirizzi').modal('hide');
  }

  function validateAddress(e,address) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if(code == 13) { //Enter keycode
      e.preventDefault();

      if (address.length > 3){
        $.ajax({
          url:'{$urlCheckAddress}',
          type: "POST",
          data:{
            'address': address,
          },
          dataType: "json",
          success:function(data){
            length = data.list.length;
            if (data.success){
              $('#warningIndirizzo').hide().text("");
              var grid = document.getElementById('address-grid');
              $(grid).html('');
              
              var table = document.createElement('table');

              var head = document.createElement('thead');
              var tr0 = document.createElement('tr');
              var td1 = document.createElement('td');
              var td2 = document.createElement('td');
              var td3 = document.createElement('td');

              var text1 = document.createTextNode('Indirizzo');
              var text2 = document.createTextNode('Quart.');
              var text3 = document.createTextNode('Mun.');
              td1.appendChild(text1);
              td2.appendChild(text2);
              td3.appendChild(text3);
              tr0.appendChild(td1);
              tr0.appendChild(td2);
              tr0.appendChild(td3);

              head.appendChild(tr0);
              table.appendChild(head);
              $(head).addClass('alert-primary text-light')

              for (var i = 0; i < length; i++){
                var html = data.list[i];

                var tr = document.createElement('tr');

                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');

                var text1 = document.createTextNode(html.via);
                var text2 = document.createTextNode(html.quartiere);
                var text3 = document.createTextNode(html.municipalita);

                td1.appendChild(text1);
                td2.appendChild(text2);
                td3.appendChild(text3);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);

                table.appendChild(tr);

                if (i%2 == 0)
                $(tr).addClass('odd');
                else
                $(tr).addClass('even');

                $(tr).addClass('checkSelectedAddress alert-light');
                $(tr).attr('onclick','selectAddress("'+html.via+'","'+html.quartiere+'","'+html.municipalita+'")');
              }
              $(grid).append(table);
              $(table).addClass('items');

              $('#listaIndirizzi').modal();
            }else{
              $('#warningIndirizzo').show().text("Troppi indirizzi trovati ("+length+").");
            }



          },
          error: function(j){
            console.log(j);
          }
        });
      }
    }
	}

JS;
Yii::app()->clientScript->registerScript('validateAddress', $validateAddress, CClientScript::POS_END);
?>
