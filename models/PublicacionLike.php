<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacion_like".
 *
 * @property int $pul_id
 * @property string $pul_createdusuario
 * @property string $pul_createdfecha
 * @property string $pul_updatedusuario
 * @property string $pul_updatedfecha
 * @property int $pul_fkusuario
 * @property int $pul_fkpublicacion
 *
 * @property Publicacion $pulFkpublicacion
 * @property Usuario $pulFkusuario
 */
class PublicacionLike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicacion_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pul_createdusuario', 'pul_updatedusuario', 'pul_fkusuario', 'pul_fkpublicacion'], 'required'],
            [['pul_createdfecha', 'pul_updatedfecha'], 'safe'],
            [['pul_fkusuario', 'pul_fkpublicacion'], 'integer'],
            [['pul_createdusuario', 'pul_updatedusuario'], 'string', 'max' => 255],
            [['pul_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['pul_fkpublicacion' => 'pub_id']],
            [['pul_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['pul_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pul_id' => 'Pul ID',
            'pul_createdusuario' => 'Pul Createdusuario',
            'pul_createdfecha' => 'Pul Createdfecha',
            'pul_updatedusuario' => 'Pul Updatedusuario',
            'pul_updatedfecha' => 'Pul Updatedfecha',
            'pul_fkusuario' => 'Pul Fkusuario',
            'pul_fkpublicacion' => 'Pul Fkpublicacion',
        ];
    }

    /**
     * Gets query for [[PulFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPulFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'pul_fkpublicacion']);
    }

    /**
     * Gets query for [[PulFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPulFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'pul_fkusuario']);
    }
}
