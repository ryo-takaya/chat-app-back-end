<?php
namespace App\Controller;

use Cake\Http\Exception\BadRequestException;

class UsersController extends AppController
{
     public function initialize()
     {
        parent::initialize();
        $this->Auth->allow(['add','login']);

     }

    public function index(){
      $this->set(['users'=>$this->Users->find()]);
    }

    public function login()
    {
      if($this->Auth->user('id')){
        $this->set(['iii'=>9]);
        return ;
      }
        if ($this->request->is('post')) {
          $user = $this->Auth->identify();
          if ($user) {
            $this->Auth->setUser($user);
            $this->set(['user'=>$user]);
          }
        }
        // throw new BadRequestException('ユーザー情報が間違っています');
    }



    public function add()
    {

        $user = $this->Users->newEntity($this->request->getData());

        var_dump($this->request->getData());
        if ($this->request->is('post')) {
          var_dump('seikousippai');
            if ($this->Users->save($user)) {
              var_dump('seikou');
              $this->set(['user' => $user]);
            }
            throw new BadRequestException('登録ができません');
        }

    }

}
