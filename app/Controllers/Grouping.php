<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AtmLokasiModel;
use App\Models\GroupingModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Grouping extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new GroupingModel();
        $this->modelUser = new UserModel();
        $this->modelAtmLokasi = new AtmLokasiModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('user', 'user.id_user = grouping.id_user')
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = grouping.id_atm_lokasi')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_grouping' => $key['id_grouping'],
                    'nama_user' => $key['nama_user'],
                    'nama_atm_lokasi' => $key['nama_atm_lokasi'],
                    'noted_grouping' => $key['noted_grouping'],
                    'created_grouping' => $key['created_grouping'],
                    'updated_grouping' => $key['updated_grouping'],
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
            ->join('user', 'user.id_user = grouping.id_user')
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = grouping.id_atm_lokasi')
            ->where('id_grouping', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] =  [
                    'id_grouping' => $key['id_grouping'],
                    'nama_user' => $key['nama_user'],
                    'nama_atm_lokasi' => $key['nama_atm_lokasi'],
                    'noted_grouping' => $key['noted_grouping'],
                    'created_grouping' => $key['created_grouping'],
                    'updated_grouping' => $key['updated_grouping'],
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
        $id_atm_lokasi = $this->request->getVar('id_atm_lokasi');
        $isExists = $this->modelAtmLokasi->where('id_atm_lokasi', $id_atm_lokasi)->findAll();
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
            ->join('user', 'user.id_user = grouping.id_user')
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = grouping.id_atm_lokasi')
            ->where('id_grouping', $id)->find();
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
            ->join('user', 'user.id_user = grouping.id_user')
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = grouping.id_atm_lokasi')
            ->where('id_grouping', $id)->find();
        $result = [
            'id_grouping' => $isExists[0]['id_grouping'],
            'nama_user' => $isExists[0]['nama_user'],
            'nama_atm_lokasi' => $isExists[0]['nama_atm_lokasi'],
            'noted_grouping' => $isExists[0]['noted_grouping'],
            'created_grouping' => $isExists[0]['created_grouping'],
            'updated_grouping' => $isExists[0]['updated_grouping'],
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
        $data = $this->model->where('id_grouping', $id)->findAll();
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
