<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Http\Exception\UnauthorizedException;
use Cake\ORM\TableRegistry;

class DashboardController extends AppController
{
    public function dash()
    {
        $userTable = TableRegistry::getTableLocator()->get('Blog');
        $blogs = $userTable->find()
            ->contain(['User'])
            ->all();

        $this->set('blogs', $blogs);



    }

    // Your logout action
    public function logout()
    {
        // Clear the 'key' session variable
        $this->request->getSession()->delete('key');

        // Optionally, destroy the entire session
        $this->request->getSession()->destroy();

        // Redirect to a desired location after logout
        return $this->redirect(['controller' => 'Login', 'action' => 'login']);
    }


}


