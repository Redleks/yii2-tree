<?php
use yii\helpers\Html;
use common\models\User;

?>
<div class="row" data-key="<?=$category[$widget->idField]?>">
    <div class="col-lg-6 col-xs-6">
        ∟ <input type="hidden" name="ids[]" value="<?=$category[$widget->idField];?>" />
        <?=$category[$widget->idField];?>.
        <?php if($category['childs']) { ?>
            <?=Html::a($category['user_last_name'].' '.$category['user_first_name'].' '.$category['user_middle_name'], '#', ['title' => 'Показать\скрыть подкатегории', 'class' => 'pistol88-tree-toggle']);?>
        <?php } else { ?>
            <strong><?=$category['user_last_name'].' '.$category['user_first_name'].' '.$category['user_middle_name']?></strong>
        <?php } ?>
    </div>
    <?php if (!Yii::$app->user->isGuest && (User::findByUsername(Yii::$app->user->identity->username)['role']) == 1) { ?>
    <div class="col-lg-6 col-xs-6 pistol88-tree-right-col">
        <div class="buttons">
            <?php if($widget->viewUrl) { ?>
                <?php if($widget->viewUrlToSearch) { ?> 
                    <?=Html::a('<span class="glyphicon glyphicon-eye-open">', [$widget->viewUrl, $widget->viewUrlModelName => [$widget->viewUrlModelField => $category[$widget->idField]]], ['class' => 'btn btn-default', 'title' => 'Смотреть']);?>
                <?php } else { ?>
                    <?=Html::a('<span class="glyphicon glyphicon-eye-open">', [$widget->viewUrl, 'id' => $category[$widget->idField]], ['class' => 'btn btn-default', 'title' => 'Смотреть']);?>
                <?php } ?>
            <?php } ?>
            <?php if($widget->updateUrl) { ?>
                <?=Html::a('<span class="glyphicon glyphicon-pencil">', [$widget->updateUrl, 'id' => $category[$widget->idField]], ['class' => 'btn btn-default', 'title' => 'Редактировать']);?>
            <?php } ?>
        </div>
    </div>
    <?php } ?>
</div>