<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckerReportModel;
use App\Models\UserModel;
use App\Models\CheckerReportAttachModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class CheckerReportAttach extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new CheckerReportAttachModel();
        $this->modelCheckerReport = new CheckerReportModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_attach.id_checker_report')
            ->join('user', 'user.id_user = checker_report_attach.id_user')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_checker_report_attach' => $key['id_checker_report_attach'],
                    'nama_checker_report' => $key['nama_checker_report'],
                    'nama_user' => $key['nama_user'],
                    'file_checker_report_attach' => $key['file_checker_report_attach'],
                    'noted_checker_report_attach' => $key['noted_checker_report_attach'],
                    'created_checker_report_attach' => $key['created_checker_report_attach'],
                    'updated_checker_report_attach' => $key['updated_checker_report_attach'],
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_attach.id_checker_report')
            ->join('user', 'user.id_user = checker_report_attach.id_user')
            ->where('id_checker_report_attach', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] =  [
                    'id_checker_report_attach' => $key['id_checker_report_attach'],
                    'nama_checker_report' => $key['nama_checker_report'],
                    'nama_user' => $key['nama_user'],
                    'file_checker_report_attach' => $key['file_checker_report_attach'],
                    'noted_checker_report_attach' => $key['noted_checker_report_attach'],
                    'created_checker_report_attach' => $key['created_checker_report_attach'],
                    'updated_checker_report_attach' => $key['updated_checker_report_attach'],
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
        $id_checker_report = $this->request->getVar('id_checker_report');
        $isExists = $this->modelCheckerReport->where('id_checker_report', $id_checker_report)->findAll();
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_attach.id_checker_report')
            ->join('user', 'user.id_user = checker_report_attach.id_user')
            ->where('id_checker_report_attach', $id)->find();
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_attach.id_checker_report')
            ->join('user', 'user.id_user = checker_report_attach.id_user')
            ->where('id_checker_report_attach', $id)->find();
        $result = [
            'id_checker_report_attach' => $isExists[0]['id_checker_report_attach'],
            'nama_checker_report' => $isExists[0]['nama_checker_report'],
            'nama_user' => $isExists[0]['nama_user'],
            'file_checker_report_attach' => $isExists[0]['file_checker_report_attach'],
            'noted_checker_report_attach' => $isExists[0]['noted_checker_report_attach'],
            'created_checker_report_attach' => $isExists[0]['created_checker_report_attach'],
            'updated_checker_report_attach' => $isExists[0]['updated_checker_report_attach'],
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
        $data = $this->model->where('id_checker_report_attach', $id)->findAll();
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
