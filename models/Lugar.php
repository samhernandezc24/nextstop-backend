<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lugar".
 *
 * @property int $lug_id
 * @property string $lug_nombre
 * @property string|null $lug_descripcion
 * @property string $lug_createdfecha
 * @property string $lug_updatedfecha
 * @property int|null $lug_deleted
 * @property int $lug_fklugartipo
 * @property int $lug_fkubicacion
 *
 * @property LugarTipo $lugFklugartipo
 * @property Ubicacion $lugFkubicacion
 * @property Publicacion[] $publicacions
 */
class Lugar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lugar';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lug_nombre', 'lug_fklugartipo', 'lug_fkubicacion'], 'required'],
            [['lug_descripcion'], 'string'],
            [['lug_createdfecha', 'lug_updatedfecha'], 'safe'],
            [['lug_deleted', 'lug_fklugartipo', 'lug_fkubicacion'], 'integer'],
            [['lug_nombre'], 'string', 'max' => 255],
            [['lug_fklugartipo'], 'exist', 'skipOnError' => true, 'targetClass' => LugarTipo::class, 'targetAttribute' => ['lug_fklugartipo' => 'lut_id']],
            [['lug_fkubicacion'], 'exist', 'skipOnError' => true, 'targetClass' => Ubicacion::class, 'targetAttribute' => ['lug_fkubicacion' => 'ubi_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'lug_id' => 'Lug ID',
            'lug_nombre' => 'Lug Nombre',
            'lug_descripcion' => 'Lug Descripcion',
            'lug_createdfecha' => 'Lug Createdfecha',
            'lug_updatedfecha' => 'Lug Updatedfecha',
            'lug_deleted' => 'Lug Deleted',
            'lug_fklugartipo' => 'Lug Fklugartipo',
            'lug_fkubicacion' => 'Lug Fkubicacion',
        ];
    }

    /**
     * Gets query for [[LugFklugartipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLugFklugartipo()
    {
        return $this->hasOne(LugarTipo::class, ['lut_id' => 'lug_fklugartipo']);
    }

    /**
     * Gets query for [[LugFkubicacion]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLugFkubicacion()
    {
        return $this->hasOne(Ubicacion::class, ['ubi_id' => 'lug_fkubicacion']);
    }

    /**
     * Gets query for [[Publicacions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPublicacions()
    {
        return $this->hasMany(Publicacion::class, ['pub_fklugar' => 'lug_id']);
    }
}
