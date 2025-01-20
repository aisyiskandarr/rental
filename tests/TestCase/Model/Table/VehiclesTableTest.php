<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VehiclesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VehiclesTable Test Case
 */
class VehiclesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\VehiclesTable
     */
    protected $Vehicles;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.Vehicles',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Vehicles') ? [] : ['className' => VehiclesTable::class];
        $this->Vehicles = $this->getTableLocator()->get('Vehicles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Vehicles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\VehiclesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
