<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "timelist".
 *
 * @property int $id
 * @property string|null $weekday
 * @property string|null $weekends
 * @property int|null $society_id
 *
 * @property Society $society
 */
class Timelist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'timelist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['society_id'], 'integer'],
            [['weekday', 'weekends'], 'string', 'max' => 200],
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
            'weekday' => Yii::t('app', 'Weekday'),
            'weekends' => Yii::t('app', 'Weekends'),
            'society_id' => Yii::t('app', 'Society ID'),
        ];
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
}
