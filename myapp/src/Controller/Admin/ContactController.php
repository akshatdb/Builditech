<?php
namespace App\Controller\Admin;

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
    public function sendMail()
    {
        $email = new Email('default');
        $message = $this->request->getData('mailbody');
        $emailid = $this->request->getData('mailid');
        $email->viewVars(['message' => $message]);
        if($email->from(['bulditest@gmail.com' => 'BuildiTech'])
                        ->template('message')
                        ->emailFormat('html')   
                        ->to($emailid)
                        ->subject('BuildiTech Contact')
                        ->send()){
        $this->set("message","Sent Successfully");
        $this->set("code",1);}
        else
        {        $this->set("message","Failed");
                    $this->set("code",0);}
    }
    public function listContacts()
    {
        $this->viewBuilder()->setLayout('ajax');
        $contacts = $this->paginate(TableRegistry::get('contact')->find('all'),['scope' => 'contact'] ) ;
        $this->set(compact('contacts'));
        $this->set('_serialize', ['contacts']);
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
