<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AtmRingModel;
use App\Models\AtmCheckerModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AtmChecker extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new AtmCheckerModel();
        $this->modelAtmRing = new AtmRingModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('atm_ring', 'atm_ring.id_atm_ring = atm_checker.id_atm_ring')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_atm_checker' => $key['id_atm_checker'],
                    'nama_atm_ring' => $key['nama_atm_ring'],
                    'nama_atm_checker' => $key['nama_atm_checker'],
                    'noted_atm_checker' => $key['noted_atm_checker'],
                    'created_atm_checker' => $key['created_atm_checker'],
                    'updated_atm_checker' => $key['updated_atm_checker'],
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
            ->join('atm_ring', 'atm_ring.id_atm_ring = atm_checker.id_atm_ring')
            ->where('id_atm_checker', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_atm_checker' => $key['id_atm_checker'],
                    'nama_atm_ring' => $key['nama_atm_ring'],
                    'nama_atm_checker' => $key['nama_atm_checker'],
                    'noted_atm_checker' => $key['noted_atm_checker'],
                    'created_atm_checker' => $key['created_atm_checker'],
                    'updated_atm_checker' => $key['updated_atm_checker'],
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
        $id_atm_ring = $this->request->getVar('id_atm_ring');
        $isExists = $this->modelAtmRing->where('id_atm_ring', $id_atm_ring)->findAll();
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
            ->join('atm_ring', 'atm_ring.id_atm_ring = atm_checker.id_atm_ring')->where('id_atm_checker', $id)->find();
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
            ->join('atm_ring', 'atm_ring.id_atm_ring = atm_checker.id_atm_ring')->where('id_atm_checker', $id)->find();
        $result = [
            'id_atm_checker' => $isExists[0]['id_atm_checker'],
            'nama_atm_ring' => $isExists[0]['nama_atm_ring'],
            'nama_atm_checker' => $isExists[0]['nama_atm_checker'],
            'noted_atm_checker' => $isExists[0]['noted_atm_checker'],
            'created_atm_checker' => $isExists[0]['created_atm_checker'],
            'updated_atm_checker' => $isExists[0]['updated_atm_checker'],
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
        $data = $this->model->where('id_atm_checker', $id)->findAll();
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
