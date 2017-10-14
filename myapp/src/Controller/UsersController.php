<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;

/**
 * Users Controller
 *
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
    public function login(){
        $this->viewBuilder()->setLayout('authentication');
        if($this->request->is('post')){
            $user = $this->Auth->identify();
            if($user){
                $this->Auth->setUser($user);
                $this->Flash->success("Logged in successfully");
                if ($user['role'] == 'admin')
                return $this->redirect('../admin/adminpanel');
                else 
                return $this->redirect(['prefix' => false,'controller' => 'pages','action' => 'display','home']);
            }
            $this->Flash->error("Invalid Credentials");
        }
    }
    public function logout(){
        $this->Flash->success('You are logged out');
        return $this->redirect($this->Auth->logout());
    }
    public function getUser(ServerRequest $request)
    {
    $username = env('PHP_AUTH_USER');
    $pass = env('PHP_AUTH_PW');

    if (empty($username) || empty($pass)) {
        return false;
    }
    return $this->_findUser($username, $pass);
    }
    
}
