<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Booking Entity
 *
 * @property int $id
 * @property int $users_id
 * @property int $vehicles_id
 * @property \Cake\I18n\Date $booking_date
 * @property string $nric
 * @property string $license
 * @property string $license_dir
 * @property \Cake\I18n\DateTime $start_date
 * @property \Cake\I18n\DateTime $end_date
 * @property int $hours
 * @property string $total_amount
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Vehicle $vehicle
 */
class Booking extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'users_id' => true,
        'vehicles_id' => true,
        'booking_date' => true,
        'nric' => true,
        'license' => true,
        'license_dir' => true,
        'start_date' => true,
        'end_date' => true,
        'hours' => true,
        'total_amount' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'vehicle' => true,
    ];
}
