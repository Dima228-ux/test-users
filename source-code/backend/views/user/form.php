<?php
/**
 * @var yii\web\View $this
 * @var UserForm $user
 */

use common\models\Role;
use common\models\User;
use common\models\UserForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(
    [
        'id' => 'user-form',
        'validateOnChange' => false,
        'validateOnBlur' => false,
        'enableClientValidation' => false,
        'options' => [
            'enctype' => 'multipart/form-data',
        ],
    ]
);

?>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.css">
<link rel="stylesheet" href="../css/style.css">


<body class="bg-body-tertiary">

<div class="container">
    <main>
        <div class="row">
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="form-group">
                        <?= Html::a('Back', ['/user/'], ['class' => 'btn btn-mini btn-default']) ?>
                        <?= Html::submitButton('Save', ['class' => 'btn btn-mini btn-success']) ?>
                    </div>
                </div>
            </div>

            <div class="row g-5">

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">
                        <ya-tr-span data-index="13-0" data-translated="true" data-source-lang="en" data-target-lang="ru"
                                    data-value="Billing address" data-translation="Users" data-ch="0"
                                    data-type="trSpan">
                            User
                        </ya-tr-span>
                    </h4>
                    <form class="needs-validation" novalidate="">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <?= $form->field($user, 'username')->textInput() ?>
                            </div>

                            <div class="col-sm-6">
                                <?= $form->field($user, 'roles')->dropDownList(
                                    Role::getRoles(),
                                    [
                                        'name' => 'roles',
                                        'prompt' => '',
                                        'class' => 'label ui selection fluid dropdown',
                                        'data-placeholder' => 'Select roles',
                                        'multiple' => true
                                    ]
                                ) ?>

                            </div>

                            <div class="col-12">
                                <?= $form->field($user, 'email')->textInput() ?>
                            </div>

                            <div class="col-12">
                                <?= $form->field($user, 'password')->passwordInput() ?>
                                <?= $form->field($user, 'type')->dropDownList(
                                    User::getTypeUsers(),
                                    [
                                        'name' => 'type',
                                        'prompt' => '',
                                        'class' => 'label ui selection fluid dropdown',
                                        'data-placeholder' => 'Select type user',
                                        'multiple' => false
                                    ]
                                ) ?>
                            </div>

                        </div>
                </div>
    </main>
    <?php
    ActiveForm::end(); ?>

    <script src="../assets/6fd0911b/jquery.min.js"></script>
    <script src="../js/popper.js"></script>
    <script src="../assets/9e5b7dbe/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js"></script>
    <script src="../js/main.js"></script>