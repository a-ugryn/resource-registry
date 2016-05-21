<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "attribute_class_view".
 *
 * @property integer $view_id
 * @property integer $attribute_id
 * @property integer $class_id
 *
 * @property ResourceAttribute $attribute
 * @property ResourceClass $class
 */
class AttributeClassView extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attribute_class_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['attribute_id', 'class_id'], 'required'],
            [['attribute_id', 'class_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'view_id' => 'View ID',
            'attribute_id' => 'Attribute ID',
            'class_id' => 'Class ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResourceAttribute()
    {
        return $this->hasMany(ResourceAttribute::className(), ['attribute_id' => 'attribute_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
<<<<<<< HEAD
    public function getRessourceClass()
=======
    public function getResourceClass()
>>>>>>> 7979bd0fb9eb08e4e0465e42f59939ef840b3fbe
    {
        return $this->hasMany(ResourceClass::className(), ['class_id' => 'class_id']);
    }
}
