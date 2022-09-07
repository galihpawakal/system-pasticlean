<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengelolaRegion3Model;
use App\Models\AuthGroupModel;
use App\Models\UserPengelolaModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class UserPengelola extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new UserPengelolaModel();
        $this->modelAuthGroup = new AuthGroupModel();
        $this->modelPengelolaRegion3 = new PengelolaRegion3Model();
    }

    public function index()
    {
        $data = $this->model->join('auth_group', 'auth_group.id_auth_group = user_pengelola.id_auth_group')
            ->join('pengelola_region_3', 'pengelola_region_3.kd_pengelola_region_3 = user_pengelola.kd_pengelola_region_3')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_user_pengelola' => $key['id_user_pengelola'],
                    'nama_auth_group' => $key['nama_auth_group'],
                    'nama_pengelola_region_3' => $key['nama_pengelola_region_3'],
                    'noted_user_pengelola' => $key['noted_user_pengelola'],
                    'created_user_pengelola' => $key['created_user_pengelola'],
                    'updated_user_pengelola' => $key['updated_user_pengelola'],
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
        $data = $this->model->join('auth_group', 'auth_group.id_auth_group = user_pengelola.id_auth_group')
            ->join('pengelola_region_3', 'pengelola_region_3.kd_pengelola_region_3 = user_pengelola.kd_pengelola_region_3')
            ->where('id_user_pengelola', $id)
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_user_pengelola' => $key['id_user_pengelola'],
                    'nama_auth_group' => $key['nama_auth_group'],
                    'nama_pengelola_region_3' => $key['nama_pengelola_region_3'],
                    'noted_user_pengelola' => $key['noted_user_pengelola'],
                    'created_user_pengelola' => $key['created_user_pengelola'],
                    'updated_user_pengelola' => $key['updated_user_pengelola'],
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
        $kd_pengelola_region_3 = $this->request->getVar('kd_pengelola_region_3');
        $isExists = $this->modelPengelolaRegion3->where('kd_pengelola_region_3', $kd_pengelola_region_3)->findAll();
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
        $isExists = $this->model->join('auth_group', 'auth_group.id_auth_group = user_pengelola.id_auth_group')
            ->join('pengelola_region_3', 'pengelola_region_3.kd_pengelola_region_3 = user_pengelola.kd_pengelola_region_3')->where('id_user_pengelola', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model->join('auth_group', 'auth_group.id_auth_group = user_pengelola.id_auth_group')
            ->join('pengelola_region_3', 'pengelola_region_3.kd_pengelola_region_3 = user_pengelola.kd_pengelola_region_3')->where('id_user_pengelola', $id)->find();
        $result = [
            'id_user_pengelola' => $isExists[0]['id_user_pengelola'],
            'nama_auth_group' => $isExists[0]['nama_auth_group'],
            'nama_pengelola_region_3' => $isExists[0]['nama_pengelola_region_3'],
            'noted_user_pengelola' => $isExists[0]['noted_user_pengelola'],
            'created_user_pengelola' => $isExists[0]['created_user_pengelola'],
            'updated_user_pengelola' => $isExists[0]['updated_user_pengelola'],
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
        $data = $this->model->where('id_user_pengelola', $id)->findAll();
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
