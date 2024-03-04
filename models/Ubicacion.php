<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ubicacion".
 *
 * @property int $ubi_id
 * @property string $ubi_ciudad
 * @property string $ubi_estado
 * @property string $ubi_pais
 * @property int|null $ubi_deleted
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
            [['ubi_ciudad', 'ubi_estado', 'ubi_pais'], 'required'],
            [['ubi_deleted'], 'integer'],
            [['ubi_ciudad'], 'string', 'max' => 255],
            [['ubi_estado', 'ubi_pais'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ubi_id' => 'Ubi ID',
            'ubi_ciudad' => 'Ubi Ciudad',
            'ubi_estado' => 'Ubi Estado',
            'ubi_pais' => 'Ubi Pais',
            'ubi_deleted' => 'Ubi Deleted',
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
