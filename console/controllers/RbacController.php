<?php

namespace console\controllers;

use yii\console\Controller;

class RbacController extends Controller{

    public function actionInit(){

        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        $funcionario = $auth->createRole('funcionario');
        $auth->add($funcionario);
        $administrador = $auth->createRole('administrador');
        $auth->add($administrador);

        #FOR FUNCIONÁRIO
        //$createMenus
        //$editMenus
        //$viewMenus
        //$deleteMenus

        //$viewLunches

        //$editOwnUserDetaisls
#http://localhost/refeitorio/backend/web/index.php?r=site%2Flogin


        /**$viewInvoices = $auth->createPermission('viewInvoices');
        $auth->add($viewInvoices);
        $registerClients = $auth->createPermission('registerClients');
        $auth->add($registerClients);
        $editClients = $auth->createPermission('editClients');
        $auth->add($editClients);
        $createInvoices = $auth->createPermission('createInvoices');
        $auth->add($createInvoices);

        $auth->addChild($funcionario , $viewInvoices);
        $auth->addChild($funcionario , $registerClients);
        $auth->addChild($funcionario , $editClients);
        $auth->addChild($funcionario , $createInvoices);**/

        echo 'Rbac and roles initialized.';
    }

}
