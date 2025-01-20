<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VehiclesFixture
 */
class VehiclesFixture extends TestFixture
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
                'model' => 'Lorem ipsum dolor sit amet',
                'manufacturer' => 'Lorem ipsum dolor sit amet',
                'registration_no' => 'Lorem ipsum dolor sit amet',
                'color' => 'Lorem ipsum dolor sit amet',
                'type' => 'Lorem ipsum dolor sit amet',
                'rate_perhour' => 'Lorem ipsum dolor sit amet',
                'image' => 'Lorem ipsum dolor sit amet',
                'image_dir' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created' => '2025-01-20 16:35:42',
                'modified' => '2025-01-20 16:35:42',
            ],
        ];
        parent::init();
    }
}
