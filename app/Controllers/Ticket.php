<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AtmLokasiModel;
use App\Models\TicketModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Ticket extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new TicketModel();
        $this->modelAtmLokasi = new AtmLokasiModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = ticket.id_atm_lokasi')
            ->join('user', 'user.id_user = ticket.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_ticket' => $key['id_ticket'],
                    'nama_atm_lokasi' => $key['nama_atm_lokasi'],
                    'nama_user' => $key['nama_user'],
                    'pelapor_ticket' => $key['pelapor_ticket'],
                    'foto_ticket' => $key['foto_ticket'],
                    'status_ticket' => $key['status_ticket'],
                    'noted_ticket' => $key['noted_ticket'],
                    'created_ticket' => $key['created_ticket'],
                    'updated_ticket' => $key['updated_ticket'],
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
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = ticket.id_atm_lokasi')
            ->join('user', 'user.id_user = ticket.id_user')
            ->where('id_ticket', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_ticket' => $key['id_ticket'],
                    'nama_atm_lokasi' => $key['nama_atm_lokasi'],
                    'nama_user' => $key['nama_user'],
                    'pelapor_ticket' => $key['pelapor_ticket'],
                    'foto_ticket' => $key['foto_ticket'],
                    'status_ticket' => $key['status_ticket'],
                    'noted_ticket' => $key['noted_ticket'],
                    'created_ticket' => $key['created_ticket'],
                    'updated_ticket' => $key['updated_ticket'],
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
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = ticket.id_atm_lokasi')
            ->join('user', 'user.id_user = ticket.id_user')
            ->where('id_ticket', $id)->find();
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
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = ticket.id_atm_lokasi')
            ->join('user', 'user.id_user = ticket.id_user')
            ->where('id_ticket', $id)->find();
        $result = [
            'id_ticket' => $isExists[0]['id_ticket'],
            'nama_atm_lokasi' => $isExists[0]['nama_atm_lokasi'],
            'nama_user' => $isExists[0]['nama_user'],
            'pelapor_ticket' => $isExists[0]['pelapor_ticket'],
            'foto_ticket' => $isExists[0]['foto_ticket'],
            'status_ticket' => $isExists[0]['status_ticket'],
            'noted_ticket' => $isExists[0]['noted_ticket'],
            'created_ticket' => $isExists[0]['created_ticket'],
            'updated_ticket' => $isExists[0]['updated_ticket'],
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
        $data = $this->model->where('id_ticket', $id)->findAll();
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
