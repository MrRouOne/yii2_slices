<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $image
 * @property float $price
 * @property string $country
 * @property int $year
 * @property string $model
 * @property string $created_at
 *
 * @property Category $category
 */
class Product extends \yii\db\ActiveRecord
{
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'image', 'price', 'country', 'year', 'model'], 'required'],
            [['category_id', 'year'], 'integer'],
            [['price'], 'number'],
            [['created_at'], 'safe'],
            [['name', 'image', 'country', 'model'], 'string', 'max' => 255],
            [
                ['category_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Category::class,
                'targetAttribute' => ['category_id' => 'id'],
            ],
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Категория',
            'name' => 'Название',
            'image' => 'Изображение',
            'imageFile' => 'Изображение',
            'price' => 'Цена',
            'country' => 'Страна производитель',
            'year' => 'Год выпуска',
            'model' => 'Модель',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function upload()
    {
        $this->image = 'web/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
        if ($this->validate()) {
            $this->imageFile->saveAs( $this->image);
            return true;
        } else {
            return false;
        }
    }
}
