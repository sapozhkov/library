<?php

namespace app\models;

/**
 * This is the model class for table "stat".
 *
 * @property int $id
 * @property int $book_id
 * @property int $user_id
 * @property int $status
 * @property int $complete
 * @property int $percent
 * @property string $start_date
 * @property string $end_date
 * @property string $plan_end_date
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Book $book
 * @property User $user
 */
class Stat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'user_id', 'status', 'complete', 'percent', 'start_date', 'end_date', 'plan_end_date', 'created_at', 'updated_at'], 'required'],
            [['book_id', 'user_id', 'status', 'complete', 'percent'], 'integer'],
            [['start_date', 'end_date', 'plan_end_date', 'created_at', 'updated_at'], 'safe'],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
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
            'book_id' => 'Book ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'complete' => 'Complete',
            'percent' => 'Percent',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'plan_end_date' => 'Plan End Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
