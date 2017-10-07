<?php
namespace App\Controller\Api\Admin;

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
    public function index()
    {
        $bookings = $this->paginate($this->Bookings);
        $this->viewBuilder()->setLayout('bookings');
        $this->set(compact('bookings'));
        $this->set('_serialize', ['bookings']);
    }
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
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $this->set(compact('booking'));
        $this->set('_serialize', ['booking']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
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
        if ($this->request->is(['patch', 'post'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            $booking->confirmed = 0;
            if ($this->Bookings->save($booking)) {
                $this->set(compact('booking'));
            }
            else
                throw new Exception;

        }

    }

    /**
     * Delete method
     *
     * @param string|null $id Booking id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $booking = $this->Bookings->get($id);
        if ($this->Bookings->delete($booking)) {
            $this->set("message","Delete Succesful");
        } else {
            $this->set("message","Delete unsuccesful");;
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
