<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\AtmProblemModel;
use App\Models\AtmProblemAttachModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class AtmProblemAttach extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new AtmProblemAttachModel();
        $this->modelAtmProblem = new AtmProblemModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model->join('atm_problem', 'atm_problem.id_atm_problem = atm_problem_attach.id_atm_problem')
            ->join('user', 'user.id_user = atm_problem_attach.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_atm_problem_attach' => $key['id_atm_problem_attach'],
                    'nama_user' => $key['nama_user'],
                    'pelapor_atm_problem' => $key['pelapor_atm_problem'],
                    'file_atm_problem_attach' => $key['file_atm_problem_attach'],
                    'noted_atm_problem_attach' => $key['noted_atm_problem_attach'],
                    'created_atm_problem_attach' => $key['created_atm_problem_attach'],
                    'updated_atm_problem_attach' => $key['updated_atm_problem_attach'],
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
        $data = $this->model->join('atm_problem', 'atm_problem.id_atm_problem = atm_problem_attach.id_atm_problem')
            ->join('user', 'user.id_user = atm_problem_attach.id_user')
            ->where('id_atm_problem_attach', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] = [
                    'id_atm_problem_attach' => $key['id_atm_problem_attach'],
                    'nama_user' => $key['nama_user'],
                    'pelapor_atm_problem' => $key['pelapor_atm_problem'],
                    'file_atm_problem_attach' => $key['file_atm_problem_attach'],
                    'noted_atm_problem_attach' => $key['noted_atm_problem_attach'],
                    'created_atm_problem_attach' => $key['created_atm_problem_attach'],
                    'updated_atm_problem_attach' => $key['updated_atm_problem_attach'],
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
        $id_atm_problem = $this->request->getVar('id_atm_problem');
        $isExists = $this->modelAtmProblem->where('id_atm_problem', $id_atm_problem)->findAll();
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
            ->join('user', 'user.id_user = atm_problem_attach.id_user')
            ->join('atm_problem', 'atm_problem.id_atm_problem = atm_problem_attach.id_atm_problem')
            ->where('id_atm_problem_attach', $id)->find();
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
            ->join('user', 'user.id_user = atm_problem_attach.id_user')
            ->join('atm_problem', 'atm_problem.id_atm_problem = atm_problem_attach.id_atm_problem')->where('id_atm_problem_attach', $id)->find();
        $result = [
            'id_atm_problem_attach' => $isExists[0]['id_atm_problem_attach'],
            'nama_user' => $isExists[0]['nama_user'],
            'pelapor_atm_problem' => $isExists[0]['pelapor_atm_problem'],
            'file_atm_problem_attach' => $isExists[0]['file_atm_problem_attach'],
            'noted_atm_problem_attach' => $isExists[0]['noted_atm_problem_attach'],
            'created_atm_problem_attach' => $isExists[0]['created_atm_problem_attach'],
            'updated_atm_problem_attach' => $isExists[0]['updated_atm_problem_attach'],
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
        $data = $this->model->where('id_atm_problem_attach', $id)->findAll();
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
