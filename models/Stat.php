<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class Stat extends ActiveRecord
{

    /** @var int читаю сейчас */
    const IN_PROGRESS = 1;

    /** @var int прочитано */
    const DONE = 2;

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
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::class, 'targetAttribute' => ['book_id' => 'id']],
//            todo #user
//            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
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
     * @return ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

//    todo #user
//    /**
//     * @return ActiveQuery
//     */
//    public function getUser()
//    {
//        return $this->hasOne(User::class, ['id' => 'user_id']);
//    }
}
