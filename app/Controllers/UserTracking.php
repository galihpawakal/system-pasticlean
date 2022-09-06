<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\UserTrackingModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class UserTracking extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new UserTrackingModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('user', 'user.id_user = user_tracking.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_user_tracking' => $key['id_user_tracking'],
                    'nama_user' => $key['nama_user'],
                    'link_user_tracking' => $key['link_user_tracking'],
                    'noted_user_tracking' => $key['noted_user_tracking'],
                    'created_user_tracking' => $key['created_user_tracking'],
                    'updated_user_tracking' => $key['updated_user_tracking'],
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
            ->join('user', 'user.id_user = user_tracking.id_user')
            ->where('id_user_tracking', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_user_tracking' => $key['id_user_tracking'],
                    'nama_user' => $key['nama_user'],
                    'link_user_tracking' => $key['link_user_tracking'],
                    'noted_user_tracking' => $key['noted_user_tracking'],
                    'created_user_tracking' => $key['created_user_tracking'],
                    'updated_user_tracking' => $key['updated_user_tracking'],
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
            ->join('user', 'user.id_user = user_tracking.id_user')->where('id_user_tracking', $id)->find();
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
            ->join('user', 'user.id_user = user_tracking.id_user')->where('id_user_tracking', $id)->find();
        $result = [
            'id_user_tracking' => $isExists[0]['id_user_tracking'],
            'nama_user' => $isExists[0]['nama_user'],
            'link_user_tracking' => $isExists[0]['link_user_tracking'],
            'noted_user_tracking' => $isExists[0]['noted_user_tracking'],
            'created_user_tracking' => $isExists[0]['created_user_tracking'],
            'updated_user_tracking' => $isExists[0]['updated_user_tracking'],
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
        $data = $this->model->where('id_user_tracking', $id)->findAll();
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
