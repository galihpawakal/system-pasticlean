<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AtmKategoriModel;
use App\Models\ClientRegion3Model;
use App\Models\PriceModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Price extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new PriceModel();
        $this->modelClientRegion3 = new ClientRegion3Model();
        $this->modelAtmKategori = new AtmKategoriModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('client_region_3', 'client_region_3.kd_client_region_3 = price.kd_client_region_3')
            ->join('atm_kategori', 'atm_kategori.id_atm_kategori = price.id_atm_kategori')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_price' => $key['id_price'],
                    'nama_client_region_3' => $key['nama_client_region_3'],
                    'nama_atm_kategori' => $key['nama_atm_kategori'],
                    'value_price' => $key['value_price'],
                    'noted_price' => $key['noted_price'],
                    'created_price' => $key['created_price'],
                    'updated_price' => $key['updated_price'],
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
            ->join('client_region_3', 'client_region_3.kd_client_region_3 = price.kd_client_region_3')
            ->join('atm_kategori', 'atm_kategori.id_atm_kategori = price.id_atm_kategori')
            ->where('id_price', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_price' => $key['id_price'],
                    'nama_client_region_3' => $key['nama_client_region_3'],
                    'nama_atm_kategori' => $key['nama_atm_kategori'],
                    'value_price' => $key['value_price'],
                    'noted_price' => $key['noted_price'],
                    'created_price' => $key['created_price'],
                    'updated_price' => $key['updated_price'],
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
        $kd_client_region_3 = $this->request->getVar('kd_client_region_3');
        $isExists = $this->modelClientRegion3->where('kd_client_region_3', $kd_client_region_3)->findAll();
        if (!$isExists) {
            $response = [
                'code' => 402,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $id_atm_kategori = $this->request->getVar('id_atm_kategori');
        $isExists = $this->modelAtmKategori->where('id_atm_kategori', $id_atm_kategori)->findAll();
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
            ->join('client_region_3', 'client_region_3.kd_client_region_3 = price.kd_client_region_3')
            ->join('atm_kategori', 'atm_kategori.id_atm_kategori = price.id_atm_kategori')
            ->where('id_price', $id)->find();
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
            ->join('client_region_3', 'client_region_3.kd_client_region_3 = price.kd_client_region_3')
            ->join('atm_kategori', 'atm_kategori.id_atm_kategori = price.id_atm_kategori')
            ->where('id_price', $id)->find();
        $result = [
            'id_price' => $isExists[0]['id_price'],
            'nama_client_region_3' => $isExists[0]['nama_client_region_3'],
            'nama_atm_kategori' => $isExists[0]['nama_atm_kategori'],
            'value_price' => $isExists[0]['value_price'],
            'noted_price' => $isExists[0]['noted_price'],
            'created_price' => $isExists[0]['created_price'],
            'updated_price' => $isExists[0]['updated_price'],
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
        $data = $this->model->where('id_price', $id)->findAll();
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
