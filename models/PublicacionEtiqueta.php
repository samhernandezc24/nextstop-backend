<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacion_etiqueta".
 *
 * @property int $pue_fkpublicacion
 * @property int $pue_fketiqueta
 *
 * @property Etiqueta $pueFketiqueta
 * @property Publicacion $pueFkpublicacion
 */
class PublicacionEtiqueta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicacion_etiqueta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pue_fkpublicacion', 'pue_fketiqueta'], 'required'],
            [['pue_fkpublicacion', 'pue_fketiqueta'], 'integer'],
            [['pue_fketiqueta'], 'exist', 'skipOnError' => true, 'targetClass' => Etiqueta::class, 'targetAttribute' => ['pue_fketiqueta' => 'eti_id']],
            [['pue_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['pue_fkpublicacion' => 'pub_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pue_fkpublicacion' => 'Pue Fkpublicacion',
            'pue_fketiqueta' => 'Pue Fketiqueta',
        ];
    }

    /**
     * Gets query for [[PueFketiqueta]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPueFketiqueta()
    {
        return $this->hasOne(Etiqueta::class, ['eti_id' => 'pue_fketiqueta']);
    }

    /**
     * Gets query for [[PueFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPueFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'pue_fkpublicacion']);
    }
}
