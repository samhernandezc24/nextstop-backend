<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario_like".
 *
 * @property int $col_id
 * @property string $col_createdusuario
 * @property string $col_createdfecha
 * @property string $col_updatedusuario
 * @property string $col_updatedfecha
 * @property int $col_fkusuario
 * @property int $col_fkcomentario
 *
 * @property Comentario $colFkcomentario
 * @property Usuario $colFkusuario
 */
class ComentarioLike extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['col_createdusuario', 'col_updatedusuario', 'col_fkusuario', 'col_fkcomentario'], 'required'],
            [['col_createdfecha', 'col_updatedfecha'], 'safe'],
            [['col_fkusuario', 'col_fkcomentario'], 'integer'],
            [['col_createdusuario', 'col_updatedusuario'], 'string', 'max' => 255],
            [['col_fkcomentario'], 'exist', 'skipOnError' => true, 'targetClass' => Comentario::class, 'targetAttribute' => ['col_fkcomentario' => 'com_id']],
            [['col_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['col_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'col_id' => 'Col ID',
            'col_createdusuario' => 'Col Createdusuario',
            'col_createdfecha' => 'Col Createdfecha',
            'col_updatedusuario' => 'Col Updatedusuario',
            'col_updatedfecha' => 'Col Updatedfecha',
            'col_fkusuario' => 'Col Fkusuario',
            'col_fkcomentario' => 'Col Fkcomentario',
        ];
    }

    /**
     * Gets query for [[ColFkcomentario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColFkcomentario()
    {
        return $this->hasOne(Comentario::class, ['com_id' => 'col_fkcomentario']);
    }

    /**
     * Gets query for [[ColFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getColFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'col_fkusuario']);
    }
}
