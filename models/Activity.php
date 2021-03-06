<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "activity".
 *
 * @property int $id
 * @property string $name
 * @property int $started_at
 * @property int $finished_at
 * @property int $user_id
 * @property string $description
 * @property int $is_repeatable
 * @property int $is_blocking
 * @property int $created_at
 * @property int $updated_at
 *
 * @property User $user
 */
class Activity extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'activity';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => time()
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['started_at', 'finished_at', 'user_id', 'is_repeatable', 'is_blocking', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['description'], 'string', 'max' => 1023],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'started_at' => 'Started At',
            'finished_at' => 'Finished At',
            'user_id' => 'User ID',
            'description' => 'Description',
            'is_repeatable' => 'Is Repeatable',
            'is_blocking' => 'Is Blocking',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
