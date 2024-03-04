<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacion_fichero".
 *
 * @property int $puf_id
 * @property string $puf_path
 * @property int|null $puf_deleted
 * @property int $puf_fkpublicacion
 *
 * @property Publicacion $pufFkpublicacion
 */
class PublicacionFichero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicacion_fichero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['puf_path', 'puf_fkpublicacion'], 'required'],
            [['puf_deleted', 'puf_fkpublicacion'], 'integer'],
            [['puf_path'], 'string', 'max' => 100],
            [['puf_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['puf_fkpublicacion' => 'pub_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'puf_id' => 'Puf ID',
            'puf_path' => 'Puf Path',
            'puf_deleted' => 'Puf Deleted',
            'puf_fkpublicacion' => 'Puf Fkpublicacion',
        ];
    }

    /**
     * Gets query for [[PufFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPufFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'puf_fkpublicacion']);
    }
}
