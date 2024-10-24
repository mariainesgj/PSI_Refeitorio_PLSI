<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent">
        <h4 >Bem vindo, <?= Yii::$app->user->identity->username ?>!</h4>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-lg-4 text-center">
                <div class="card" style="border-radius: 10px; background-color: #E9FCFF; border: 1px solid #E9FCFF;">
                    <div class="card-body">
                        <div class="row mb-3 align-items-center">
                            <div class="col-6 text-left">
                                <p class="card-text"><strong>Refeições não servidas</strong></p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="rounded bg-white text-black d-flex align-items-center justify-content-center mx-auto" style="width: 2vw; height: 5vh; border: 1.5px solid #E9FCFF;">
                                    <p class="mb-0">30</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-6 text-left">
                                <p class="card-text"><strong>Refeições servidas</strong></p>
                            </div>
                            <div class="col-6 text-center">
                                <div class="rounded bg-white text-black d-flex align-items-center justify-content-center mx-auto" style="width: 2vw; height: 5vh; border: 1.5px solid #E9FCFF;">
                                    <p class="mb-0">2</p>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3 align-items-center">
                            <div class="col-6">
                                <img src="<?= Yii::getAlias('@web/images/principal.png') ?>" alt="Imagem" class="img-fluid" style="width: 2.5vw;">
                            </div>
                            <div class="col-6">
                                <p class="card-text" style="color: #2B7BFF"><strong>Menu Principal</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="card text-center" style="border-radius: 10px; background-color: #D9FBE7; border: 1px solid #D9FBE7;">
                    <div class="card-body">
                        <h5 class="card-title">Heading 2</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        <a href="https://www.yiiframework.com/forum/" class="btn btn-outline-secondary">Yii Forum &raquo;</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card text-center" style="border-radius: 10px; background-color: #F6F6F6; border: 1px solid #F6F6F6;">
                    <div class="card-body">
                        <h5 class="card-title">Heading 3</h5>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        <a href="https://www.yiiframework.com/extensions/" class="btn btn-outline-secondary">Yii Extensions &raquo;</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
