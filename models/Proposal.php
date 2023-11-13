<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proposal".
 *
 * @property int $id
 * @property string $whole_name
 * @property string $telephone
 * @property int $age_id
 * @property int $society_id
 * @property int $status
 *
 * @property Age $age
 * @property Society $society
 */
class Proposal extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'proposal';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['whole_name', 'telephone', 'age_id', 'society_id'], 'required'],
            [['age_id', 'status', 'society_id'], 'integer'],
            ['user_id', 'default', 'value'=>Yii::$app->user->getId()],
            [['whole_name'], 'string', 'max' => 256],
            [['telephone'], 'string', 'max' => 128],
            [['age_id'], 'exist', 'skipOnError' => true, 'targetClass' => Age::class, 'targetAttribute' => ['age_id' => 'id']],
            [['society_id'], 'exist', 'skipOnError' => true, 'targetClass' => Society::class, 'targetAttribute' => ['society_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'whole_name' => Yii::t('app', 'Ф.И.О'),
            'telephone' => Yii::t('app', 'Телефон'),
            'age_id' => Yii::t('app', 'Возрастная категория'),
            'society_id' => Yii::t('app', 'Клуб'),
        ];
    }

    /**
     * Gets query for [[Age]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAge()
    {
        return $this->hasOne(Age::class, ['id' => 'age_id']);
    }

    /**
     * Gets query for [[Society]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSociety()
    {
        return $this->hasOne(Society::class, ['id' => 'society_id']);
    }

    public function getStatus()
    {
        switch ($this->status) {
            case 0: return 'Отменёна';
            case 1: return 'На рассмотрении';
            case 2: return 'Одобрена';
            default: return 'Неопределенно';
        }
    }

    public function getColor()
    {
        switch ($this->status) {
            case 0: return 'danger';
            case 1: return 'warning';
            case 2: return 'success';
            default: return 'secondary';
        }
    }

}
