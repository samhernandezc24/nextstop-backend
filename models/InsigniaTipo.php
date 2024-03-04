<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insignia_tipo".
 *
 * @property int $int_id
 * @property string $int_nombre
 * @property int|null $int_deleted
 *
 * @property Insignia[] $insignias
 */
class InsigniaTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insignia_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['int_nombre'], 'required'],
            [['int_deleted'], 'integer'],
            [['int_nombre'], 'string', 'max' => 50],
            [['int_nombre'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'int_id' => 'Int ID',
            'int_nombre' => 'Int Nombre',
            'int_deleted' => 'Int Deleted',
        ];
    }

    /**
     * Gets query for [[Insignias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInsignias()
    {
        return $this->hasMany(Insignia::class, ['ins_fkinsigniatipo' => 'int_id']);
    }
}
