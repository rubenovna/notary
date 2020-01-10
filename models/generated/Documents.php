<?php

namespace app\models\generated;

use Yii;

/**
 * This is the model class for table "documents".
 *
 * @property int $doc_id
 * @property int $user_id
 * @property string $user_status
 * @property string $doc
 * @property string $path
 * @property string $signet_path
 * @property int $doc_status
 *
 * @property DocData $user
 */
class Documents extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'documents';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'doc_status'], 'integer'],
            [['role', /*'doc',*/ 'path', 'signet_path'], 'string', 'max' => 255],
            ['role', 'string', 'max' => 25],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => DocData::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'doc_id' => 'Doc ID',
            'user_id' => 'User ID',
            'role' => 'Role',
            //'doc' => 'Doc',
            'path' => 'Path',
            'signet_path' => 'Signet Path',
            'doc_status' => 'Doc Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(DocData::className(), ['id' => 'user_id']);
    }
}
