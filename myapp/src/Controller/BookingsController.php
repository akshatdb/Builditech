<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * Bookings Controller
 *
 * @property \App\Model\Table\BookingsTable $Bookings
 *
 * @method \App\Model\Entity\Booking[] paginate($object = null, array $settings = [])
 */
class BookingsController extends AppController
{
    public function add()
    {
        $plotsTable = TableRegistry::get('Plots');
        $projectsTable = TableRegistry::get('Projects');
        $this->viewBuilder()->setLayout('customer');
        $booking = $this->Bookings->newEntity();
        $this->set('projects',$projectsTable->find('list'));
        if ($this->request->is('post')) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            $plots = preg_split('/[\s,]+/',$this->request->getData()['plotno']);
            unset($booking['plotno']);
            if($this->Auth->user()['role'] == 'admin')
                $booking->confirmed=1;
            else
                $booking->confirmed=0;
            if ($saved = $this->Bookings->save($booking)) {
            foreach($plots as $plot)
                {
                            $p = $plotsTable->newEntity();
                            $p->plotno = $plot;
                            $p->project_id = $saved->project_id;
                            $p->booking_id = $saved->id;
                            $plotsTable->save($p);
                }
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['controller' => 'Pages' ,'action' => 'display','home']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $this->set(compact('booking'));
        $this->set('_serialize', ['booking']);
    }
}
