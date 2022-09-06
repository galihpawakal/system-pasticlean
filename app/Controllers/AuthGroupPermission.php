<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthGroupModel;
use App\Models\AuthGroupPermissionModel;
use App\Models\AuthPermissionModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AuthGroupPermission extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new AuthGroupPermissionModel();
        $this->modelAuthGroup = new AuthGroupModel();
        $this->modelAuthPermission = new AuthPermissionModel();
    }

    public function index()
    {
        $data = $this->model->join('auth_group', 'auth_group.id_auth_group = auth_group_permission.id_auth_group')
            ->join('auth_permission', 'auth_permission.id_auth_permission = auth_group_permission.id_auth_permission')
            ->findAll();
        if ($data) {
            foreach ($data as $row) {
                $result[] = [
                    'id_auth_group_permission' => $row['id_auth_group_permission'],
                    'nama_auth_permission' => $row['nama_auth_permission'],
                    'nama_auth_group' => $row['nama_auth_group'],
                    'noted_auth_group_permission' => $row['noted_auth_group_permission'],
                    'created_auth_group_permission' => $row['created_auth_group_permission'],
                    'updated_auth_group_permission' => $row['updated_auth_group_permission'],
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
        $data = $this->model->join('auth_group', 'auth_group.id_auth_group = auth_group_permission.id_auth_group')
            ->join('auth_permission', 'auth_permission.id_auth_permission = auth_group_permission.id_auth_permission')
            ->where('id_auth_group_permission', $id)->findAll();
        if ($data) {

            foreach ($data as $row) {
                $result = [
                    'id_auth_group_permission' => $row['id_auth_group_permission'],
                    'nama_auth_permission' => $row['nama_auth_permission'],
                    'nama_auth_group' => $row['nama_auth_group'],
                    'noted_auth_group_permission' => $row['noted_auth_group_permission'],
                    'created_auth_group_permission' => $row['created_auth_group_permission'],
                    'updated_auth_group_permission' => $row['updated_auth_group_permission'],
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
        $id_auth_permission = $this->request->getVar('id_auth_permission');
        $isExists = $this->modelAuthPermission->where('id_auth_permission', $id_auth_permission)->findAll();
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
        $isExists = $this->model->join('auth_group', 'auth_group.id_auth_group = auth_group_permission.id_auth_group')
            ->join('auth_permission', 'auth_permission.id_auth_permission = auth_group_permission.id_auth_permission')
            ->where('id_auth_group_permission', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model->join('auth_group', 'auth_group.id_auth_group = auth_group_permission.id_auth_group')
            ->join('auth_permission', 'auth_permission.id_auth_permission = auth_group_permission.id_auth_permission')
            ->where('id_auth_group_permission', $id)->find();
        $result = [
            'id_auth_group_permission' => $isExists[0]['id_auth_group_permission'],
            'nama_auth_permission' => $isExists[0]['nama_auth_permission'],
            'nama_auth_group' => $isExists[0]['nama_auth_group'],
            'noted_auth_group_permission' => $isExists[0]['noted_auth_group_permission'],
            'created_auth_group_permission' => $isExists[0]['created_auth_group_permission'],
            'updated_auth_group_permission' => $isExists[0]['updated_auth_group_permission'],
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
        $data = $this->model->where('id_auth_group_permission', $id)->findAll();
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
