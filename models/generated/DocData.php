<?php

namespace app\models\generated;

use Yii;

/**
 * This is the model class for table "doc_data".
 *
 * @property int $user_id
 * @property string $name
 * @property string $role
 * @property string $text
 * @property int $id
 * @property string $email
 *
 * @property Users $user
 * @property Documents[] $documents
 */
class DocData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'doc_data';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['name', 'role', 'text', 'email'], 'required'],
            [['text'], 'string'],
            [['name', 'role', 'email'], 'string', 'max' => 25],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'role' => 'Role',
            'text' => 'Text',
            'id' => 'ID',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Documents::className(), ['user_id' => 'id']);
    }
}
