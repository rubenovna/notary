<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "WhateverYourModel".
 *
 * @property string $name
 * @property string $size
 * @property string $url
 * @property string $thumbnailUrl
 */
class WhateverYourModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'WhateverYourModel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'size', 'url', 'thumbnailUrl'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'size' => 'Size',
            'url' => 'Url',
            'thumbnailUrl' => 'Thumbnail Url',
        ];
    }
}
