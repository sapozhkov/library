<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string $author
 * @property int $year
 * @property int $pages
 * @property string $add_date
 *
 * @property Stat[] $stats
 * @property Stat|null $userStat
 */
class Book extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author'], 'required'],
            [['year', 'pages'], 'integer'],
            [['add_date'], 'safe'],
            [['name', 'author'], 'string', 'max' => 256],
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
            'author' => 'Author',
            'year' => 'Year',
            'pages' => 'Pages',
            'add_date' => 'Add Date',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getStats()
    {
        return $this->hasMany(Stat::class, ['book_id' => 'id']);
    }

    /**
     * Отдает статистику только для такущего пользователя
     * @return ActiveQuery|null
     */
    protected function getUserStat()
    {
        if (!Yii::$app->user->identity)
            return null;

        return $this
            ->hasOne(Stat::class, ['book_id' => 'id'])
            ->where(['user_id'=>Yii::$app->user->identity->getId()])
            ;
    }
}
