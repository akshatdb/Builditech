<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Mailer\Email;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Contact Controller
 *
 * @property \App\Model\Table\ContactTable $Contact
 *
 * @method \App\Model\Entity\Contact[] paginate($object = null, array $settings = [])
 */
class ContactController extends AppController
{
    public $paginate = ['limit' => 5];

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contact = $this->Contact->newEntity();
        if ($this->request->is('post')) {
            $contact = $this->Contact->patchEntity($contact, $this->request->getData(),['validate' => 'default']);
            if ($this->Contact->save($contact)) {
                try{$email = new Email('default');
                $email->viewVars(['name' => $contact->name, 'number' => $contact->contact, 'email' => $contact->email, 'message' => $contact->body]);
                $email->from(['bulditest@gmail.com' => 'BuildiTech'])
                        ->template('default')
                        ->emailFormat('html')   
                        ->to('akshatdb@outlook.com')
                        ->subject('BuildiTech Contact')
                        ->send();
                    $this->Flash->success(__('Sent!'));
                    return $this->redirect($this->referer());
                }catch(\Exception $e){
                    $this->Flash->error('failed: '.$e->message);
                }
            }
            $this->Flash->error(__('Something went wrong!'));
            return $this->redirect($this->referer());
        }
        $this->set(compact('contact'));
        $this->set('_serialize', ['contact']);
    }
    public function beforefilter(Event $event){
        $this->Auth->allow(['add']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contact = $this->Contact->get($id);
        if ($this->Contact->delete($contact)) {
            $this->Flash->success(__('The contact has been deleted.'));
        } else {
            $this->Flash->error(__('The booking could not be deleted. Please, try again.'));
        }

        return $this->redirect($this->referer());
    }
}
