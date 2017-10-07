<?php
namespace App\Controller\Api\Admin;

use App\Controller\Api\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
/**
 * Projects Controller
 *
 * @property \App\Model\Table\ProjectsTable $Projects
 *
 * @method \App\Model\Entity\Project[] paginate($object = null, array $settings = [])
 */
class ProjectsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $projects = $this->paginate($this->Projects);
        $this->viewBuilder()->setLayout('customer');
        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
    }

    /**
     * View method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Projects', 'Customers']
        ]);

        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $project = $this->Projects->newEntity();
        if ($this->request->is('post')) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($saved = $this->Projects->save($project)) {
                $this->set('message','succesful');
            }
            $this->set('message','unsuccesful');
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project','message']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $project = $this->Projects->patchEntity($project, $this->request->getData());
            if ($this->Projects->save($project)) {
                $this->set('message','succesful');
            }
            $this->set('message','unsuccesful');
        }
        $this->set(compact('project'));
        $this->set('_serialize', ['project','message']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Project id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $project = $this->Projects->get($id);
        if ($this->Projects->delete($project)) {
            $this->set('message','succesful');
        } else {
            $this->set('message','unsuccesful');
        }

        $this->set('_serialize',['message']);
    }
    public function getGrid(){
        $plotsTable = TableRegistry::get('Plots');
        $id = $this->request->getData('id');
        $bookedplots = $plotsTable->find('list')->where(['Plots.project_id =' => $id])->toArray();
        $plots = $this->Projects->get($id)['noplots'];
        $amount = $this->Projects->get($id)['amount'];
        $this->set('bookedplots', array_values($bookedplots));
        $this->set('plots', $plots);
        $this->set('amount',$amount);
    }
}
