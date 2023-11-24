<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\UnauthorizedException;
use Cake\ORM\TableRegistry;

class LoginController extends AppController
{
    public function login()
    {
        if ($this->request->is('post')) {
            $username = $this->request->getData('username');
            $password = $this->request->getData('password');

            $userTable = TableRegistry::getTableLocator()->get('User');
            $user = $userTable->findByUsername($username)->first();

            if ($user && $password === $user->password) {
                $this->request->getSession()->write('key', $username);


                return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
            } else {
                $this->Flash->error(__('Invalid username or password, try again'));
            }
        }
    }

}


