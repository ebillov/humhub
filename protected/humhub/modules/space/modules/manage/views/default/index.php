<?php

use humhub\modules\content\widgets\ContainerTagPicker;
use humhub\modules\content\widgets\richtext\RichTextField;
use humhub\modules\space\models\Space;
use humhub\modules\space\modules\manage\widgets\DefaultMenu;
use humhub\modules\space\widgets\SpaceNameColorInput;
use humhub\modules\ui\form\widgets\ActiveForm;
use humhub\widgets\Button;

/* @var $this \humhub\modules\ui\view\components\View
 * @var $model \humhub\modules\space\models\Space
 */

?>

<div class="panel panel-default">
    <div>
        <div class="panel-heading">
            <?= Yii::t('SpaceModule.manage', '<strong>Space</strong> settings'); ?>
        </div>
    </div>

    <?= DefaultMenu::widget(['space' => $model]); ?>

    <div class="panel-body">

        <?php $form = ActiveForm::begin(['options' => ['id' => 'spaceIndexForm'], 'enableClientValidation' => false, 'acknowledge' => true]); ?>

        <?= SpaceNameColorInput::widget(['form' => $form, 'model' => $model]) ?>
        <?= $form->field($model, 'description')->textInput(['maxlength' => 100]); ?>
        <?= $form->field($model, 'about')->widget(RichTextField::class); ?>
        <?= $form->field($model, 'tagsField')->widget(ContainerTagPicker::class); ?>

        <?= Button::save()->submit() ?>

        <div class="pull-right">
            <?= Button::warning(Yii::t('SpaceModule.manage', 'Archive'))
                ->action('space.archive', $model->createUrl('/space/manage/default/archive'))
                ->cssClass('archive')->style(($model->status == Space::STATUS_ENABLED) ? 'display:inline' : 'display:none') ?>

            <?= Button::warning(Yii::t('SpaceModule.manage', 'Unarchive'))
                ->action('space.unarchive', $model->createUrl('/space/manage/default/unarchive'))
                ->cssClass('unarchive')->style(($model->status == Space::STATUS_ARCHIVED) ? 'display:inline' : 'display:none') ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

</div>
