<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "age".
 *
 * @property int $id
 * @property string $age
 *
 * @property Proposal[] $proposals
 * @property Society[] $societies
 */
class Age extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'age';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['age'], 'required'],
            [['age'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'age' => Yii::t('app', 'Age'),
        ];
    }

    /**
     * Gets query for [[Proposals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['age_id' => 'id']);
    }

    /**
     * Gets query for [[Societies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocieties()
    {
        return $this->hasMany(Society::class, ['age_id' => 'id']);
    }
}
