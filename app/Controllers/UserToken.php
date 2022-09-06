<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserTokenModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class UserToken extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new UserTokenModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('user', 'user.id_user = user_token.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result[] = [
                    'id_user_token' => $row['id_user_token'],
                    'nama_user' => $row['nama_user'],
                    'token_user_token' => $row['token_user_token'],
                    'noted_user_token' => $row['noted_user_token'],
                    'created_user_token' => $row['created_user_token'],
                    'updated_user_token' => $row['updated_user_token'],
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
        $data = $this->model
            ->join('user', 'user.id_user = user_token.id_user')
            ->where('id_user_token', $id)->findAll();
        if ($data) {

            foreach ($data as $row) {
                $result = [
                    'id_user_token' => $row['id_user_token'],
                    'nama_user' => $row['nama_user'],
                    'token_user_token' => $row['token_user_token'],
                    'noted_user_token' => $row['noted_user_token'],
                    'created_user_token' => $row['created_user_token'],
                    'updated_user_token' => $row['updated_user_token'],
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
            ->join('user', 'user.id_user = user_token.id_user')
            ->where('id_user_token', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model
            ->join('user', 'user.id_user = user_token.id_user')
            ->where('id_user_token', $id)->find();
        $result = [
            'id_user_token' => $isExists[0]['id_user_token'],
            'nama_user' => $isExists[0]['nama_user'],
            'token_user_token' => $isExists[0]['token_user_token'],
            'noted_user_token' => $isExists[0]['noted_user_token'],
            'created_user_token' => $isExists[0]['created_user_token'],
            'updated_user_token' => $isExists[0]['updated_user_token'],
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
        $data = $this->model->where('id_user_token', $id)->findAll();
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
