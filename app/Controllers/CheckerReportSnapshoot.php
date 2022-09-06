<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckerReportModel;
use App\Models\SnapshootCheckerModel;
use App\Models\CheckerReportSnapshootModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class CheckerReportSnapshoot extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new CheckerReportSnapshootModel();
        $this->modelCheckerReport = new CheckerReportModel();
        $this->modelSnapshootChecker = new SnapshootCheckerModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_snapshoot.id_checker_report')
            ->join('snapshoot_checker', 'snapshoot_checker.id_snapshoot_checker = checker_report_snapshoot.id_snapshoot_checker')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_checker_report_snapshoot' => $key['id_checker_report_snapshoot'],
                    'nama_checker_report' => $key['nama_checker_report'],
                    'nama_snapshoot_checker' => $key['nama_snapshoot_checker'],
                    'foto_checker_report_snapshoot' => $key['foto_checker_report_snapshoot'],
                    'noted_checker_report_snapshoot' => $key['noted_checker_report_snapshoot'],
                    'created_checker_report_snapshoot' => $key['created_checker_report_snapshoot'],
                    'updated_checker_report_snapshoot' => $key['updated_checker_report_snapshoot'],
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_snapshoot.id_checker_report')
            ->join('snapshoot_checker', 'snapshoot_checker.id_snapshoot_checker = checker_report_snapshoot.id_snapshoot_checker')
            ->where('id_checker_report_snapshoot', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] =  [
                    'id_checker_report_snapshoot' => $key['id_checker_report_snapshoot'],
                    'nama_checker_report' => $key['nama_checker_report'],
                    'nama_snapshoot_checker' => $key['nama_snapshoot_checker'],
                    'foto_checker_report_snapshoot' => $key['foto_checker_report_snapshoot'],
                    'noted_checker_report_snapshoot' => $key['noted_checker_report_snapshoot'],
                    'created_checker_report_snapshoot' => $key['created_checker_report_snapshoot'],
                    'updated_checker_report_snapshoot' => $key['updated_checker_report_snapshoot'],
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
        $id_snapshoot_checker = $this->request->getVar('id_snapshoot_checker');
        $isExists = $this->modelSnapshootChecker->where('id_snapshoot_checker', $id_snapshoot_checker)->findAll();
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_snapshoot.id_checker_report')
            ->join('snapshoot_checker', 'snapshoot_checker.id_snapshoot_checker = checker_report_snapshoot.id_snapshoot_checker')
            ->where('id_checker_report_snapshoot', $id)->find();
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_snapshoot.id_checker_report')
            ->join('snapshoot_checker', 'snapshoot_checker.id_snapshoot_checker = checker_report_snapshoot.id_snapshoot_checker')
            ->where('id_checker_report_snapshoot', $id)->find();
        $result = [
            'id_checker_report_snapshoot' => $isExists[0]['id_checker_report_snapshoot'],
            'nama_checker_report' => $isExists[0]['nama_checker_report'],
            'nama_snapshoot_checker' => $isExists[0]['nama_snapshoot_checker'],
            'foto_checker_report_snapshoot' => $isExists[0]['foto_checker_report_snapshoot'],
            'noted_checker_report_snapshoot' => $isExists[0]['noted_checker_report_snapshoot'],
            'created_checker_report_snapshoot' => $isExists[0]['created_checker_report_snapshoot'],
            'updated_checker_report_snapshoot' => $isExists[0]['updated_checker_report_snapshoot'],
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
        $data = $this->model->where('id_checker_report_snapshoot', $id)->findAll();
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
