<?php
namespace app\commands;
 
use Yii;
use yii\console\Controller;
use \app\rbac\UserGroupRule;

//run php yii rbac/init in project dir
 
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = \Yii::$app->authManager;
        $auth->removeAll();

        // Create roles
        $user =         $auth->createRole('user');
        $registrar =    $auth->createRole('registrar');
        $commissioner = $auth->createRole('commissioner');
        $admin =        $auth->createRole('admin');
 
        // Create simple, based on controller and action{$NAME} permissions
        $showrequest = $auth->createPermission('showrequest');
        // Add permissions in Yii::$app->authManager

        $show = $auth->createPermission('community/show'); 
        $auth->add($show); 
        $addcomm = $auth->createPermission('community/addcomm'); 
        $auth->add($addcomm); 
        $view = $auth->createPermission('resource/view'); 
        $auth->add($view); 
        $resIndex = $auth->createPermission('resource/index'); 
        $auth->add($resIndex); 
        $getRgKey = $auth->createPermission('resource/getregisterkey'); 
        $auth->add($getRgKey); 
        $resSearch = $auth->createPermission('resource/search'); 
        $auth->add($resSearch);
        $resCreate = $auth->createPermission('resource/create'); 
        $auth->add($resCreate); 
        $userdata = $auth->createPermission('user/userdata'); 
        $auth->add($userdata);
        $userGetRole = $auth->createPermission('user/getrole'); 
        $auth->add($userGetRole);
        $userChngActSt = $auth->createPermission('user/changeactivationstatus'); 
        $auth->add($userChngActSt);
        $userChngRole = $auth->createPermission('user/changerole'); 
        $auth->add($userChngRole);
        $reqShow = $auth->createPermission('request/showrequest'); 
        $auth->add($reqShow);
        $reqAdd = $auth->createPermission('request/addreq'); 
        $auth->add($reqAdd);

        // Add rule, based on UserExt->group === $user->group
        $userGroupRule = new UserGroupRule();
        $auth->add($userGroupRule);
 
        // Add rule "UserGroupRule" in roles
        $user->ruleName  = $userGroupRule->name;
        $registrar->ruleName = $userGroupRule->name;
        $commissioner->ruleName = $userGroupRule->name;
        $admin->ruleName  = $userGroupRule->name;
 
        // Add roles in Yii::$app->authManager
        $auth->add($user);
        $auth->add($registrar);
        $auth->add($commissioner);
        $auth->add($admin);
 
        // Add permission-per-role in Yii::$app->authManager
        // user
        //$auth->addChild($user, $guest);
 
        // registrar
        $auth->addChild($registrar, $show);
        $auth->addChild($registrar, $view);
        $auth->addChild($registrar, $resIndex);
        $auth->addChild($registrar, $getRgKey);
        $auth->addChild($registrar, $resSearch);
        $auth->addChild($registrar, $userdata);
        $auth->addChild($registrar, $resCreate);
        $auth->addChild($registrar, $userGetRole);
        $auth->addChild($registrar, $userChngActSt);
        $auth->addChild($registrar, $userChngRole);
        $auth->addChild($registrar, $reqShow);
        $auth->addChild($registrar, $reqAdd);
       
        /*// commissioner
        $auth->addChild($commissioner, $userdata);
        $auth->addChild($commissioner, $user);
 */
        // admin
        //$auth->addChild($admin, $guest);
        $auth->addChild($admin, $addcomm);
    }
}