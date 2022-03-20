<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%reviews}}`.
 */
class m220320_162408_create_reviews_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%reviews}}', [
            'id' => $this->primaryKey(),
            'city_name' => $this->string(255),
            'title' => $this->string(100),
            'text' => $this->text(),
            'rating' => $this->integer(2),
            'img' => $this->string(255),
            'author_fio' => $this->string(255),
            'id_author' => $this->integer(11),
            'date_create' => $this->integer(11),
        ], $tableOptions);

        $this->addForeignKey(
            'reviews_author_id_fk',
            'reviews',
            'id_author',
            'author',
            'id',
            'CASCADE'
        );

        $this->createIndex(
            'idx-reviews-id_author',
            'reviews',
            'id_author'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%reviews}}');

        $this->dropForeignKey(
            'reviews_author_id_fk',
            'reviews'
        );

        $this->dropIndex(
            'idx-reviews-id_author',
            'reviews'
        );
    }
}
