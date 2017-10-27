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
class VideosController extends AppController
{
    public function manage()
    {   
        $this->viewBuilder()->setLayout('customer');
        $this->paginate = ['contain' => ['Projects']];
        $videos = $this->paginate($this->Videos);
        $this->set(compact('videos'));
        $this->set('_serialize', ['videos']);
    }
    public function add($project_id = null)
    {
        $this->viewBuilder()->setLayout('bookings');
        $this->set('project_id', $project_id);
        $video = $this->Videos->newEntity();
        if ($this->request->is('post')) {
        $video = $this->Videos->patchEntity($video, $this->request->getData());
        if ($this->Videos->save($video)) {
            $this->Flash->success(__('The video has been saved.'));

            return $this->redirect(['controller' => 'Pages', 'action' => 'display','admin']);
        }
        $this->Flash->error(__('The video could not be saved. Please, try again.'));
        }
        $this->set(compact('video', 'projects'));
        $this->set('_serialize', ['video']);
    }
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $video = $this->Videos->get($id);
        if ($this->Videos->delete($video)) {
            $this->Flash->success(__('The video has been deleted.'));
        } else {
            $this->Flash->error(__('The video could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'manage']);
    }
}
