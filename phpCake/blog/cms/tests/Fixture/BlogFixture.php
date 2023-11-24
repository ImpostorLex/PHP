<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BlogFixture
 */
class BlogFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public string $table = 'blog';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'title' => 'Lorem ipsum dolor sit amet',
                'short_desc' => 'Lorem ipsum dolor sit amet',
                'imgs' => 'Lorem ipsum dolor sit amet',
                'blogs' => 'Lorem ipsum dolor sit amet',
                'user_id' => 1,
            ],
        ];
        parent::init();
    }
}
