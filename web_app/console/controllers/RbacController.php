<?php
namespace console\controllers;

use Yii;
use yii\helpers\Console;

class RbacController extends \yii\console\Controller {

    public function actionInit(){

        $auth = Yii::$app->authManager;
        $auth->removeAll();
        Console::output('Removing All! RBAC.....');
      
        $nUser = $auth->createRole('user');
        $nUser->description = 'just a nrmal user';
        $auth->add($nUser);
      
        $employee = $auth->createRole('employee');
        $employee->description = 'พนักงาน';
        $auth->add($employee);

        $admin = $auth->createRole('Admin');
        $admin->description = 'สำหรับการดูแลระบบ';
        $auth->add($admin);
      
        $auth->addChild($admin, $employee);
      
        $auth->assign($nUser, 1);
        $auth->assign($employee, 2);
        $auth->assign($admin, 3);
      
        Console::output('Success! RBAC roles has been added.');
      
      }

}
?>