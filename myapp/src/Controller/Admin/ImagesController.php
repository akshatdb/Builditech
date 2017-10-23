<?php
namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * Images Controller
 *
 * @property \App\Model\Table\ImagesTable $Images
 *
 * @method \App\Model\Entity\Image[] paginate($object = null, array $settings = [])
 */
class ImagesController extends AppController
{
    public function manage()
    {   
        $this->paginate = ['contain' => ['Projects']];
        $this->viewBuilder()->setLayout('default');
        $images = $this->paginate($this->Images);
        $this->set(compact('images'));
        $this->set('_serialize', ['images']);
    }
    public function add($project_id = null)
    {
        $this->viewBuilder()->setLayout('customer');
        if (!empty($this->request->data['photo']['name'])) {
                $file = $this->request->data['photo']; //put the data into a var for easy use

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
                $arr_ext = array('jpg', 'jpeg', 'gif', 'png'); //set allowed extensions
                $setNewFileName = time() . "_" . rand(000000, 999999);

                //only process if the extension is valid
                if (in_array($ext, $arr_ext)) {
                //do the actual uploading of the file. First arg is the tmp name, second arg is 
                //where we are putting it
                move_uploaded_file($file['tmp_name'], WWW_ROOT . 'upload/projects/' . $setNewFileName . '.jpg');

                //prepare the filename for database entry 
                $imageFileName = $setNewFileName . '.jpg';
            }
        }
        $this->set('project_id', $project_id);
        $image = $this->Images->newEntity();
        if ($this->request->is('post')) {
        $image = $this->Images->patchEntity($image, $this->request->getData());
        if (!empty($this->request->data['photo']['name'])) {
            $image->photo = $imageFileName;
            $image->photo_dir = '/upload/projects/'.$imageFileName;
        }
        if ($this->Images->save($image)) {
            $this->Flash->success(__('The image has been saved.'));

            return $this->redirect(['controller' => 'Images', 'action' => 'add',$project_id]);
        }
        $this->Flash->error(__('The image could not be saved. Please, try again.'));
        }
        $this->set(compact('image', 'projects'));
        $this->set('_serialize', ['image']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $image = $this->Images->get($id);
        $path = $image->photo_dir;
        if ($this->Images->delete($image)) {
            unlink( WWW_ROOT.$path);
            $this->Flash->success(__('The image has been deleted.'));
        } else {
            $this->Flash->error(__('The image could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'manage']);
    }
}
