<?php
namespace App\Controller\Admin;

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
    public $paginate = ['limit' => 5,
    'order' => ['created' => 'desc']]; 
    public function index()
    {
        $bookings = $this->paginate($this->Bookings);
        $this->viewBuilder()->setLayout('bookings');
        $this->set(compact('bookings'));
        $this->set('_serialize', ['bookings']);
    }
    public function edit($id = null)
    {
        $booking = $this->Bookings->get($id, [
            'contain' => []
        ]);
        $plotsTable = TableRegistry::get('Plots');
        $projectsTable = TableRegistry::get('Projects');
        $this->viewBuilder()->setLayout('customer');
        $this->set('projects',$projectsTable->find('list'));
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            $plots = preg_split('/[\s,]+/',$this->request->getData()['plotno']);
            unset($booking['plotno']);
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

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $this->set(compact('booking', 'projects'));
        $this->set('_serialize', ['booking']);
    }
    public function confirm($id = null)
    {
        $this->request->allowMethod(['post', 'patch']);
        $booking = $this->Bookings->get($id, [
            'contain' => []
        ]);
        $this->autoRender = false;
        if ($this->request->is(['patch', 'post'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            $booking->confirmed = 1;
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been confirmed.'));

                return $this->redirect($this->referer());
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }

    }
        public function unconfirm($id = null)
    {
        $this->request->allowMethod(['post', 'patch']);
        $booking = $this->Bookings->get($id, [
            'contain' => []
        ]);
        $this->autoRender = false;
        if ($this->request->is(['patch', 'post'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            $booking->confirmed = 0;
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been unconfirmed.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }

    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    public function print($id = null)
    {
        if($this->request->is('post'))
            $id = $this->request->getData('id');
        $this->viewBuilder()->setLayout('print');
        try
        {
        $bookings = $this->Bookings->get($id,[
            'contain' => ['Plots','Plots.Projects']
        ]);
        $query = $this->Bookings->Plots->find('all');
        $query->select(['count'=>$query->func()->count('*')]);
        $this->set('count',$query->toArray()[0]->count);
        $this->set('bookings',$bookings);
        }
        catch(\Exception $e)
        {
            $this->render('/Element/custom_error');
        }
    }
    public function listBookings()
    {
        $this->viewBuilder()->setLayout('ajax');
        $bookings = $this->paginate(TableRegistry::get('Bookings')->find('all',['conditions' => ['Bookings.confirmed <>' => '1']])) ;
        $this->set(compact('bookings'));
        $this->set('_serialize', ['bookings']);
    }
}
