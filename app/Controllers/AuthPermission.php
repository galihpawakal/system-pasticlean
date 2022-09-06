<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthPermissionModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AuthPermission extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new AuthPermissionModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result[] = [
                    'id_auth_permission' => $row['id_auth_permission'],
                    'nama_auth_permission' => $row['nama_auth_permission'],
                    'noted_auth_permission' => $row['noted_auth_permission'],
                    'created_auth_permission' => $row['created_auth_permission'],
                    'updated_auth_permission' => $row['updated_auth_permission'],
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
        $data = $this->model->where('id_auth_permission', $id)->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result = [
                    'nama_auth_permission' => $row['nama_auth_permission'],
                    'noted_auth_permission' => $row['noted_auth_permission'],
                    'created_auth_permission' => $row['created_auth_permission'],
                    'updated_auth_permission' => $row['updated_auth_permission'],
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
        $isExists = $this->model->where('id_auth_permission', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model->where('id_auth_permission', $id)->find();
        $result = [
            'nama_auth_permission' => $isExists[0]['nama_auth_permission'],
            'noted_auth_permission' => $isExists[0]['noted_auth_permission'],
            'created_auth_permission' => $isExists[0]['created_auth_permission'],
            'updated_auth_permission' => $isExists[0]['updated_auth_permission'],
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
        $data = $this->model->where('id_auth_permission', $id)->findAll();
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
