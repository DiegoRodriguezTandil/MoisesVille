<?php

use yii\db\Migration;

class m160714_201409_addColumnStatusTableUser extends Migration
{


 public function up()
{
    $this->addColumn('user', 'status',  $this->smallInteger()->notNull()->defaultValue(10));
     $this->addColumn('user','password_hash', $this->string()->notNull());
       $this->addColumn('user', 'password_reset_token', $this->string());


}

   
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
*/
    public function safeDown()
    {
      //  $this->dropColumn('user', 'status');
         $this->dropColumn('user', 'password_hash');
        // $this->dropColumn('user', 'password_reset_token');
    }
    
}

