<?php
namespace app\controllers;

use yii\rest\ActiveController;
use yii\data\ActiveDataProvider;
use app\models\Admin;

class AdminController extends ActiveController {

	public $modelClass = 'app\models\Admin';
	
	public function actionAdmin() {

		$request= \Yii::$app->request->get();

		$admin = Admin::find()
		->select(['username', 'last_name','first_name','name'])
		->innerJoinWith('personalData')->innerJoinWith('role')
		->andFilterWhere(['like', $request['field'], $request['value']])
		->orderBy($request['column'])
		->asArray();
		
		$dataProvider = new ActiveDataProvider([
			'query' => $admin,
			'pagination' => [
				'pageSize' => 20,
				//'pageParam' => $get['page'],
			],
		]);
		return $dataProvider;
		
	}
}

?>