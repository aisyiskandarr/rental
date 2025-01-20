<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * BookingsFixture
 */
class BookingsFixture extends TestFixture
{
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
                'users_id' => 1,
                'vehicles_id' => 1,
                'booking_date' => '2025-01-18',
                'nric' => 'Lorem ipsum dolor sit amet',
                'license' => 'Lorem ipsum dolor sit amet',
                'license_dir' => 'Lorem ipsum dolor sit amet',
                'start_date' => '2025-01-18 19:13:28',
                'end_date' => '2025-01-18 19:13:28',
                'hours' => 1,
                'total_amount' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2025-01-18 19:13:28',
                'modified' => '2025-01-18 19:13:28',
            ],
        ];
        parent::init();
    }
}
