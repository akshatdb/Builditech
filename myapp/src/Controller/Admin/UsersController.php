<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * Users Controllerre;
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index($role = null)
    {
        $this->set('role',$role);
        $this->viewBuilder()->setLayout('customer');
        $query = $this->Users->find('all')->where(['role' => $role]);
        $this->set('users', $this->paginate($query));
        $this->set('_serialize', ['users']);
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $this->viewBuilder()->setLayout('customer');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $this->viewBuilder()->setLayout('authentication');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        $this->set('role',$user->role);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->request->referer());
    }
    public function login(){
        $this->viewBuilder()->setLayout('authentication');
        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                $this->Flash->success("Logged in successfully");
                return $this->redirect(['prefix'=>'admin','controller' => 'Pages','action' => 'display','admin']);
            }
            $this->Flash->error("Invalid Credentials");
        }
    }
    public function logout(){
        $this->Flash->success('You are logged out');
        $this->Auth->logout();
        return $this->redirect(['prefix' => false,'controller' => 'Pages','action' => 'display','home']);
    }
    public function register($role = null){
        $this->viewBuilder()->setLayout('authentication');
        $user = $this->Users->newEntity();
        $this->set('role',$role);
        if($this->request->is('post')){
            $user = $this->Users->patchEntity($user,$this->request->data);
            if($this->Users->save($user)){
                $this->Flash->success(ucwords($role).' was registered');
                return $this->redirect(['controller' =>'Pages','action'=>'display','admin']);
            }
            else
                $this->Flash->error("Something went wrong");
        }
        $this->set(compact('user'));
        $this->set('__serialize',['user']);
    }
    public function checkAvailable(){
        $emailid = $this->request->getData('emailid');
        $list = TableRegistry::get('Users')->find('all',['conditions' => ['Users.emailid =' => $emailid]]);
        $this->set('check',$list);
    }

}
