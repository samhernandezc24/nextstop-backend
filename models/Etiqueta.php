<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "etiqueta".
 *
 * @property int $eti_id
 * @property string $eti_nombre
 * @property string $eti_createdfecha
 * @property string $eti_updatedfecha
 * @property int|null $eti_deleted
 *
 * @property PublicacionEtiqueta[] $publicacionEtiquetas
 */
class Etiqueta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'etiqueta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['eti_nombre'], 'required'],
            [['eti_createdfecha', 'eti_updatedfecha'], 'safe'],
            [['eti_deleted'], 'integer'],
            [['eti_nombre'], 'string', 'max' => 255],
            [['eti_nombre'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'eti_id' => 'Eti ID',
            'eti_nombre' => 'Eti Nombre',
            'eti_createdfecha' => 'Eti Createdfecha',
            'eti_updatedfecha' => 'Eti Updatedfecha',
            'eti_deleted' => 'Eti Deleted',
        ];
    }

    /**
     * Gets query for [[PublicacionEtiquetas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionEtiquetas()
    {
        return $this->hasMany(PublicacionEtiqueta::class, ['pue_fketiqueta' => 'eti_id']);
    }
}
