<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Vehicle Entity
 *
 * @property int $id
 * @property string $model
 * @property string $manufacturer
 * @property string $registration_no
 * @property string $color
 * @property string $type
 * @property string $rate_perhour
 * @property string $image
 * @property string $image_dir
 * @property int $status
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 */
class Vehicle extends Entity
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
        'model' => true,
        'manufacturer' => true,
        'registration_no' => true,
        'color' => true,
        'type' => true,
        'rate_perhour' => true,
        'image' => true,
        'image_dir' => true,
        'status' => true,
        'created' => true,
        'modified' => true,
    ];
}
