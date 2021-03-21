<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Collection\Collection;
use Cake\Http\Exception\BadRequestException;

/**
 * Rooms Controller
 *
 * @property \App\Model\Table\RoomsTable $Rooms
 * @property \App\Model\Table\RoomsUsersTable $RoomsUsers
 * @property \App\Model\Table\RoomsUsersTable $Users
 * @method \App\Model\Entity\Room[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RoomsController extends AppController
{
    /**
     * @inheritDoc
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('RoomsUsers');
        $this->loadModel('Users');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->set(['rooms'=>$this->Rooms->find()]);
    }

    /**
     * View method
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        if(is_null($id)){
            throw new BadRequestException('idを指定してください');
        }

        $room = $this->RoomsUsers->find()->where([
            'room_id' => 'id'
        ]);

        $this->set('room', $room);
    }

    /**
     * Add method
     *
     * @param user_id ユーザーのidの配列
     * @param room_name 部屋名
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $usersId = $this->request->getData('user_id');
        $room = $this->Rooms->newEntity(['room_name'=>$this->request->getData('room_name')]);
        if ($this->request->is('post')) {
            $this->Rooms->getConnection()->transactional(function() use ($room,$usersId){
                $this->Rooms->saveOrFail($room);
                $roomId = $this->Rooms->find()->first()->id;
                foreach ($usersId as $userId){
                    $room_user = $this->RoomsUsers->newEntity([
                        'room_id' => $roomId,
                        'user_id' => $userId
                    ]);
                    $this->RoomsUsers->saveOrFail($room_user);
                }
            });
        } else {
            new BadRequestException('post送信でしてください');
        }
       $roomInfo = $this->Rooms->find()->where(['room_name' => $room->room_name])->first();
       $this->set(['room'=>$roomInfo]);
    }

    /**
     * EditName method 部屋名を編集する
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function editName($id = null)
    {
        if(is_null($id)){
            throw new BadRequestException('idを指定してください');
        }

        $room = $this->Rooms->get($id);
        $roomName = $this->request->getData('room_name');
        $room = $this->Rooms->patchEntity($room, ['room_name'=>$roomName]);
        $this->log($roomName);
        $this->Rooms->saveOrFail($room);
        $this->set(['room_name'=>$roomName]);
    }

    /**
     * EditRoomMember method 部屋に所属しているメンバーを編集する
     *
     * @param string|null $id Room id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     */
    public function editRoomMember($id = null)
    {
        if(is_null($id)){
            throw new BadRequestException('idを指定してください');
        }
        $userIds = $this->request->getData('user_ids');
        $room = $this->Rooms->get($id);
        foreach ($userIds as $userId) {
          $roomUser = $this->RoomsUsers->newEntity(['user_id'=>$userId,'room_id'=>$room->id]);
          $this->RoomsUsers->saveOrFail($roomUser);
        }
        $users = $this->Users->find()->where(function ($exp) use($userIds){
            return $exp->in('id',[$userIds]);
        });
        $this->set(['room'=>$room,'users'=>$users]);
    }

    /**
     * Delete method
     *
     * @param string|null $id Room id.
     */
    public function delete()
    {
        $id = $this->request->getData('id');
        $this->log($id);
        $room = $this->Rooms->get($id);
        $this->Rooms->getConnection()->transactional(function () use($room){
          $this->Rooms->deleteOrFail($room);
          $this->RoomsUsers->deleteAll(['room_id'=>$room->id]);
        });
        $response = $this->response->withStatus(204);
        $this->setResponse($response);
        return $this->render();
    }
}
