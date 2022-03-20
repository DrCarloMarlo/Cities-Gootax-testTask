<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%review_cities_fk}}`.
 */
class m220320_171504_create_review_cities_fk_table extends Migration
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

        $this->createTable('{{%review_cities_fk}}', [
            'id' => $this->primaryKey(),
            'id_city' => $this->integer(11),
            'id_review' => $this->integer(11),
        ], $tableOptions);

        $this->addForeignKey(
            'reviews_cities_cities_id_fk',
            'review_cities_fk',
            'id_city',
            'cities',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'reviews_cities_reviews_id_fk',
            'review_cities_fk',
            'id_review',
            'reviews',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%review_cities_fk}}');

        $this->dropForeignKey(
            'reviews_cities_cities_id_fk',
            'review_cities_fk'
        );

        $this->dropForeignKey(
            'reviews_cities_reviews_id_fk',
            'review_cities_fk'
        );
    }
}
