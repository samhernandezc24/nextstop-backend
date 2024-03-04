<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario_insignia".
 *
 * @property int $usi_id
 * @property string $usi_createdfecha
 * @property string $usi_updatedfecha
 * @property int|null $usi_deleted
 * @property int $usi_fkusuario
 * @property int $usi_fkinsignia
 *
 * @property Insignia $usiFkinsignia
 * @property Usuario $usiFkusuario
 */
class UsuarioInsignia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario_insignia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['usi_createdfecha', 'usi_updatedfecha'], 'safe'],
            [['usi_deleted', 'usi_fkusuario', 'usi_fkinsignia'], 'integer'],
            [['usi_fkusuario', 'usi_fkinsignia'], 'required'],
            [['usi_fkinsignia'], 'exist', 'skipOnError' => true, 'targetClass' => Insignia::class, 'targetAttribute' => ['usi_fkinsignia' => 'ins_id']],
            [['usi_fkusuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['usi_fkusuario' => 'usu_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'usi_id' => 'Usi ID',
            'usi_createdfecha' => 'Usi Createdfecha',
            'usi_updatedfecha' => 'Usi Updatedfecha',
            'usi_deleted' => 'Usi Deleted',
            'usi_fkusuario' => 'Usi Fkusuario',
            'usi_fkinsignia' => 'Usi Fkinsignia',
        ];
    }

    /**
     * Gets query for [[UsiFkinsignia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsiFkinsignia()
    {
        return $this->hasOne(Insignia::class, ['ins_id' => 'usi_fkinsignia']);
    }

    /**
     * Gets query for [[UsiFkusuario]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsiFkusuario()
    {
        return $this->hasOne(Usuario::class, ['usu_id' => 'usi_fkusuario']);
    }
}
