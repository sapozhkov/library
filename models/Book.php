<?php

namespace app\models;

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
 */
class Book extends \yii\db\ActiveRecord
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
     * @return \yii\db\ActiveQuery
     */
    public function getStats()
    {
        return $this->hasMany(Stat::className(), ['book_id' => 'id']);
    }
}
