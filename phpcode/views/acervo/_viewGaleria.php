<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
?>  
<div style="float:left;">
<?php //$model->path;

echo Html::img("@web/uploads/" .$model->path, ['width'=>'192', 'height' => "200"]);
?> 
</div>


