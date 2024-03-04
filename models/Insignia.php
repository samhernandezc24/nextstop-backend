<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insignia".
 *
 * @property int $ins_id
 * @property string $ins_nombre
 * @property string|null $ins_descripcion
 * @property string|null $ins_imagen
 * @property int $ins_score
 * @property string $ins_createdfecha
 * @property string $ins_updatedfecha
 * @property int|null $ins_deleted
 * @property int $ins_fkinsigniatipo
 *
 * @property InsigniaTipo $insFkinsigniatipo
 * @property UsuarioInsignia[] $usuarioInsignias
 */
class Insignia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insignia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ins_nombre', 'ins_fkinsigniatipo'], 'required'],
            [['ins_descripcion'], 'string'],
            [['ins_score', 'ins_deleted', 'ins_fkinsigniatipo'], 'integer'],
            [['ins_createdfecha', 'ins_updatedfecha'], 'safe'],
            [['ins_nombre', 'ins_imagen'], 'string', 'max' => 255],
            [['ins_nombre'], 'unique'],
            [['ins_fkinsigniatipo'], 'exist', 'skipOnError' => true, 'targetClass' => InsigniaTipo::class, 'targetAttribute' => ['ins_fkinsigniatipo' => 'int_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ins_id' => 'Ins ID',
            'ins_nombre' => 'Ins Nombre',
            'ins_descripcion' => 'Ins Descripcion',
            'ins_imagen' => 'Ins Imagen',
            'ins_score' => 'Ins Score',
            'ins_createdfecha' => 'Ins Createdfecha',
            'ins_updatedfecha' => 'Ins Updatedfecha',
            'ins_deleted' => 'Ins Deleted',
            'ins_fkinsigniatipo' => 'Ins Fkinsigniatipo',
        ];
    }

    /**
     * Gets query for [[InsFkinsigniatipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInsFkinsigniatipo()
    {
        return $this->hasOne(InsigniaTipo::class, ['int_id' => 'ins_fkinsigniatipo']);
    }

    /**
     * Gets query for [[UsuarioInsignias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsuarioInsignias()
    {
        return $this->hasMany(UsuarioInsignia::class, ['usi_fkinsignia' => 'ins_id']);
    }
}
