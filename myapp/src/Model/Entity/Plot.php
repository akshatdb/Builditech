<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Plot Entity
 *
 * @property int $booking_id
 * @property int $plotno
 * @property int $project_id
 *
 * @property \App\Model\Entity\Booking $booking
 * @property \App\Model\Entity\Project $project
 */
class Plot extends Entity
{

}
