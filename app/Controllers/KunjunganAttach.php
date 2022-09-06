<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KunjunganModel;
use App\Models\UserModel;
use App\Models\KunjunganAttachModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class KunjunganAttach extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new KunjunganAttachModel();
        $this->modelKunjungan = new KunjunganModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model->join('user', 'user.id_user = kunjungan_attach.id_user')
            ->join('kunjungan', 'kunjungan.id_kunjungan = kunjungan_attach.id_kunjungan')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_kunjungan_attach' => $key['id_kunjungan_attach'],
                    'nama_user' => $key['nama_user'],
                    'nama_kunjungan' => $key['nama_kunjungan'],
                    'file_kunjungan_attach' => $key['file_kunjungan_attach'],
                    'noted_kunjungan_attach' => $key['noted_kunjungan_attach'],
                    'created_kunjungan_attach' => $key['created_kunjungan_attach'],
                    'updated_kunjungan_attach' => $key['updated_kunjungan_attach'],
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
        $data = $this->model->join('user', 'user.id_user = kunjungan_attach.id_user')
            ->join('kunjungan', 'kunjungan.id_kunjungan = kunjungan_attach.id_kunjungan')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_kunjungan_attach' => $key['id_kunjungan_attach'],
                    'nama_user' => $key['nama_user'],
                    'nama_kunjungan' => $key['nama_kunjungan'],
                    'file_kunjungan_attach' => $key['file_kunjungan_attach'],
                    'noted_kunjungan_attach' => $key['noted_kunjungan_attach'],
                    'created_kunjungan_attach' => $key['created_kunjungan_attach'],
                    'updated_kunjungan_attach' => $key['updated_kunjungan_attach'],
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
        // atm user
        $id_user = $this->request->getVar('id_user');
        $isExists = $this->modelUser->where('id_user', $id_user)->findAll();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found user kunjungan'
            ];
            return $this->respond($response);
        }
        //atm lokasi
        $id_kunjungan = $this->request->getVar('id_kunjungan');
        $isExists = $this->modelKunjungan->where('id_kunjungan', $id_kunjungan)->findAll();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found lokasi'
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
        $isExists = $this->model->join('user', 'user.id_user = kunjungan_attach.id_user')
            ->join('kunjungan', 'kunjungan.id_kunjungan = kunjungan_attach.id_kunjungan')
            ->where('id_kunjungan_attach', $id)->find();
        if (!$isExists) {
            $response = [
                'code' => 401,
                'status' => 'error',
                'data' => 'data not found'
            ];
            return $this->respond($response);
        }
        $update = $this->model->update($id, $data);
        $isExists = $this->model->join('user', 'user.id_user = kunjungan_attach.id_user')
            ->join('kunjungan', 'kunjungan.id_kunjungan = kunjungan_attach.id_kunjungan')
            ->where('id_kunjungan_attach', $id)->find();
        $result = [
            'id_kunjungan_attach' => $isExists[0]['id_kunjungan_attach'],
            'nama_user' => $isExists[0]['nama_user'],
            'nama_kunjungan' => $isExists[0]['nama_kunjungan'],
            'file_kunjungan_attach' => $isExists[0]['file_kunjungan_attach'],
            'noted_kunjungan_attach' => $isExists[0]['noted_kunjungan_attach'],
            'created_kunjungan_attach' => $isExists[0]['created_kunjungan_attach'],
            'updated_kunjungan_attach' => $isExists[0]['updated_kunjungan_attach'],
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
        $data = $this->model->where('id_kunjungan_attach', $id)->findAll();
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
