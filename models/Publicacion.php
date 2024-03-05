<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publicacion".
 *
 * @property int $pub_id
 * @property string $pub_titulo
 * @property string $pub_descripcion
 * @property string $pub_createdusuario
 * @property string $pub_createdfecha
 * @property string $pub_updatedusuario
 * @property string $pub_updatedfecha
 * @property int|null $pub_deleted
 * @property int $pub_fkusuario
 * @property int $pub_fklugar
 *
 * @property Comentario[] $comentarios
 * @property Lugar $pubFklugar
 * @property Usuario $pubFkusuario
 * @property PublicacionDislike[] $publicacionDislikes
 * @property PublicacionEtiqueta[] $publicacionEtiquetas
 * @property PublicacionFichero[] $publicacionFicheroes
 * @property PublicacionLike[] $publicacionLikes
 * @property PublicacionVisita[] $publicacionVisitas
 */
class Publicacion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publicacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pub_titulo', 'pub_descripcion', 'pub_createdusuario', 'pub_updatedusuario', 'pub_fkusuario', 'pub_fklugar'], 'required'],
            [['pub_descripcion'], 'string'],
            [['pub_createdfecha', 'pub_updatedfecha'], 'safe'],
            [['pub_deleted', 'pub_fkusuario', 'pub_fklugar'], 'integer'],
            [['pub_titulo'], 'string', 'max' => 100],
            [['pub_createdusuario', 'pub_updatedusuario'], 'string', 'max' => 255],
            [['pub_fklugar'], 'exist', 'skipOnError' => true, 'targetClass' => Lugar::class, 'targetAttribute' => ['pub_fklugar' => 'lug_id']],
            [['pub_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['pub_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pub_id' => 'Pub ID',
            'pub_titulo' => 'Pub Titulo',
            'pub_descripcion' => 'Pub Descripcion',
            'pub_createdusuario' => 'Pub Createdusuario',
            'pub_createdfecha' => 'Pub Createdfecha',
            'pub_updatedusuario' => 'Pub Updatedusuario',
            'pub_updatedfecha' => 'Pub Updatedfecha',
            'pub_deleted' => 'Pub Deleted',
            'pub_fkusuario' => 'Pub Fkusuario',
            'pub_fklugar' => 'Pub Fklugar',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function extraFields()
    {
        return [
            'usuario' => function($item) {
                return $item->usuario;
            },
        ];
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentario::class, ['com_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[PubFklugar]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPubFklugar()
    {
        return $this->hasOne(Lugar::class, ['lug_id' => 'pub_fklugar']);
    }

    /**
     * Gets query for [[PubFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPubFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'pub_fkusuario']);
    }

    /**
     * Gets query for [[PublicacionDislikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionDislikes()
    {
        return $this->hasMany(PublicacionDislike::class, ['pud_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[PublicacionEtiquetas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionEtiquetas()
    {
        return $this->hasMany(PublicacionEtiqueta::class, ['pue_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[PublicacionFicheroes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionFicheroes()
    {
        return $this->hasMany(PublicacionFichero::class, ['puf_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[PublicacionLikes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionLikes()
    {
        return $this->hasMany(PublicacionLike::class, ['pul_fkpublicacion' => 'pub_id']);
    }

    /**
     * Gets query for [[PublicacionVisitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacionVisitas()
    {
        return $this->hasMany(PublicacionVisita::class, ['puv_fkpublicacion' => 'pub_id']);
    }

    /**
     * Obtiene el nombre completo del usuario asociado a esta publicación.
     * 
     * @return string
     */
    public function getUsuario() 
    {
        return $this->pubFkusuario->usu_nombre . ' ' . $this->pubFkusuario->usu_apellido;
    }
}
