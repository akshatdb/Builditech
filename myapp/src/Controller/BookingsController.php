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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $booking = $this->Bookings->patchEntity($booking, $this->request->getData());
            if ($this->Bookings->save($booking)) {
                $this->Flash->success(__('The booking has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The booking could not be saved. Please, try again.'));
        }
        $projects = $this->Bookings->Projects->find('list', ['limit' => 200]);
        $this->set(compact('booking', 'projects'));
        $this->set('_serialize', ['booking']);
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
            $this->Flash->success(__('The booking has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
