<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BlogTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BlogTable Test Case
 */
class BlogTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\BlogTable
     */
    protected $Blog;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Blog',
        'app.User',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Blog') ? [] : ['className' => BlogTable::class];
        $this->Blog = $this->getTableLocator()->get('Blog', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Blog);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\BlogTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
