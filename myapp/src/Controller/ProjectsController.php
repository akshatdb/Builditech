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
            'contain' => ['Plots','Images','Videos']
        ]);

        $this->set('project', $project);
        $this->set('_serialize', ['project']);
    }
    public function getGrid(){
        $id = $this->request->getData('id');
                $project = $this->Projects->get($id, [
            'contain' => ['Plots']
        ]);
        $this->set('bookedplots', array_values($project['plots']));
        $this->set('plots', $project->noplots);
        $this->set('amount',$project->amount);
    }
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['view','getGrid']);
    }
}
