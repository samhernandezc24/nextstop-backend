<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lugar_tipo".
 *
 * @property int $lut_id
 * @property string $lut_nombre
 * @property string $lut_icono
 * @property int|null $lut_deleted
 *
 * @property Lugar[] $lugars
 */
class LugarTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lugar_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lut_nombre', 'lut_icono'], 'required'],
            [['lut_deleted'], 'integer'],
            [['lut_nombre'], 'string', 'max' => 255],
            [['lut_icono'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lut_id' => 'Lut ID',
            'lut_nombre' => 'Lut Nombre',
            'lut_icono' => 'Lut Icono',
            'lut_deleted' => 'Lut Deleted',
        ];
    }

    /**
     * Gets query for [[Lugars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLugars()
    {
        return $this->hasMany(Lugar::class, ['lug_fklugartipo' => 'lut_id']);
    }
}
