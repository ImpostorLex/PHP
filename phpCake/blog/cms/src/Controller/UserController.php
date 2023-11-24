<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * User Controller
 *
 * @property \App\Model\Table\UserTable $User
 */
class UserController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->User->find();
        $user = $this->paginate($query);

        $this->set(compact('user'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->User->get($id, contain: []);
        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->User->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->User->patchEntity($user, $this->request->getData());
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->User->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->User->patchEntity($user, $this->request->getData());
            if ($this->User->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
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
        $user = $this->User->get($id);
        if ($this->User->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function register()
    {
        // Create a new user object
        $user = $this->User->newEmptyEntity();
        $pass = $this->request->getData('password');


        // Check if request is post
        if ($this->request->is('post')) {
            // use the user-obj to query if the username field data already exists
            $existingUser = $this->User->findByUsername($this->request->getData('username'))->first();

            if ($existingUser) {
                $this->Flash->error(__('Username already exists. Please choose a different username.'));
            } else if ($pass && mb_strlen($pass, 'UTF-8') < 5) {
                $this->Flash->error(__('Password too weak, must be greater than 5'));
            } else {
                // Username doesn't exist, proceed with user registration
                $user = $this->User->patchEntity($user, $this->request->getData());

                if ($this->User->save($user)) {
                    $this->Flash->success(__('Registration successful. Please log in.'));
                    return $this->redirect(['controller' => 'Login', 'action' => 'login']);
                }
                $this->Flash->error(__('Unable to register. Please, try again.'));
                debug($user->getErrors());
            }
        }

        $this->set(compact('user'));
    }
}