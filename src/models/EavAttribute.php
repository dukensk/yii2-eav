<?php

namespace mazurva\eav\models;

use mazurva\eav\models\EavEntity;
use mazurva\eav\models\EavAttributeValue;
use mazurva\eav\models\EavAttributeOption;
use mazurva\eav\models\EavAttributeType;
use Yii;

/**
 * This is the model class for table "{{%eav_attribute}}".
 *
 * @property integer $id
 * @property string $entityModel
 * @property integer $typeId
 * @property string $name
 * @property string $label
 * @property string $defaultValue
 * @property integer $defaultOptionId
 * @property integer $required
 *
 * @property EavAttributeOption $defaultOption
 * @property EavAttributeType $type
 * @property EavAttributeOption[] $eavAttributeOptions
 * @property EavAttributeValue[] $eavAttributeValues
 */
class EavAttribute extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%eav_attribute}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'defaultValue', 'entityModel', 'label'], 'string', 'max' => 255],
            //[['defaultOptionId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttributeOption::className(), 'targetAttribute' => ['defaultOptionId' => 'id']],
            //[['typeId'], 'exist', 'skipOnError' => true, 'targetClass' => EavAttributeType::className(), 'targetAttribute' => ['typeId' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'typeId' => 'Type ID',
            'name' => 'Name',
            'label' => 'Label',
            'defaultValue' => 'Default Value',
            'defaultOptionId' => 'Default Option ID',
            'required' => 'Required',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultOption()
    {
        return $this->hasOne(EavAttributeOption::className(), ['id' => 'defaultOptionId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavType()
    {
        return $this->hasOne(EavAttributeType::className(), ['id' => 'typeId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntity()
    {
        //TODO: Change EavEntity::className() to $this->entityModel
        return $this->hasOne(EavEntity::className(), ['id' => 'entityId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavOptions()
    {
        return $this->hasMany(EavAttributeOption::className(), ['attributeId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEavAttributeValues()
    {
        return $this->hasMany(EavAttributeValue::className(), ['attributeId' => 'id']);
    }
}