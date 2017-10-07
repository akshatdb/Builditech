<?php
namespace App\Controller\Api;

use Cake\ORM\TableRegistry;
use App\Controller\Api\AppController;


/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 *
 * @method \App\Model\Entity\Booking[] paginate($object = null, array $settings = [])
 */
class BookingsController extends AppController
{
    public $paginate = ['limit' => 5]; 
    public function add()
    {
        $plotsTable = TableRegistry::get('Plots');
        $projectsTable = TableRegistry::get('Projects');
        $booking = $this->Bookings->newEntity();
        $this->set('projects',$projectsTable->find('list'));
        if ($this->request->is('post')) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            $plots = preg_split('/[\s,]+/',$this->request->getData()['plotno']);
            unset($booking['plotno']);
            $booking->confirmed=1;
            if ($saved = $this->Bookings->save($booking)) {
            foreach($plots as $plot)
                {
                            $p = $plotsTable->newEntity();
                            $p->plotno = $plot;
                            $p->project_id = $saved->project_id;
                            $p->booking_id = $saved->id;
                            $plotsTable->save($p);
                }
                    $this->set('message','successful');   
            }
            $this->set('message','unsuccessful');
        }
        $this->set(compact('booking'));
        $this->set('_serialize', ['booking','message']);
    }
}
