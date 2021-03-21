<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\RoomsUsersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\RoomsUsersTable Test Case
 */
class RoomsUsersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\RoomsUsersTable
     */
    public $RoomsUsers;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.rooms_users',
        'app.users',
        'app.rooms'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('RoomsUsers') ? [] : ['className' => RoomsUsersTable::class];
        $this->RoomsUsers = TableRegistry::getTableLocator()->get('RoomsUsers', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->RoomsUsers);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
