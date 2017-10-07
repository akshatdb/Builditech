<?php
namespace App\Controller;

use App\Controller\AppController;
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

    public function view($id = null)
    {
        $project = $this->Projects->get($id, [
            'contain' => ['Plots','Images']
        ]);

        $this->set('project', $project);
        $this->set('_serialize', ['project']);
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
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['view','getGrid']);
    }
}
