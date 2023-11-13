<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property int $id
 * @property int $user_id
 * @property int $soc_id
 * @property string $text
 * @property string $create_at

 *
 * @property Society $soc
 * @property User $user
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['user_id', 'soc_id'], 'integer'],
            [['text', 'create_at'], 'string'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['soc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Society::class, 'targetAttribute' => ['soc_id' => 'id']],
            ['user_id', 'default', 'value' => Yii::$app->user->getId()],
            ['soc_id', 'default', 'value' => $_GET['id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'soc_id' => Yii::t('app', 'Soc ID'),
            'text' => Yii::t('app', 'Комментарий'),
        ];
    }

    /**
     * Gets query for [[Soc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSoc()
    {
        return $this->hasOne(Society::class, ['id' => 'soc_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
