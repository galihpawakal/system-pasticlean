<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CheckerReportChecklistModel;
use App\Models\CheckerReportModel;
use App\Models\ChecklistCheckerModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class CheckerReportChecklist extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new CheckerReportChecklistModel();
        $this->modelCheckerReport = new CheckerReportModel();
        $this->modelChecklistChecker = new ChecklistCheckerModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_checklist.id_checker_report')
            ->join('checklist_checker', 'checklist_checker.id_checklist_checker = checker_report_checklist.id_checklist_checker')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_checker_report_checklist' => $key['id_checker_report_checklist'],
                    'petugas_checker_report' => $key['petugas_checker_report'],
                    'nama_checklist_checker' => $key['nama_checklist_checker'],
                    'status_checker_report_checklist' => $key['status_checker_report_checklist'],
                    'foto_checker_report_checklist' => $key['foto_checker_report_checklist'],
                    'noted_checker_report_checklist' => $key['noted_checker_report_checklist'],
                    'created_checker_report_checklist' => $key['created_checker_report_checklist'],
                    'updated_checker_report_checklist' => $key['updated_checker_report_checklist'],
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_checklist.id_checker_report')
            ->join('checklist_checker', 'checklist_checker.id_checklist_checker = checker_report_checklist.id_checklist_checker')
            ->where('id_checker_report_checklist', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] =  [
                    'id_checker_report_checklist' => $key['id_checker_report_checklist'],
                    'petugas_checker_report' => $key['petugas_checker_report'],
                    'nama_checklist_checker' => $key['nama_checklist_checker'],
                    'status_checker_report_checklist' => $key['status_checker_report_checklist'],
                    'foto_checker_report_checklist' => $key['foto_checker_report_checklist'],
                    'noted_checker_report_checklist' => $key['noted_checker_report_checklist'],
                    'created_checker_report_checklist' => $key['created_checker_report_checklist'],
                    'updated_checker_report_checklist' => $key['updated_checker_report_checklist'],
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
        $id_checklist_checker = $this->request->getVar('id_checklist_checker');
        $isExists = $this->modelChecklistChecker->where('id_checklist_checker', $id_checklist_checker)->findAll();
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_checklist.id_checker_report')
            ->join('checklist_checker', 'checklist_checker.id_checklist_checker = checker_report_checklist.id_checklist_checker')
            ->where('id_checker_report_checklist', $id)->find();
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
            ->join('checker_report', 'checker_report.id_checker_report = checker_report_checklist.id_checker_report')
            ->join('checklist_checker', 'checklist_checker.id_checklist_checker = checker_report_checklist.id_checklist_checker')
            ->where('id_checker_report_checklist', $id)->find();
        $result = [
            'id_checker_report_checklist' => $isExists[0]['id_checker_report_checklist'],
            'petugas_checker_report' => $isExists[0]['petugas_checker_report'],
            'nama_checklist_checker' => $isExists[0]['nama_checklist_checker'],
            'status_checker_report_checklist' => $isExists[0]['status_checker_report_checklist'],
            'foto_checker_report_checklist' => $isExists[0]['foto_checker_report_checklist'],
            'noted_checker_report_checklist' => $isExists[0]['noted_checker_report_checklist'],
            'created_checker_report_checklist' => $isExists[0]['created_checker_report_checklist'],
            'updated_checker_report_checklist' => $isExists[0]['updated_checker_report_checklist'],
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
        $data = $this->model->where('id_checker_report_checklist', $id)->findAll();
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
