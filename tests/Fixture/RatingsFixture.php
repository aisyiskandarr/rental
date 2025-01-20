<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * RatingsFixture
 */
class RatingsFixture extends TestFixture
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
                'user_id' => 1,
                'bookings_id' => 1,
                'vehicles_id' => 1,
                'rate' => 'Lorem ipsum dolor sit amet',
                'comment' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2025-01-19 17:50:17',
                'modified' => '2025-01-19 17:50:17',
            ],
        ];
        parent::init();
    }
}
