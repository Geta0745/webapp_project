<?php

namespace app\models;

use Yii;
use \yii\web\UploadedFile;
use yii\helpers\FileHelper;
use yii\helpers\Url;
/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $product_name
 * @property string $product_description
 * @property int $price
 * @property int $current_amount
 * @property string $img
 */
class Product extends \yii\db\ActiveRecord
{
    public $file;
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
            [['product_name', 'product_description', 'price', 'current_amount'], 'required'],
            [['price', 'current_amount'], 'integer'],
            [['product_name', 'product_description'], 'string', 'max' => 100],
            [['file'], 'file', 'skipOnEmpty' => $this->img != null, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_name' => 'Product Name',
            'product_description' => 'Product Description',
            'price' => 'Price',
            'current_amount' => 'Current Amount',
            'img' => 'Img',
        ];
    }

    public function uploadPath() {
        return Url::to('@web/uploads/events');
    }

    public function uploadFile($path,$extension)
    {
        if ($this->validate()) {
            FileHelper::createDirectory($path);
            $this->file->saveAs($path.$extension,false);
            return true;
        } else {
            return false;
        }
    }


}
