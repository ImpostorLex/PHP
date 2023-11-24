<?php
declare(strict_types=1);

use Migrations\AbstractMigration;
use Phinx\Db\Action\AddForeignKey;

class CreateBlog extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('blog');

        $table->addColumn('title', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('short_desc', 'string', [
            'default' => null,
            'limit' => 100,
            'null' => false,
        ]);

        $table->addColumn('imgs', 'string', [
            'default' => null,
            'limit' => 255,
            'null' => false,
        ]);

        $table->addColumn('blogs', 'string', [
            'default' => null,
            'limit' => 350,
            'null' => false,
        ]);

        $table->addColumn('user_id', 'integer', [
            'default' => null,
            'null' => false,
        ]);

        $table->AddForeignKey('user_id', 'user', 'id', [
            'delete' => 'CASCADE',
            'update' => 'CASCADE',
            'constraint' => 'fk_blogs_users',
        ]);

        $table->create();


    }
}
