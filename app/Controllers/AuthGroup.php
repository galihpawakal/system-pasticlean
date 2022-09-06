<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthGroupModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AuthGroup extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new AuthGroupModel();
    }

    public function index()
    {
        $data = $this->model->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result[] = [
                    'id_auth_group' => $row['id_auth_group'],
                    'nama_auth_group' => $row['nama_auth_group'],
                    'noted_auth_group' => $row['noted_auth_group'],
                    'created_auth_group' => $row['created_auth_group'],
                    'updated_auth_group' => $row['updated_auth_group'],
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
        $data = $this->model->where('id_auth_group', $id)->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result = [
                    'nama_auth_group' => $row['nama_auth_group'],
                    'noted_auth_group' => $row['noted_auth_group'],
                    'created_auth_group' => $row['created_auth_group'],
                    'updated_auth_group' => $row['updated_auth_group'],
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
        $isExists = $this->model->where('id_auth_group', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model->where('id_auth_group', $id)->find();
        $result = [
            'nama_auth_group' => $isExists[0]['nama_auth_group'],
            'noted_auth_group' => $isExists[0]['noted_auth_group'],
            'created_auth_group' => $isExists[0]['created_auth_group'],
            'updated_auth_group' => $isExists[0]['updated_auth_group'],
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
        $data = $this->model->where('id_auth_group', $id)->findAll();
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
