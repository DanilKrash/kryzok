<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "society".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $image
 * @property int $status
 * @property string $date
 * @property int $age_id
 *
 * @property Age $age
 * @property Comment[] $comments
 * @property Proposal[] $proposals
 * @property Timelist[] $timelists
 */
class Society extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'society';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'desc', 'image', 'date', 'age_id'], 'required'],
            [['desc'], 'string'],
            [['status', 'age_id'], 'integer'],
            [['date'], 'safe'],
            [['name', 'image'], 'string', 'max' => 256],
            [['age_id'], 'exist', 'skipOnError' => true, 'targetClass' => Age::class, 'targetAttribute' => ['age_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'desc' => Yii::t('app', 'Desc'),
            'image' => Yii::t('app', 'Image'),
            'status' => Yii::t('app', 'Status'),
            'date' => Yii::t('app', 'Date'),
            'age_id' => Yii::t('app', 'Age ID'),
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
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comment::class, ['soc_id' => 'id']);
    }

    /**
     * Gets query for [[Proposals]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProposals()
    {
        return $this->hasMany(Proposal::class, ['society_id' => 'id']);
    }

    /**
     * Gets query for [[Timelists]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTimelists()
    {
        return $this->hasMany(Timelist::class, ['society_id' => 'id']);
    }

    public function good()
    {
        $this->status=2;
        return $this->save(false);
    }

    public function verybad()
    {
        $this->status=1;
        return $this->save(false);
    }
}
