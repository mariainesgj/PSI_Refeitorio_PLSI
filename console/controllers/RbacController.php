<?php

namespace console\controllers;

use Yii;
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


    public function actionAssignAdmin($userId) //php yii rbac/assign-admin 1 (id)
    {
        $auth = Yii::$app->authManager;
        $adminRole = $auth->getRole('administrador');

        if ($adminRole) {
            $auth->assign($adminRole, $userId);
            echo "Role 'administrador' atribuída ao usuário com ID: $userId\n";
        } else {
            echo "Role 'administrador' não encontrada.\n";
        }
    }

    public function actionAssignFuncionario($userId) //php yii rbac/assign-funcionario 6
    {
        $auth = Yii::$app->authManager;
        $adminRole = $auth->getRole('funcionario');

        if ($adminRole) {
            $auth->assign($adminRole, $userId);
            echo "Role 'funcionario' atribuída ao usuário com ID: $userId\n";
        } else {
            echo "Role 'funcionario' não encontrada.\n";
        }
    }

}
