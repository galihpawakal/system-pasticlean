<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AtmLokasiModel;
use App\Models\RoomProblemModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class RoomProblem extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new RoomProblemModel();
        $this->modelAtmLokasi = new AtmLokasiModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = room_problem.id_atm_lokasi')
            ->join('user', 'user.id_user = room_problem.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_room_problem' => $key['id_room_problem'],
                    'nama_atm_lokasi' => $key['nama_atm_lokasi'],
                    'nama_user' => $key['nama_user'],
                    'pelapor_room_problem' => $key['pelapor_room_problem'],
                    'foto_room_problem' => $key['foto_room_problem'],
                    'status_room_problem' => $key['status_room_problem'],
                    'noted_room_problem' => $key['noted_room_problem'],
                    'created_room_problem' => $key['created_room_problem'],
                    'updated_room_problem' => $key['updated_room_problem'],
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
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = room_problem.id_atm_lokasi')
            ->join('user', 'user.id_user = room_problem.id_user')
            ->where('id_room_problem', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_room_problem' => $key['id_room_problem'],
                    'nama_atm_lokasi' => $key['nama_atm_lokasi'],
                    'nama_user' => $key['nama_user'],
                    'pelapor_room_problem' => $key['pelapor_room_problem'],
                    'foto_room_problem' => $key['foto_room_problem'],
                    'status_room_problem' => $key['status_room_problem'],
                    'noted_room_problem' => $key['noted_room_problem'],
                    'created_room_problem' => $key['created_room_problem'],
                    'updated_room_problem' => $key['updated_room_problem'],
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
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = room_problem.id_atm_lokasi')
            ->join('user', 'user.id_user = room_problem.id_user')
            ->where('id_room_problem', $id)->find();
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
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = room_problem.id_atm_lokasi')
            ->join('user', 'user.id_user = room_problem.id_user')
            ->where('id_room_problem', $id)->find();
        $result = [
            'id_room_problem' => $isExists[0]['id_room_problem'],
            'nama_atm_lokasi' => $isExists[0]['nama_atm_lokasi'],
            'nama_user' => $isExists[0]['nama_user'],
            'pelapor_room_problem' => $isExists[0]['pelapor_room_problem'],
            'foto_room_problem' => $isExists[0]['foto_room_problem'],
            'status_room_problem' => $isExists[0]['status_room_problem'],
            'noted_room_problem' => $isExists[0]['noted_room_problem'],
            'created_room_problem' => $isExists[0]['created_room_problem'],
            'updated_room_problem' => $isExists[0]['updated_room_problem'],
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
        $data = $this->model->where('id_room_problem', $id)->findAll();
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
