<?php

use yii\db\Migration;

/**
 * Class m240304_002251_migration1
 */
class m240304_002251_migration1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        // TABLA DE COMENTARIO
        $this->createTable('comentario', [
            'com_id' => $this->primaryKey(),            
            'com_contenido' => $this->text()->notNull(),
            'com_createdusuario' => $this->string()->notNull(),
            'com_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'com_updatedusuario' => $this->string()->notNull(),
            'com_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'com_deleted' => $this->boolean()->defaultValue(false),
            'com_fkusuario' => $this->integer()->notNull(),
            'com_fkpublicacion' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'com_fkusuario',
            'comentario',
            'com_fkusuario',
            'usuario',
            'usu_id',
            'NO ACTION',
            'NO ACTION',
        );

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'com_fkpublicacion',
            'comentario',
            'com_fkpublicacion',
            'publicacion',
            'pub_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE COMENTARIO LIKE
        $this->createTable('comentario_like', [
            'col_id' => $this->primaryKey(),            
            'col_createdusuario' => $this->string()->notNull(),
            'col_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'col_updatedusuario' => $this->string()->notNull(),
            'col_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'col_fkusuario' => $this->integer()->notNull(),
            'col_fkcomentario' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'col_fkusuario',
            'comentario_like',
            'col_fkusuario',
            'usuario',
            'usu_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'col_fkcomentario',
            'comentario_like',
            'col_fkcomentario',
            'comentario',
            'com_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE COMENTARIO DISLIKE
        $this->createTable('comentario_dislike', [
            'cod_id' => $this->primaryKey(),            
            'cod_createdusuario' => $this->string()->notNull(),
            'cod_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'cod_updatedusuario' => $this->string()->notNull(),
            'cod_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'cod_fkusuario' => $this->integer()->notNull(),
            'cod_fkcomentario' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'cod_fkusuario',
            'comentario_dislike',
            'cod_fkusuario',
            'usuario',
            'usu_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'cod_fkcomentario',
            'comentario_dislike',
            'cod_fkcomentario',
            'comentario',
            'com_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE PUBLICACION VISITA
        $this->createTable('publicacion_visita', [
            'puv_id' => $this->primaryKey(),            
            'puv_createdusuario' => $this->string()->notNull(),
            'puv_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'puv_fkusuario' => $this->integer()->notNull(),
            'puv_fkpublicacion' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'puv_fkusuario',
            'publicacion_visita',
            'puv_fkusuario',
            'usuario',
            'usu_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'puv_fkpublicacion',
            'publicacion_visita',
            'puv_fkpublicacion',
            'publicacion',
            'pub_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE PUBLICACION LIKE
        $this->createTable('publicacion_like', [
            'pul_id' => $this->primaryKey(),            
            'pul_createdusuario' => $this->string()->notNull(),
            'pul_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'pul_updatedusuario' => $this->string()->notNull(),
            'pul_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'pul_fkusuario' => $this->integer()->notNull(),
            'pul_fkpublicacion' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'pul_fkusuario',
            'publicacion_like',
            'pul_fkusuario',
            'usuario',
            'usu_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'pul_fkpublicacion',
            'publicacion_like',
            'pul_fkpublicacion',
            'publicacion',
            'pub_id',
            'NO ACTION',
            'NO ACTION',
        );

        // TABLA DE PUBLICACION DISLIKE
        $this->createTable('publicacion_dislike', [
            'pud_id' => $this->primaryKey(),            
            'pud_createdusuario' => $this->string()->notNull(),
            'pud_createdfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'pud_updatedusuario' => $this->string()->notNull(),
            'pud_updatedfecha' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
            'pud_fkusuario' => $this->integer()->notNull(),
            'pud_fkpublicacion' => $this->integer()->notNull(),
        ]);

        // AGREGAR LA RELACIÓN DE CLAVE FORÁNEA
        $this->addForeignKey(
            'pud_fkusuario',
            'publicacion_dislike',
            'pud_fkusuario',
            'usuario',
            'usu_id',
            'NO ACTION',
            'NO ACTION',
        );

        $this->addForeignKey(
            'pud_fkpublicacion',
            'publicacion_dislike',
            'pud_fkpublicacion',
            'publicacion',
            'pub_id',
            'NO ACTION',
            'NO ACTION',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        // Eliminar clave foránea de la tabla comentario
        $this->dropForeignKey('com_fkusuario', 'comentario');
        $this->dropForeignKey('com_fkpublicacion', 'comentario');

        // Eliminar clave foránea de la tabla comentario_like
        $this->dropForeignKey('col_fkusuario', 'comentario_like');
        $this->dropForeignKey('col_fkcomentario', 'comentario_like');

        // Eliminar clave foránea de la tabla comentario_dislike
        $this->dropForeignKey('cod_fkusuario', 'comentario_dislike');
        $this->dropForeignKey('cod_fkcomentario', 'comentario_dislike');

        // Eliminar clave foránea de la tabla publicacion_visita
        $this->dropForeignKey('puv_fkusuario', 'publicacion_visita');
        $this->dropForeignKey('puv_fkpublicacion', 'publicacion_visita');

        // Eliminar clave foránea de la tabla publicacion_like
        $this->dropForeignKey('pul_fkusuario', 'publicacion_like');
        $this->dropForeignKey('pul_fkpublicacion', 'publicacion_like');

        // Eliminar clave foránea de la tabla publicacion_dislike
        $this->dropForeignKey('pud_fkusuario', 'publicacion_dislike');
        $this->dropForeignKey('pud_fkpublicacion', 'publicacion_dislike');

        // Eliminar la tabla comentario
        $this->dropTable('comentario');

        // Eliminar la tabla comentario_like
        $this->dropTable('comentario_like');

        // Eliminar la tabla comentario_dislike
        $this->dropTable('comentario_dislike');

        // Eliminar la tabla publicacion_visita
        $this->dropTable('publicacion_visita');

        // Eliminar la tabla publicacion_like
        $this->dropTable('publicacion_like');

        // Eliminar la tabla publicacion_dislike
        $this->dropTable('publicacion_dislike');        
    }    

    /*
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m240304_002251_migration1 cannot be reverted.\n";

        return false;
    }
    */
}
