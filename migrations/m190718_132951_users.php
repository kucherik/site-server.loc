<?php

use yii\db\Migration;

/**
 * Class m190718_132951_users
 */
class m190718_132951_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('users', [
            'id' => $this->primaryKey(),
            'login' => $this->string()->notNull()->unique(),
            'email' => $this->string(),
            'created' => $this->integer(),
            'updated' => $this->integer(),
        ]);


        $rows = [];
        for($i = 0; $i < 2500; $i++){
            $faker = \Faker\Factory::create();
            $rows[] = [
                $faker->firstName . $faker->unique()->randomDigitNotNull . $faker->lastName . $faker->unique()->randomDigitNotNull,
                $faker->email,
                $faker->unixTime(1000000),
                $faker->unixTime('now')
            ];
        }
        $this->batchInsert('users',[
            'login',
            'email',
            'created',
            'updated'
        ],$rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('users');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190718_132951_users cannot be reverted.\n";

        return false;
    }
    */
}
