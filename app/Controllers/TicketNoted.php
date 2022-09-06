<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\TicketModel;
use App\Models\TicketNotedModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class TicketNoted extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new TicketNotedModel();
        $this->modelTicket = new TicketModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('ticket', 'ticket.id_ticket = ticket_noted.id_ticket')
            ->join('user', 'user.id_user = ticket_noted.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_ticket_noted' => $key['id_ticket_noted'],
                    'pelapor_ticket' => $key['pelapor_ticket'],
                    'nama_user' => $key['nama_user'],
                    'noted_ticket_noted' => $key['noted_ticket_noted'],
                    'created_ticket_noted' => $key['created_ticket_noted'],
                    'updated_ticket_noted' => $key['updated_ticket_noted'],
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
            ->join('ticket', 'ticket.id_ticket = ticket_noted.id_ticket')
            ->join('user', 'user.id_user = ticket_noted.id_user')
            ->where('id_ticket_noted', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_ticket_noted' => $key['id_ticket_noted'],
                    'pelapor_ticket' => $key['pelapor_ticket'],
                    'nama_user' => $key['nama_user'],
                    'noted_ticket_noted' => $key['noted_ticket_noted'],
                    'created_ticket_noted' => $key['created_ticket_noted'],
                    'updated_ticket_noted' => $key['updated_ticket_noted'],
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
            ->join('ticket', 'ticket.id_ticket = ticket_noted.id_ticket')
            ->join('user', 'user.id_user = ticket_noted.id_user')
            ->where('id_ticket_noted', $id)->find();
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
            ->join('ticket', 'ticket.id_ticket = ticket_noted.id_ticket')
            ->join('user', 'user.id_user = ticket_noted.id_user')
            ->where('id_ticket_noted', $id)->find();
        $result = [
            'id_ticket_noted' => $isExists[0]['id_ticket_noted'],
            'pelapor_ticket' => $isExists[0]['pelapor_ticket'],
            'nama_user' => $isExists[0]['nama_user'],
            'noted_ticket_noted' => $isExists[0]['noted_ticket_noted'],
            'created_ticket_noted' => $isExists[0]['created_ticket_noted'],
            'updated_ticket_noted' => $isExists[0]['updated_ticket_noted'],
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
        $data = $this->model->where('id_ticket_noted', $id)->findAll();
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
