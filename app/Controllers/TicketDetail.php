<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TicketModel;
use App\Models\TicketDetailModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class TicketDetail extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new TicketDetailModel();
        $this->modelTicket = new TicketModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('ticket', 'ticket.id_ticket = ticket_detail.id_ticket')
            ->join('user', 'user.id_user = ticket_detail.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_ticket_detail' => $key['id_ticket_detail'],
                    'pelapor_ticket' => $key['pelapor_ticket'],
                    'nama_user' => $key['nama_user'],
                    'jenis_ticket_detail' => $key['jenis_ticket_detail'],
                    'noted_ticket_detail' => $key['noted_ticket_detail'],
                    'created_ticket_detail' => $key['created_ticket_detail'],
                    'updated_ticket_detail' => $key['updated_ticket_detail'],
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
            ->join('ticket', 'ticket.id_ticket = ticket_detail.id_ticket')
            ->join('user', 'user.id_user = ticket_detail.id_user')
            ->where('id_ticket_detail', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_ticket_detail' => $key['id_ticket_detail'],
                    'pelapor_ticket' => $key['pelapor_ticket'],
                    'nama_user' => $key['nama_user'],
                    'jenis_ticket_detail' => $key['jenis_ticket_detail'],
                    'noted_ticket_detail' => $key['noted_ticket_detail'],
                    'created_ticket_detail' => $key['created_ticket_detail'],
                    'updated_ticket_detail' => $key['updated_ticket_detail'],
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
        $id_ticket = $this->request->getVar('id_ticket');
        $isExists = $this->modelTicket->where('id_ticket', $id_ticket)->findAll();
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
            ->join('ticket', 'ticket.id_ticket = ticket_detail.id_ticket')
            ->join('user', 'user.id_user = ticket_detail.id_user')
            ->where('id_ticket_detail', $id)->find();
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
            ->join('ticket', 'ticket.id_ticket = ticket_detail.id_ticket')
            ->join('user', 'user.id_user = ticket_detail.id_user')
            ->where('id_ticket_detail', $id)->find();
        $result = [
            'id_ticket_detail' => $isExists[0]['id_ticket_detail'],
            'pelapor_ticket' => $isExists[0]['pelapor_ticket'],
            'nama_user' => $isExists[0]['nama_user'],
            'jenis_ticket_detail' => $isExists[0]['jenis_ticket_detail'],
            'noted_ticket_detail' => $isExists[0]['noted_ticket_detail'],
            'created_ticket_detail' => $isExists[0]['created_ticket_detail'],
            'updated_ticket_detail' => $isExists[0]['updated_ticket_detail'],
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
        $data = $this->model->where('id_ticket_detail', $id)->findAll();
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
