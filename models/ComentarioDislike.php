<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario_dislike".
 *
 * @property int $cod_id
 * @property string $cod_createdusuario
 * @property string $cod_createdfecha
 * @property string $cod_updatedusuario
 * @property string $cod_updatedfecha
 * @property int $cod_fkusuario
 * @property int $cod_fkcomentario
 *
 * @property Comentario $codFkcomentario
 * @property Usuario $codFkusuario
 */
class ComentarioDislike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario_dislike';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cod_createdusuario', 'cod_updatedusuario', 'cod_fkusuario', 'cod_fkcomentario'], 'required'],
            [['cod_createdfecha', 'cod_updatedfecha'], 'safe'],
            [['cod_fkusuario', 'cod_fkcomentario'], 'integer'],
            [['cod_createdusuario', 'cod_updatedusuario'], 'string', 'max' => 255],
            [['cod_fkcomentario'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::class, 'targetAttribute' => ['cod_fkcomentario' => 'com_id']],
            [['cod_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['cod_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cod_id' => 'Cod ID',
            'cod_createdusuario' => 'Cod Createdusuario',
            'cod_createdfecha' => 'Cod Createdfecha',
            'cod_updatedusuario' => 'Cod Updatedusuario',
            'cod_updatedfecha' => 'Cod Updatedfecha',
            'cod_fkusuario' => 'Cod Fkusuario',
            'cod_fkcomentario' => 'Cod Fkcomentario',
        ];
    }

    /**
     * Gets query for [[CodFkcomentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodFkcomentario()
    {
        return $this->hasOne(Comentario::class, ['com_id' => 'cod_fkcomentario']);
    }

    /**
     * Gets query for [[CodFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCodFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'cod_fkusuario']);
    }
}
