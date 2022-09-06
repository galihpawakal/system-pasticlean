<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class User extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result[] = [
                    'id_user' => $row['id_user'],
                    'email_user' => $row['email_user'],
                    'nama_user' => $row['nama_user'],
                    'password_user' => $row['password_user'],
                    'notelp_user' => $row['notelp_user'],
                    'image_user' => $row['image_user'],
                    'active_user' => $row['active_user'],
                    'noted_user' => $row['noted_user'],
                    'created_user' => $row['created_user'],
                    'updated_user' => $row['updated_user'],
                ];
            }
            return $this->respond([
                'code' => 201,
                'status' => 'success',
                'data' => $result
            ], 200);
        } else {
            return $this->respond([
                'code' => 201,
                'status' => 'success',
                'data' => 'data not found'
            ], 200);
        }
    }
    public function show($id = null)
    {
        $data = $this->model->where('id_user', $id)->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result = [
                    'id_user' => $row['id_user'],
                    'email_user' => $row['email_user'],
                    'nama_user' => $row['nama_user'],
                    'password_user' => $row['password_user'],
                    'notelp_user' => $row['notelp_user'],
                    'image_user' => $row['image_user'],
                    'active_user' => $row['active_user'],
                    'noted_user' => $row['noted_user'],
                    'created_user' => $row['created_user'],
                    'updated_user' => $row['updated_user'],
                ];
            }
            return $this->respond([
                'code' => 201,
                'status' => 'success',
                'data' => $result
            ]);
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
        $data = $this->request->getPost();
        $save = $this->model->save($data);
        if ($save) {
            $response = [
                'code' => 201,
                'status' => 'success',
                'data' => $data
            ];
            return $this->respond($response);
        } else {
            $response = [
                'code' => 201,
                'status' => 'error',
                'message' => $this->model->errors()
            ];
            return $this->respond($response);
        }
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        $isExists = $this->model->where('id_user', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model->where('id_user', $id)->find();
        $result = [
            'id_user' => $isExists[0]['id_user'],
            'email_user' => $isExists[0]['email_user'],
            'nama_user' => $isExists[0]['nama_user'],
            'password_user' => $isExists[0]['password_user'],
            'notelp_user' => $isExists[0]['notelp_user'],
            'image_user' => $isExists[0]['image_user'],
            'active_user' => $isExists[0]['active_user'],
            'noted_user' => $isExists[0]['noted_user'],
            'created_user' => $isExists[0]['created_user'],
            'updated_user' => $isExists[0]['updated_user'],
        ];
        if ($update) {
            $response = [
                'code' => 201,
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
        $data = $this->model->where('id_user', $id)->findAll();
        if ($data) {
            $this->model->delete($id);
            $response = [
                'code' => 201,
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
