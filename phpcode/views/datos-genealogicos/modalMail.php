<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<?php
    $css = <<<CSS
    .switch {
      position: relative;
      display: inline-block;
      width: 30px;
      height: 16px;
    }
    
    /* Hide default HTML checkbox */
    .switch input {display:none;}
    
    /* The slider */
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    .slider:before {
      position: absolute;
      content: "";
      height: 13px;
      width: 13px;
      left: 2px;
      bottom: 2px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }
    
    input:checked + .slider {
      background-color: #2196F3;
    }
    
    input:focus + .slider {
      box-shadow: 0 0 1px #2196F3;
    }
    
    input:checked + .slider:before {
      -webkit-transform: translateX(13px);
      -ms-transform: translateX(13px);
      transform: translateX(13px);
    }
    
    /* Rounded sliders */
    .slider.round {
      border-radius: 16px;
    }
    
    .slider.round:before {
      border-radius: 50%;
    }

CSS;
    $Js = <<<JS
            
        $("#sendMail").on('click',function() {
            var fields = $( "#formMail :input" ).serializeArray();
            var ajaxurl = $('#urlSendMail').attr('url');
            var n = noty({
                            text: 'Aguarde, se esta enviando el mail',
                            type: 'info',
                            class: 'animated pulse',
                            layout: 'topRight',
                            theme: 'relax',
                            timeout: 8000, // delay for closing event. Set false for sticky notifications
                            force: true, // adds notification to the beginning of queue when set to true
                            modal: false, // si pongo true me hace el efecto de pantalla gris
                            killer : true,
            });
            $.post( ajaxurl , fields , function( data ) {
                if (data.result == 'ok'){
                    $(function () {
                       $('#modalMail').modal('toggle');
                    });
                    var n = noty({
                            text: data.mensaje,
                            type: 'success',
                            class: 'animated pulse',
                            layout: 'topRight',
                            theme: 'relax',
                            timeout: 7000, // delay for closing event. Set false for sticky notifications
                            force: false, // adds notification to the beginning of queue when set to true
                            modal: false, // si pongo true me hace el efecto de pantalla gris
                            killer : true,
                    });
                }else{
                    var n = noty({
                            text: data.mensaje,
                            type: 'error',
                            class: 'animated pulse',
                            layout: 'topRight',
                            theme: 'relax',
                            timeout: 7000, // delay for closing event. Set false for sticky notifications
                            force: false, // adds notification to the beginning of queue when set to true
                            modal: false, // si pongo true me hace el efecto de pantalla gris
                            killer : true,
                    });
                }
             });
        });
JS;
    $this->registerJs($Js);
    $this->registerCss($css);
    
?>
<input type="hidden" id="urlSendMail" url="<?php echo Url::to(['datos-genealogicos/send-mail'])?>">
<form id="formMail">
    <div class="row">
        <div class="col-xs-1">
        
        </div>
        <div  class="form-group col-xs-9">
            
                <div>
                    <input type="email" name="email" class="form-control" placeholder="Ingrese Mail">
                </div>
                <br>
                <div>
                    <input type="text" name="destinatario" class="form-control" placeholder="Nombre Destinatario">
                </div>
                <br>
                <div>
                    <textarea type="text" name="detail" rows="5" class="form-control" placeholder="Detalle"></textarea>
                </div>
                <div>
                    <br>
                    <label for="" style="margin-bottom: -3px;">Enviar Mail Completo</label>
                    <div>
                        <label class="switch">
                            <input type="checkbox" name="informe">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </div>
            
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-6">
        
        </div>
        <div class="col-xs-5">
            <div class="pull-right">
                <button id="sendMail" type="button" class="btn btn-default">Enviar Mail</button>
            </div>
        </div>
    </div>
</form>