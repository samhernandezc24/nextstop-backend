<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacion_dislike".
 *
 * @property int $pud_id
 * @property string $pud_createdusuario
 * @property string $pud_createdfecha
 * @property string $pud_updatedusuario
 * @property string $pud_updatedfecha
 * @property int $pud_fkusuario
 * @property int $pud_fkpublicacion
 *
 * @property Publicacion $pudFkpublicacion
 * @property Usuario $pudFkusuario
 */
class PublicacionDislike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicacion_dislike';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pud_createdusuario', 'pud_updatedusuario', 'pud_fkusuario', 'pud_fkpublicacion'], 'required'],
            [['pud_createdfecha', 'pud_updatedfecha'], 'safe'],
            [['pud_fkusuario', 'pud_fkpublicacion'], 'integer'],
            [['pud_createdusuario', 'pud_updatedusuario'], 'string', 'max' => 255],
            [['pud_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['pud_fkpublicacion' => 'pub_id']],
            [['pud_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['pud_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pud_id' => 'Pud ID',
            'pud_createdusuario' => 'Pud Createdusuario',
            'pud_createdfecha' => 'Pud Createdfecha',
            'pud_updatedusuario' => 'Pud Updatedusuario',
            'pud_updatedfecha' => 'Pud Updatedfecha',
            'pud_fkusuario' => 'Pud Fkusuario',
            'pud_fkpublicacion' => 'Pud Fkpublicacion',
        ];
    }

    /**
     * Gets query for [[PudFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPudFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'pud_fkpublicacion']);
    }

    /**
     * Gets query for [[PudFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPudFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'pud_fkusuario']);
    }
}
