<?php

namespace common\models;

use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%message}}".
 *
 * @property int $id
 * @property int $from
 * @property int $to
 * @property int|null $read_at
 * @property string $message_text
 * @property string $subject
 * @property int $created_at
 * @property int $updated_at
 * @property int $created_by
 * @property int $updated_by
 *
 * @property User $createdBy
 * @property User $from0
 * @property User $to0
 * @property User $updatedBy
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%message}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => TimestampBehavior::class,
            'blameable' => BlameableBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['from', 'to', 'message_text', 'subject'], 'required'],
            [['from', 'to', 'read_at', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['message_text'], 'string'],
            [['subject'], 'string', 'max' => 255],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
            [['from'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['from' => 'id']],
            [['to'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['to' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'from' => 'From',
            'to' => 'To',
            'read_at' => 'Read At',
            'message_text' => 'Message Text',
            'subject' => 'Subject',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }


    /**
     * Gets query for [[From0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFrom0()
    {
        return $this->hasOne(User::class, ['id' => 'from']);
    }

    /**
     * Gets query for [[To0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTo0()
    {
        return $this->hasOne(User::class, ['id' => 'to']);
    }
}
