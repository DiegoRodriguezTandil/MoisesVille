<?php
    use yii\helpers\Html;
    use yii\helpers\Url;
?>
<?php
    $js = <<<JS
    
     //Funcion de envio de mensajes a usurios
        function sendSuccessMessage(mensaje){
            var n = noty({
                text: mensaje,
                type: 'success',
                class: 'animated pulse',
                layout: 'topRight',
                theme: 'relax',
                timeout: 3000, // delay for closing event. Set false for sticky notifications
                force: false, // adds notification to the beginning of queue when set to true
                modal: false, // si pongo true me hace el efecto de pantalla gris
                killer : true,
            });
        }
        
        function sendErrorMessage(mensaje){
            var n = noty({
                text: mensaje,
                type: 'error',
                class: 'animated pulse',
                layout: 'topRight',
                theme: 'relax',
                timeout: 3000, // delay for closing event. Set false for sticky notifications
                force: false, // adds notification to the beginning of queue when set to true
                modal: false, // si pongo true me hace el efecto de pantalla gris
                killer : true,
            });
        }
        
        $('#addCat').click(function() {
            var url = $('#urlAddCat').attr('url');
            var nombreCat = $('#ncat').val();
            url += '&nombreCategoria='+ nombreCat;
            $.get(url,function(data) {
                if (data.result){
                    sendSuccessMessage(data.mensaje);
                    $(function () {
                       $('#modalCat').modal('toggle');
                    });
                    $.pjax.reload({container:"#allCategorias"});
                }else{
                    sendErrorMessage(data.mensaje);
                }
            })
        })
JS;

    $this->registerJs($js);

    
?>
<input type="hidden" id="urlAddCat" url="<?php echo Url::to(['datos-genealogicos/agregar-cat'])?>">
<form id="formNuevaCat">
    <div class="row">
        <div class="col-xs-1">
        
        </div>
        <div  class="form-group col-xs-9">
            
            <div>
                <input id="ncat" type="text" name="categoria" class="form-control" placeholder="Ingrese nueva categoria">
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-6">
        
        </div>
        <div class="col-xs-5">
            <div class="pull-right">
                <button id="addCat" type="button" class="btn btn-default">Agregar Categoria</button>
            </div>
        </div>
    </div>
</form>
