<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\ScheduleModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Schedule extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ScheduleModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('user', 'user.id_user = schedule.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_schedule' => $key['id_schedule'],
                    'nama_user' => $key['nama_user'],
                    'tgl_schedule' => $key['tgl_schedule'],
                    'value_schedule' => $key['value_schedule'],
                    'noted_schedule' => $key['noted_schedule'],
                    'created_schedule' => $key['created_schedule'],
                    'updated_schedule' => $key['updated_schedule'],
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
            ->join('user', 'user.id_user = schedule.id_user')
            ->where('id_schedule', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_schedule' => $key['id_schedule'],
                    'nama_user' => $key['nama_user'],
                    'tgl_schedule' => $key['tgl_schedule'],
                    'value_schedule' => $key['value_schedule'],
                    'noted_schedule' => $key['noted_schedule'],
                    'created_schedule' => $key['created_schedule'],
                    'updated_schedule' => $key['updated_schedule'],
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
            ->join('user', 'user.id_user = schedule.id_user')
            ->where('id_schedule', $id)->find();
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
            ->join('user', 'user.id_user = schedule.id_user')
            ->where('id_schedule', $id)->find();
        $result = [
            'id_schedule' => $isExists[0]['id_schedule'],
            'nama_user' => $isExists[0]['nama_user'],
            'tgl_schedule' => $isExists[0]['tgl_schedule'],
            'value_schedule' => $isExists[0]['value_schedule'],
            'noted_schedule' => $isExists[0]['noted_schedule'],
            'created_schedule' => $isExists[0]['created_schedule'],
            'updated_schedule' => $isExists[0]['updated_schedule'],
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
        $data = $this->model->where('id_schedule', $id)->findAll();
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
