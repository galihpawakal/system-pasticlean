<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AtmCheckerModel;
use App\Models\AtmLokasiModel;
use App\Models\CheckerReportModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class CheckerReport extends BaseController
{
    use ResponseTrait;

    function __construct()
    {
        $this->model = new CheckerReportModel();
        $this->modelAtmChecker = new AtmCheckerModel();
        $this->modelAtmLokasi = new AtmLokasiModel();
        $this->modelUser = new UserModel();
    }

    public function index()
    {
        $data = $this->model
            ->join('user', 'user.id_user = checker_report.id_user')
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = checker_report.id_atm_lokasi')
            ->join('atm_checker', 'atm_checker.id_atm_checker = checker_report.id_atm_checker')
            ->findAll();
        if ($data) {
            foreach ($data as $key) {
                $result[] = [
                    'id_checker_report' => $key['id_checker_report'],
                    'nama_atm_checker' => $key['nama_atm_checker'],
                    'nama_atm_lokasi' => $key['nama_atm_lokasi'],
                    'nama_user' => $key['nama_user'],
                    'petugas_checker_report' => $key['petugas_checker_report'],
                    'tgl_checker_report' => $key['tgl_checker_report'],
                    'status_checker_report' => $key['status_checker_report'],
                    'noted_checker_report' => $key['noted_checker_report'],
                    'created_checker_report' => $key['created_checker_report'],
                    'updated_checker_report' => $key['updated_checker_report'],
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
            ->join('atm_checker', 'atm_checker.id_atm_checker = checker_report.id_atm_checker')
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = checker_report.id_atm_lokasi')
            ->join('user', 'user.id_user = checker_report.id_user')
            ->where('id_checker_report', $id)->findAll();
        if ($data) {

            foreach ($data as $key) {
                $result[] =  [
                    'id_checker_report' => $key['id_checker_report'],
                    'nama_atm_checker' => $key['nama_atm_checker'],
                    'nama_atm_lokasi' => $key['nama_atm_lokasi'],
                    'nama_user' => $key['nama_user'],
                    'petugas_checker_report' => $key['petugas_checker_report'],
                    'tgl_checker_report' => $key['tgl_checker_report'],
                    'status_checker_report' => $key['status_checker_report'],
                    'noted_checker_report' => $key['noted_checker_report'],
                    'created_checker_report' => $key['created_checker_report'],
                    'updated_checker_report' => $key['updated_checker_report'],
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
            ->join('atm_checker', 'atm_checker.id_atm_checker = checker_report.id_atm_checker')
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = checker_report.id_atm_lokasi')
            ->join('user', 'user.id_user = checker_report.id_user')
            ->where('id_checker_report', $id)->find();
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
            ->join('atm_checker', 'atm_checker.id_atm_checker = checker_report.id_atm_checker')
            ->join('atm_lokasi', 'atm_lokasi.id_atm_lokasi = checker_report.id_atm_lokasi')
            ->join('user', 'user.id_user = checker_report.id_user')
            ->where('id_checker_report', $id)->find();
        $result = [
            'id_checker_report' => $isExists[0]['id_checker_report'],
            'nama_atm_checker' => $isExists[0]['nama_atm_checker'],
            'nama_atm_lokasi' => $isExists[0]['nama_atm_lokasi'],
            'nama_user' => $isExists[0]['nama_user'],
            'petugas_checker_report' => $isExists[0]['petugas_checker_report'],
            'tgl_checker_report' => $isExists[0]['tgl_checker_report'],
            'status_checker_report' => $isExists[0]['status_checker_report'],
            'noted_checker_report' => $isExists[0]['noted_checker_report'],
            'created_checker_report' => $isExists[0]['created_checker_report'],
            'updated_checker_report' => $isExists[0]['updated_checker_report'],
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
        $data = $this->model->where('id_checker_report', $id)->findAll();
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
