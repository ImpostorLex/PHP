<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Validation\Validator;

/**
 * Blog Controller
 *
 * @property \App\Model\Table\BlogTable $Blog
 */
class BlogController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */


    public function index()
    {
        $query = $this->Blog->find()
            ->contain(['User']);
        $blog = $this->paginate($query);

        $this->set(compact('blog'));
    }

    /**
     * View method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $blog = $this->Blog->get($id, contain: ['User']);
        $this->set(compact('blog'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $blog = $this->Blog->newEmptyEntity();
        if ($this->request->is('post')) {
            $blog = $this->Blog->patchEntity($blog, $this->request->getData());

            // Handle file upload
            $file = $this->request->getData('imgs');

            if ($file) {
                $fileName = $file->getClientFilename();
                $targetPath = WWW_ROOT . 'uploads' . DS . $fileName;
                $allowedExtensions = ['png', 'jpg', 'jpeg'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Move the file only if it has a valid image extension
                    $file->moveTo($targetPath);
                    $blog->imgs = $fileName;
                } else {
                    // Handle invalid file extension (not an image)
                    $this->Flash->error('Please upload only images (png, jpg, jpeg)');
                    // You might want to redirect or perform other actions based on the error.
                }
            }

            if ($this->Blog->save($blog)) {
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blog could not be saved. Please, try again.'));
        }
        $user = $this->Blog->User->find('list', limit: 200)->all();
        $this->set(compact('blog', 'user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $blog = $this->Blog->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $blog = $this->Blog->patchEntity($blog, $this->request->getData());

            // Handle file upload
            $file = $this->request->getData('imgs');
            if ($file) {
                $fileName = $file->getClientFilename();
                $targetPath = WWW_ROOT . 'uploads' . DS . $fileName;
                $allowedExtensions = ['png', 'jpg', 'jpeg'];
                $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if (in_array($fileExtension, $allowedExtensions)) {
                    // Move the file only if it has a valid image extension
                    $file->moveTo($targetPath);
                    $blog->imgs = $fileName;
                } else {
                    // Handle invalid file extension (not an image)
                    $this->Flash->error('Please upload only images (png, jpg, jpeg)');
                    // You might want to redirect or perform other actions based on the error.
                }
            }
            if ($this->Blog->save($blog)) {
                $this->Flash->success(__('The blog has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The blog could not be saved. Please, try again.'));
        }
        $user = $this->Blog->User->find('list', limit: 200)->all();
        $this->set(compact('blog', 'user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Blog id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $blog = $this->Blog->get($id);
        if ($this->Blog->delete($blog)) {
            $this->Flash->success(__('The blog has been deleted.'));
        } else {
            $this->Flash->error(__('The blog could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function see($id)
    {
        // Fetch the blog post data by ID and include related user data
        $blog = $this->Blog->get($id, ['contain' => ['User']]);

        // Pass the blog data to the view
        $this->set(compact('blog'));
    }


}
