<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AtmCheckerModel;
use App\Models\ChecklistCheckerModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class ChecklistChecker extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new ChecklistCheckerModel();
        $this->modelAtmChecker = new AtmCheckerModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('atm_checker', 'atm_checker.id_atm_checker = checklist_checker.id_atm_checker')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_checklist_checker' => $key['id_checklist_checker'],
                    'nama_atm_checker' => $key['nama_atm_checker'],
                    'nama_checklist_checker' => $key['nama_checklist_checker'],
                    'status_foto_checklist_checker' => $key['status_foto_checklist_checker'],
                    'noted_checklist_checker' => $key['noted_checklist_checker'],
                    'created_checklist_checker' => $key['created_checklist_checker'],
                    'updated_checklist_checker' => $key['updated_checklist_checker'],
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
            ->join('atm_checker', 'atm_checker.id_atm_checker = checklist_checker.id_atm_checker')
            ->where('id_checklist_checker', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] =  [
                    'id_checklist_checker' => $key['id_checklist_checker'],
                    'nama_atm_checker' => $key['nama_atm_checker'],
                    'nama_checklist_checker' => $key['nama_checklist_checker'],
                    'status_foto_checklist_checker' => $key['status_foto_checklist_checker'],
                    'noted_checklist_checker' => $key['noted_checklist_checker'],
                    'created_checklist_checker' => $key['created_checklist_checker'],
                    'updated_checklist_checker' => $key['updated_checklist_checker'],
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
        $id_atm_checker = $this->request->getVar('id_atm_checker');
        $isExists = $this->modelAtmChecker->where('id_atm_checker', $id_atm_checker)->findAll();
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
            ->join('atm_checker', 'atm_checker.id_atm_checker = checklist_checker.id_atm_checker')->where('id_checklist_checker', $id)->find();
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
            ->join('atm_checker', 'atm_checker.id_atm_checker = checklist_checker.id_atm_checker')->where('id_checklist_checker', $id)->find();
        $result = [
            'id_checklist_checker' => $isExists[0]['id_checklist_checker'],
            'nama_atm_checker' => $isExists[0]['nama_atm_checker'],
            'nama_checklist_checker' => $isExists[0]['nama_checklist_checker'],
            'status_foto_checklist_checker' => $isExists[0]['status_foto_checklist_checker'],
            'noted_checklist_checker' => $isExists[0]['noted_checklist_checker'],
            'created_checklist_checker' => $isExists[0]['created_checklist_checker'],
            'updated_checklist_checker' => $isExists[0]['updated_checklist_checker'],
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
        $data = $this->model->where('id_checklist_checker', $id)->findAll();
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
