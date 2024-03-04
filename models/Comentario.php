<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentario".
 *
 * @property int $com_id
 * @property string $com_contenido
 * @property string $com_createdusuario
 * @property string $com_createdfecha
 * @property string $com_updatedusuario
 * @property string $com_updatedfecha
 * @property int|null $com_deleted
 * @property int $com_fkusuario
 * @property int $com_fkpublicacion
 *
 * @property Publicacion $comFkpublicacion
 * @property Usuario $comFkusuario
 * @property ComentarioDislike[] $comentarioDislikes
 * @property ComentarioLike[] $comentarioLikes
 */
class Comentario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['com_contenido', 'com_createdusuario', 'com_updatedusuario', 'com_fkusuario', 'com_fkpublicacion'], 'required'],
            [['com_contenido'], 'string'],
            [['com_createdfecha', 'com_updatedfecha'], 'safe'],
            [['com_deleted', 'com_fkusuario', 'com_fkpublicacion'], 'integer'],
            [['com_createdusuario', 'com_updatedusuario'], 'string', 'max' => 255],
            [['com_fkpublicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Publicacion::class, 'targetAttribute' => ['com_fkpublicacion' => 'pub_id']],
            [['com_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['com_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'com_id' => 'Com ID',
            'com_contenido' => 'Com Contenido',
            'com_createdusuario' => 'Com Createdusuario',
            'com_createdfecha' => 'Com Createdfecha',
            'com_updatedusuario' => 'Com Updatedusuario',
            'com_updatedfecha' => 'Com Updatedfecha',
            'com_deleted' => 'Com Deleted',
            'com_fkusuario' => 'Com Fkusuario',
            'com_fkpublicacion' => 'Com Fkpublicacion',
        ];
    }

    /**
     * Gets query for [[ComFkpublicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComFkpublicacion()
    {
        return $this->hasOne(Publicacion::class, ['pub_id' => 'com_fkpublicacion']);
    }

    /**
     * Gets query for [[ComFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'com_fkusuario']);
    }

    /**
     * Gets query for [[ComentarioDislikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioDislikes()
    {
        return $this->hasMany(ComentarioDislike::class, ['cod_fkcomentario' => 'com_id']);
    }

    /**
     * Gets query for [[ComentarioLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioLikes()
    {
        return $this->hasMany(ComentarioLike::class, ['col_fkcomentario' => 'com_id']);
    }
}
