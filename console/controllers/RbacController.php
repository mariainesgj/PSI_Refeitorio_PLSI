<?php

namespace console\controllers;

use yii\console\Controller;

class RbacController extends Controller{

    public function actionInit(){

        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        $accessFrontend = $auth->createPermission('accessFrontend');
        $accessFrontend->description = 'Acesso ao frontend';
        $auth->add($accessFrontend);

        $accessBackend = $auth->createPermission('accessBackend');
        $accessBackend->description = 'Acesso ao backend';
        $auth->add($accessBackend);

        $viewUsers = $auth->createPermission('viewUsers');
        $viewUsers->description = 'Visualizar e listar utilizadores';
        $auth->add($viewUsers);

        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        $administrador = $auth->createRole('administrador');
        $auth->add($administrador);
        $aluno = $auth->createRole('aluno');
        $auth->add($aluno);
        $professor = $auth->createRole('professor');
        $auth->add($professor);


        echo 'Rbac and roles initialized.';
    }

}


/*
 * namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use app\models\Profile;
use app\models\User;

class ProfileController extends Controller
{
    public function actionCreate()
    {
        $model = new Profile();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            if ($model->isNewRecord) {
                $model->role = 'aluno';
            }

            $model->save();
            $auth = Yii::$app->authManager;
            $role = $auth->getRole($model->role);
            $auth->assign($role, Yii::$app->user->id);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}
*/