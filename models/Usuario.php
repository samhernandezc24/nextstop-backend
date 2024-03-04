<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $usu_id
 * @property string $usu_nombre
 * @property string $usu_apellido
 * @property string|null $usu_biografia
 * @property string|null $usu_pais
 * @property string $usu_createdfecha
 * @property string $usu_updatedfecha
 * @property int|null $usu_deleted
 *
 * @property ComentarioDislike[] $comentarioDislikes
 * @property ComentarioLike[] $comentarioLikes
 * @property Comentario[] $comentarios
 * @property PublicacionDislike[] $publicacionDislikes
 * @property PublicacionLike[] $publicacionLikes
 * @property PublicacionVisita[] $publicacionVisitas
 * @property Publicacion[] $publicacions
 * @property UsuarioInsignia[] $usuarioInsignias
 */
class Usuario extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usu_nombre', 'usu_apellido'], 'required'],
            [['usu_biografia'], 'string'],
            [['usu_createdfecha', 'usu_updatedfecha'], 'safe'],
            [['usu_deleted'], 'integer'],
            [['usu_nombre', 'usu_apellido'], 'string', 'max' => 255],
            [['usu_pais'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usu_id' => 'Usu ID',
            'usu_nombre' => 'Usu Nombre',
            'usu_apellido' => 'Usu Apellido',
            'usu_biografia' => 'Usu Biografia',
            'usu_pais' => 'Usu Pais',
            'usu_createdfecha' => 'Usu Createdfecha',
            'usu_updatedfecha' => 'Usu Updatedfecha',
            'usu_deleted' => 'Usu Deleted',
        ];
    }

    /**
     * Gets query for [[ComentarioDislikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioDislikes()
    {
        return $this->hasMany(ComentarioDislike::class, ['cod_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[ComentarioLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarioLikes()
    {
        return $this->hasMany(ComentarioLike::class, ['col_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['com_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[PublicacionDislikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionDislikes()
    {
        return $this->hasMany(PublicacionDislike::class, ['pud_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[PublicacionLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionLikes()
    {
        return $this->hasMany(PublicacionLike::class, ['pul_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[PublicacionVisitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionVisitas()
    {
        return $this->hasMany(PublicacionVisita::class, ['puv_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[Publicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacions()
    {
        return $this->hasMany(Publicacion::class, ['pub_fkusuario' => 'usu_id']);
    }

    /**
     * Gets query for [[UsuarioInsignias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioInsignias()
    {
        return $this->hasMany(UsuarioInsignia::class, ['usi_fkusuario' => 'usu_id']);
    }
}
