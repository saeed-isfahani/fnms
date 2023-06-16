<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%devices}}".
 *
 * @property int $id
 * @property string|null $ip
 * @property string|null $mac
 * @property string|null $name
 * @property string|null $ports
 */
class Devices extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%devices}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'mac', 'name', 'ports'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'ip',
            'mac' => 'mac',
            'name' => 'name',
            'ports' => 'Ports',
        ];
    }
}
