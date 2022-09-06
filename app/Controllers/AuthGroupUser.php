<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthGroupModel;
use App\Models\AuthGroupUserModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AuthGroupUser extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new AuthGroupUserModel();
        $this->modelAuthGroup = new AuthGroupModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model->join('auth_group', 'auth_group.id_auth_group = auth_group_user.id_auth_group')
            ->join('user', 'user.id_user = auth_group_user.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result[] = [
                    'id_auth_group_user' => $row['id_auth_group_user'],
                    'nama_user' => $row['nama_user'],
                    'nama_auth_group' => $row['nama_auth_group'],
                    'noted_auth_group_user' => $row['noted_auth_group_user'],
                    'created_auth_group_user' => $row['created_auth_group_user'],
                    'updated_auth_group_user' => $row['updated_auth_group_user'],
                ];
            }
            return $this->respond([
                'code' => 202,
                'status' => 'success',
                'data' => $result
            ], 300);
        } else {
            return $this->respond([
                'code' => 202,
                'status' => 'error',
                'data' => 'data not found'
            ], 300);
        }
    }
    public function show($id = null)
    {
        $data = $this->model->join('auth_group', 'auth_group.id_auth_group = auth_group_user.id_auth_group')
            ->join('user', 'user.id_user = auth_group_user.id_user')
            ->where('id_auth_group_user', $id)->findAll();
        if ($data) {

            foreach ($data as $row) {
                $result = [
                    'id_auth_group_user' => $row['id_auth_group_user'],
                    'nama_user' => $row['nama_user'],
                    'nama_auth_group' => $row['nama_auth_group'],
                    'noted_auth_group_user' => $row['noted_auth_group_user'],
                    'created_auth_group_user' => $row['created_auth_group_user'],
                    'updated_auth_group_user' => $row['updated_auth_group_user'],
                ];
            }
            return $this->respond([
                'code' => 202,
                'status' => 'success',
                'data' => $result
            ], 300);
        } else {
            $response = [
                'code' => 401,
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
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $id_auth_group = $this->request->getVar('id_auth_group');
        $isExists = $this->modelAuthGroup->where('id_auth_group', $id_auth_group)->findAll();
        if (!$isExists) {
            $response = [
                'code' => 401,
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
        $isExists = $this->model->join('auth_group', 'auth_group.id_auth_group = auth_group_user.id_auth_group')
            ->join('user', 'user.id_user = auth_group_user.id_user')
            ->where('id_auth_group_user', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model->join('auth_group', 'auth_group.id_auth_group = auth_group_user.id_auth_group')
            ->join('user', 'user.id_user = auth_group_user.id_user')
            ->where('id_auth_group_user', $id)->find();
        $result = [
            'id_auth_group_user' => $isExists[0]['id_auth_group_user'],
            'nama_user' => $isExists[0]['nama_user'],
            'nama_auth_group' => $isExists[0]['nama_auth_group'],
            'noted_auth_group_user' => $isExists[0]['noted_auth_group_user'],
            'created_auth_group_user' => $isExists[0]['created_auth_group_user'],
            'updated_auth_group_user' => $isExists[0]['updated_auth_group_user'],
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
                'code' => 401,
                'status' => 'error',
                'data' => $this->model->errors()
            ];
            return $this->respond($response);
        }
    }

    public function delete($id = null)
    {
        $data = $this->model->where('id_auth_group_user', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'code' => 202,
                'status' => 'success',
            ];
            return $this->respondDeleted($response);
        } else {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
    }
}
