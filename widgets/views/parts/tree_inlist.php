<?php
use yii\helpers\Html;
use common\models\User;

?>
<div class="row" data-key="<?=$category[$widget->idCardField]?>">
	<div class="col-lg-6 col-xs-6">
		∟ <input type="hidden" name="ids[]" value="<?=$category[$widget->idCardField];?>" />
        <?=$category[$widget->idCardField];?>.
		<?php if($category['childs']) { ?>
			<b><?=Html::a($category['user_last_name'].' '.$category['user_first_name'].' '.$category['user_middle_name'], '#', ['title' => 'Показать\скрыть подкатегории', 'class' => 'pistol88-tree-toggle']);?></b>
		<?php } else { ?>
			<?=$category['user_last_name'].' '.$category['user_first_name'].' '.$category['user_middle_name']?>
		<?php } ?>
	</div>
    <?php if (!Yii::$app->user->isGuest && (User::isUserAdmin(Yii::$app->user->identity->email)) && Yii::getAlias('@web') == "/admin") { ?>
	<div class="col-lg-6 col-xs-6 pistol88-tree-right-col">
		<div class="buttons">
            <?php if($widget->viewUrl) { ?>
                <?php if($widget->viewUrlToSearch) { ?> 
                    <?=Html::a('<span class="glyphicon glyphicon-eye-open">', [$widget->viewUrl, 'id' => $category[$widget->idCardField]], ['class' => 'btn btn-info btn-xs', 'title' => 'Смотреть']);?>
                <?php } else { ?>
                    <?=Html::a('<span class="glyphicon glyphicon-eye-open">', [$widget->viewUrl, 'id' => $category[$widget->idCardField]], ['class' => 'btn btn-info btn-xs', 'title' => 'Смотреть']);?>
                <?php } ?>
            <?php } ?>
            <?php if($widget->updateUrl) { ?>
                <?=Html::a('<span class="glyphicon glyphicon-pencil">', [$widget->updateUrl, 'id' => $category[$widget->idCardField]], ['class' => 'btn btn-warning btn-xs', 'title' => 'Редактировать']);?>
            <?php } ?>
            <?php if($widget->deleteUrl) { ?>
                <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
                <?=Html::a('<span class="glyphicon glyphicon-trash">', [$widget->deleteUrl, 'id' => $category[$widget->idCardField]], ['class' => 'btn btn-danger btn-xs', 'title' => 'Удалить', 'data' => [ 
                        'confirm' => 'Вы уверены что хотите удалить пользователя?', 
                        'method' => 'post', 
                    ]]); ?>
            <?php } ?>
        </div>
	</div>
    <?php } ?>
</div>
