<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

/**
 * Comments Controller
 *
 * @property \App\Model\Table\CommentsTable $Comments
 *
 * @method \App\Model\Entity\Comment[] paginate($object = null, array $settings = [])
 */
class CommentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
     public $paginate = ['limit' => 5,
             'order' => ['created' => 'desc']];
    public function index()
    {
        $id = $this->request->data['id'];
        $this->viewBuilder()->setLayout('listAjax');
        $comments = $this->paginate(TableRegistry::get('comments')->find('all')->where(['project_id =' => $id])) ;

        $this->set(compact('comments'));
        $this->set('_serialize', ['comments']);
    }

    /**
     * View method
     *
     * @param string|null $id Comment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comment = $this->Comments->get($id, [
            'contain' => ['Projects']
        ]);

        $this->set('comment', $comment);
        $this->set('_serialize', ['comment']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $ip = $this->request->clientip();
        $comment = $this->Comments->newEntity();
        if ($this->request->is('post')) {
            $comment = $this->Comments->patchEntity($comment, $this->request->getData());
            $comment['created'] = Time::now();
            $comment['modified'] = Time::now();
            $comment['ip'] = $ip;
            $count = $this->Comments->find('all')->where(['Comments.ip =' => $ip])->count();
            if($count < 3)
            {if ($this->Comments->save($comment)) {
                $this->Flash->success(__('The comment has been saved.'));

                return $this->redirect($this->request->referer());
            }}
            else
            { 
                $this->Flash->error('Only 3 comments allowed for now!');
                return $this->redirect($this->request->referer());
            }
            $this->Flash->error(__('The comment could not be saved. Please, try again.'));
            return $this->redirect($this->request->referer());
        }
        $projects = $this->Comments->Projects->find('list', ['limit' => 200]);
        $this->set(compact('comment', 'projects'));
        $this->set('_serialize', ['comment']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comment = $this->Comments->get($id);
        if ($this->Comments->delete($comment)) {
            $this->Flash->success(__('The comment has been deleted.'));
        } else {
            $this->Flash->error(__('The comment could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->request->referer());
    }
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['index','add']);
    }
}
