<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\RoomProblemModel;
use App\Models\RoomProblemAttachModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class RoomProblemAttach extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new RoomProblemAttachModel();
        $this->modelRoomProblem = new RoomProblemModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('room_problem', 'room_problem.id_room_problem = room_problem_attach.id_room_problem')
            ->join('user', 'user.id_user = room_problem_attach.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_room_problem_attach' => $key['id_room_problem_attach'],
                    'pelapor_room_problem' => $key['pelapor_room_problem'],
                    'nama_user' => $key['nama_user'],
                    'file_room_problem_attach' => $key['file_room_problem_attach'],
                    'foto_room_problem_attach' => $key['foto_room_problem_attach'],
                    'status_room_problem_attach' => $key['status_room_problem_attach'],
                    'noted_room_problem_attach' => $key['noted_room_problem_attach'],
                    'created_room_problem_attach' => $key['created_room_problem_attach'],
                    'updated_room_problem_attach' => $key['updated_room_problem_attach'],
                ];
            }
            return $this->respond([
                'code' => 202,
                'status' => 'success',
                'data' => $result
            ], 200);
        } else {
            return $this->respond([
                'code' => 202,
                'status' => 'error',
                'data' => 'data not found'
            ], 200);
        }
    }
    public function show($id = null)
    {
        $data = $this->model
            ->join('room_problem', 'room_problem.id_room_problem = room_problem_attach.id_room_problem')
            ->join('user', 'user.id_user = room_problem_attach.id_user')
            ->where('id_room_problem_attach', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_room_problem_attach' => $key['id_room_problem_attach'],
                    'pelapor_room_problem' => $key['pelapor_room_problem'],
                    'nama_user' => $key['nama_user'],
                    'file_room_problem_attach' => $key['file_room_problem_attach'],
                    'foto_room_problem_attach' => $key['foto_room_problem_attach'],
                    'status_room_problem_attach' => $key['status_room_problem_attach'],
                    'noted_room_problem_attach' => $key['noted_room_problem_attach'],
                    'created_room_problem_attach' => $key['created_room_problem_attach'],
                    'updated_room_problem_attach' => $key['updated_room_problem_attach'],
                ];
            }
            return $this->respond([
                'code' => 202,
                'status' => 'success',
                'data' => $result
            ], 200);
        } else {
            $response = [
                'code' => 402,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
    }

    public function create()
    {
        $id_room_problem = $this->request->getVar('id_room_problem');
        $isExists = $this->modelRoomProblem->where('id_room_problem', $id_room_problem)->findAll();
        if (!$isExists) {
            $response = [
                'code' => 402,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $id_user = $this->request->getVar('id_user');
        $isExists = $this->modelUser->where('id_user', $id_user)->findAll();
        if (!$isExists) {
            $response = [
                'code' => 402,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $data = $this->request->getPost();
        $save = $this->model->save($data);

        if ($save) {
            $response = [
                'code' => 202,
                'status' => 'success',
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            $response = [
                'code' => 202,
                'status' => 'error',
                'message' => $this->model->errors()
            ];
            return $this->respond($response);
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $isExists = $this->model
            ->join('room_problem', 'room_problem.id_room_problem = room_problem_attach.id_room_problem')
            ->join('user', 'user.id_user = room_problem_attach.id_user')
            ->where('id_room_problem_attach', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 402,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model
            ->join('room_problem', 'room_problem.id_room_problem = room_problem_attach.id_room_problem')
            ->join('user', 'user.id_user = room_problem_attach.id_user')
            ->where('id_room_problem_attach', $id)->find();
        $result = [
            'id_room_problem_attach' => $isExists[0]['id_room_problem_attach'],
            'pelapor_room_problem' => $isExists[0]['pelapor_room_problem'],
            'nama_user' => $isExists[0]['nama_user'],
            'file_room_problem_attach' => $isExists[0]['file_room_problem_attach'],
            'noted_room_problem_attach' => $isExists[0]['noted_room_problem_attach'],
            'created_room_problem_attach' => $isExists[0]['created_room_problem_attach'],
            'updated_room_problem_attach' => $isExists[0]['updated_room_problem_attach'],
        ];
        if ($update) {
            $response = [
                'code' => 202,
                'status' => 'success',
                'data' => $result
            ];
            return $this->respond($response);
        } else {
            $response = [
                'code' => 402,
                'status' => 'error',
                'data' => $this->model->errors()
            ];
            return $this->respond($response);
        }
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id_room_problem_attach', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'code' => 202,
                'status' => 'success',
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'code' => 402,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
    }
}
