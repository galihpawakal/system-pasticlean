<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientRegion3Model;
use App\Models\AuthGroupModel;
use App\Models\UserClientModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class UserClient extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new UserClientModel();
        $this->modelAuthGroup = new AuthGroupModel();
        $this->modelClientRegion3 = new ClientRegion3Model();
    }

    public function index()
    {
        $data = $this->model->join('auth_group', 'auth_group.id_auth_group = user_client.id_auth_group')
            ->join('client_region_3', 'client_region_3.kd_client_region_3 = user_client.kd_client_region_3')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_user_client' => $key['id_user_client'],
                    'nama_auth_group' => $key['nama_auth_group'],
                    'nama_client_region_3' => $key['nama_client_region_3'],
                    'noted_user_client' => $key['noted_user_client'],
                    'created_user_client' => $key['created_user_client'],
                    'updated_user_client' => $key['updated_user_client'],
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
                'status' => 'error',
                'data' => 'data not found'
            ], 200);
        }
    }
    public function show($id = null)
    {
        $data = $this->model->join('auth_group', 'auth_group.id_auth_group = user_client.id_auth_group')
            ->join('client_region_3', 'client_region_3.kd_client_region_3 = user_client.kd_client_region_3')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_user_client' => $key['id_user_client'],
                    'nama_auth_group' => $key['nama_auth_group'],
                    'nama_client_region_3' => $key['nama_client_region_3'],
                    'noted_user_client' => $key['noted_user_client'],
                    'created_user_client' => $key['created_user_client'],
                    'updated_user_client' => $key['updated_user_client'],
                ];
            }
            return $this->respond([
                'code' => 201,
                'status' => 'success',
                'data' => $result
            ], 200);
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
        $kd_client_region_3 = $this->request->getVar('kd_client_region_3');
        $isExists = $this->modelClientRegion3->where('kd_client_region_3', $kd_client_region_3)->findAll();
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
        $isExists = $this->model->join('auth_group', 'auth_group.id_auth_group = user_client.id_auth_group')
            ->join('client_region_3', 'client_region_3.kd_client_region_3 = user_client.kd_client_region_3')->where('id_user_client', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model->join('auth_group', 'auth_group.id_auth_group = user_client.id_auth_group')
            ->join('client_region_3', 'client_region_3.kd_client_region_3 = user_client.kd_client_region_3')->where('id_user_client', $id)->find();
        $result = [
            'id_user_client' => $isExists[0]['id_user_client'],
            'nama_auth_group' => $isExists[0]['nama_auth_group'],
            'nama_client_region_3' => $isExists[0]['nama_client_region_3'],
            'nama_auth_group_client' => $isExists[0]['nama_auth_group_client'],
            'telegram_user_client' => $isExists[0]['telegram_user_client'],
            'noted_user_client' => $isExists[0]['noted_user_client'],
            'created_user_client' => $isExists[0]['created_user_client'],
            'updated_user_client' => $isExists[0]['updated_user_client'],
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
        $data = $this->model->where('id_user_client', $id)->findAll();
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
