<?php

use yii\db\Migration;

/**
 * Class m240303_224440_migration0
 */
class m240303_224440_migration0 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {        
        // TABLA DE USUARIO
        $this->createTable('usuario', [
            'usu_id' => $this->primaryKey(),            
            'usu_nombre' => $this->string()->notNull(),
            'usu_apellido' => $this->string()->notNull(),
            'usu_biografia' => $this->text()->null(),
            'usu_pais' => $this->string(50)->null(),
            'usu_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'usu_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'usu_deleted' => $this->boolean()->defaultValue(false),
        ]);

        // TABLA DE LUGAR TIPO
        $this->createTable('lugar_tipo', [
            'lut_id' => $this->primaryKey(),            
            'lut_nombre' => $this->string()->notNull()->unique(),
            'lut_icono' => $this->string(25)->notNull(),
            'lut_deleted' => $this->boolean()->defaultValue(false),
        ]);

        // TABLA DE INSIGNIA TIPO
        $this->createTable('insignia_tipo', [
            'int_id' => $this->primaryKey(),            
            'int_nombre' => $this->string(50)->notNull()->unique(),
            'int_deleted' => $this->boolean()->defaultValue(false),
        ]);

        // TABLA DE INSIGNIA
        $this->createTable('insignia', [
            'ins_id' => $this->primaryKey(),            
            'ins_nombre' => $this->string()->notNull()->unique(),
            'ins_descripcion' => $this->text()->null(),
            'ins_imagen' => $this->string()->null(),
            'ins_score' => $this->integer()->notNull()->defaultValue(0),
            'ins_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'ins_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'ins_deleted' => $this->boolean()->defaultValue(false),
            'ins_fkinsigniatipo' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'ins_fkinsigniatipo',
            'insignia',
            'ins_fkinsigniatipo',
            'insignia_tipo',
            'int_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE UBICACION
        $this->createTable('ubicacion', [
            'ubi_id' => $this->primaryKey(),            
            'ubi_ciudad' => $this->string()->notNull(),
            'ubi_estado' => $this->string(50)->notNull(),
            'ubi_pais' => $this->string(50)->notNull(),
            'ubi_deleted' => $this->boolean()->defaultValue(false),
        ]);

        // TABLA DE LUGAR
        $this->createTable('lugar', [
            'lug_id' => $this->primaryKey(),            
            'lug_nombre' => $this->string()->notNull()->unique(),
            'lug_descripcion' => $this->text()->null(),
            'lug_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'lug_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'lug_deleted' => $this->boolean()->defaultValue(false),
            'lug_fklugartipo' => $this->integer()->notNull(),
            'lug_fkubicacion' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'lug_fklugartipo',
            'lugar',
            'lug_fklugartipo',
            'lugar_tipo',
            'lut_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'lug_fkubicacion',
            'lugar',
            'lug_fkubicacion',
            'ubicacion',
            'ubi_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE ETIQUETA
        $this->createTable('etiqueta', [
            'eti_id' => $this->primaryKey(),            
            'eti_nombre' => $this->string()->notNull()->unique(),
            'eti_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'eti_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'eti_deleted' => $this->boolean()->defaultValue(false),
        ]);

        // TABLA DE PUBLICACION
        $this->createTable('publicacion', [
            'pub_id' => $this->primaryKey(),            
            'pub_titulo' => $this->string(100)->notNull(),
            'pub_descripcion' => $this->text()->notNull(),
            'pub_createdusuario' => $this->string()->notNull(),
            'pub_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'pub_updatedusuario' => $this->string()->notNull(),
            'pub_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'pub_deleted' => $this->boolean()->defaultValue(false),
            'pub_fkusuario' => $this->integer()->notNull(),
            'pub_fklugar' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'pub_fkusuario',
            'publicacion',
            'pub_fkusuario',
            'usuario',
            'usu_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'pub_fklugar',
            'publicacion',
            'pub_fklugar',
            'lugar',
            'lug_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE PUBLICACION FICHERO
        $this->createTable('publicacion_fichero', [
            'puf_id' => $this->primaryKey(),            
            'puf_path' => $this->string(100)->notNull(),            
            'puf_deleted' => $this->boolean()->defaultValue(false),
            'puf_fkpublicacion' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'puf_fkpublicacion',
            'publicacion_fichero',
            'puf_fkpublicacion',
            'publicacion',
            'pub_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE PUBLICACION ETIQUETA
        $this->createTable('publicacion_etiqueta', [
            'pue_fkpublicacion' => $this->integer()->notNull(),
            'pue_fketiqueta' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'pue_fkpublicacion',
            'publicacion_etiqueta',
            'pue_fkpublicacion',
            'publicacion',
            'pub_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'pue_fketiqueta',
            'publicacion_etiqueta',
            'pue_fketiqueta',
            'etiqueta',
            'eti_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE USUARIO INSIGNIA
        $this->createTable('usuario_insignia', [
            'usi_id' => $this->primaryKey(),
            'usi_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'usi_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'usi_deleted' => $this->boolean()->defaultValue(false),
            'usi_fkusuario' => $this->integer()->notNull(),
            'usi_fkinsignia' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'usi_fkusuario',
            'usuario_insignia',
            'usi_fkusuario',
            'usuario',
            'usu_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'usi_fkinsignia',
            'usuario_insignia',
            'usi_fkinsignia',
            'insignia',
            'ins_id',
            'NO ACTION',
            'NO ACTION',
        );
    }
    
    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Eliminar clave foránea de la tabla insignia
        $this->dropForeignKey('ins_fkinsigniatipo', 'insignia');

        // Eliminar clave foránea de la tabla insignia
        $this->dropForeignKey('lug_fklugartipo', 'lugar');
        $this->dropForeignKey('lug_fkubicacion', 'lugar');

        // Eliminar clave foránea de la tabla publicacion
        $this->dropForeignKey('pub_fkusuario', 'publicacion');
        $this->dropForeignKey('pub_fklugar', 'publicacion');

        // Eliminar clave foránea de la tabla publicacion_fichero
        $this->dropForeignKey('puf_fkpublicacion', 'publicacion_fichero');

        // Eliminar clave foránea de la tabla publicacion_etiqueta
        $this->dropForeignKey('pue_fkpublicacion', 'publicacion_etiqueta');
        $this->dropForeignKey('pue_fketiqueta', 'publicacion_etiqueta');

        // Eliminar clave foránea de la tabla usuario_insignia
        $this->dropForeignKey('usi_fkusuario', 'usuario_insignia');
        $this->dropForeignKey('usi_fkinsignia', 'usuario_insignia');

        // Eliminar la tabla usuario
        $this->dropTable('usuario');

        // Eliminar la tabla lugar tipo
        $this->dropTable('lugar_tipo');

        // Eliminar la tabla insignia
        $this->dropTable('insignia');

        // Eliminar la tabla insignia tipo
        $this->dropTable('insignia_tipo');

        // Eliminar la tabla ubicacion
        $this->dropTable('ubicacion');

        // Eliminar la tabla lugar
        $this->dropTable('lugar');
 
        // Eliminar la tabla etiqueta
        $this->dropTable('etiqueta');

        // Eliminar la tabla publicacion
        $this->dropTable('publicacion');

        // Eliminar la tabla publicacion_fichero
        $this->dropTable('publicacion_fichero');

        // Eliminar la tabla publicacion_etiqueta
        $this->dropTable('publicacion_etiqueta');

        // Eliminar la tabla usuario_insignia
        $this->dropTable('usuario_insignia');
    }    

    /*
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
        echo "m240303_224440_migration0 cannot be reverted.\n";

        return false;
    }
    */    
}
