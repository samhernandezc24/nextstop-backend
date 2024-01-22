<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubicacion".
 *
 * @property int $ubi_id
 * @property string|null $ubi_municipio
 * @property string|null $ubi_estado
 * @property string|null $ubi_pais
 *
 * @property Lugar[] $lugars
 */
class Ubicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ubicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubi_municipio', 'ubi_estado', 'ubi_pais'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ubi_id' => 'Ubi ID',
            'ubi_municipio' => 'Ubi Municipio',
            'ubi_estado' => 'Ubi Estado',
            'ubi_pais' => 'Ubi Pais',
        ];
    }

    /**
     * Gets query for [[Lugars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLugars()
    {
        return $this->hasMany(Lugar::class, ['lug_fkubicacion' => 'ubi_id']);
    }
}
