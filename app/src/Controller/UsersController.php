<?php
namespace App\Controller;

use Cake\Http\Exception\BadRequestException;

class UsersController extends AppController
{
     public function initialize()
     {
        parent::initialize();
//        $this->Auth->allow(['add','login']);

     }

    public function index(){
      $this->set(['users'=>$this->Users->find()]);
    }

    public function login()
    {
        if ($this->request->is('post')) {
          $user = $this->Auth->identify();
          if ($user) {
            $this->Auth->setUser($user);
            $this->set(['user'=>$user]);
            return;
          }
        }
        throw new BadRequestException('ユーザー情報が間違っています');
    }



    public function add()
    {
        $user = $this->Users->newEntity($this->request->getData());
        if ($this->request->is('post')) {
            if ($this->Users->save($user)) {
              $this->set(['user' => $user]);
              return;
            }
            throw new BadRequestException('登録ができません');
        }
        throw new BadRequestException('post送信をしてください');
    }

}
