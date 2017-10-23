<?php
namespace App\Controller\Api;

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
    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow(['view', 'index', 'getGrid']);
        $user = $this->Auth->user();
    }
    public function index()
    {
        $projects = $this->paginate($this->Projects);
        $this->set(compact('projects'));
        $this->set('_serialize', ['projects']);
    }
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
                $project = $this->Projects->get($id, [
            'contain' => ['Plots']
        ]);
        $this->set('bookedplots', array_values($project['plots']));
        $this->set('plots', $project->noplots);
        $this->set('amount',$project->amount);
    }
}
