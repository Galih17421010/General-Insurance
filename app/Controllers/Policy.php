<?php

namespace App\Controllers;
use App\Models\PolicyModel;
use Hermawan\DataTables\DataTable;

class Policy extends BaseController
{   
    public function __construct(){
        require_once APPPATH.'ThirdParty/ssp.php';
        $this->db = db_connect();
    }
    public function index()
    {   
        $title = [
            'title' => 'Policy'
        ];
        return view('pages/policy', $title);
    }

    public function new()
    {
        $dbDetails = array(
            "host" =>$this->db->hostname,
            "user" =>$this->db->username,
            "pass" =>$this->db->password,
            "db" =>$this->db->database,
        );
        $table = "policys";
        $primaryKey = 'id';

        $columns = array(
            array( 'db'=>'id', 'dt'=>0 ),
            array( 'db'=>'nama_nasabah', 'dt'=>1 ),
            array( 'db'=>'periode_pertanggungan', 'dt'=>2 ),
            array( 'db'=>'kendaraan', 'dt'=>3 ),
            array( 'db'=>'harga', 'dt'=>4 ),
            array( 'db'=>'jenis', 'dt'=>5 ),
            array( 'db'=>'resiko', 'dt'=>6 ),
            array( 'db'=>'id', 'dt'=>7,
                    'formatter'=>function($d, $row){
                        return '<a href="#" class="btn btn-xs btn-outline-primary" title="Edit"><i class="fas fa-edit"></i></a> &nbsp;
                                <a href="#" class="btn btn-xs btn-outline-success" title="Cetak"><i class="fas fa-print"></i></a> &nbsp; 
                                <button class="btn btn-xs btn-outline-danger" title="Hapus"><i class="fas fa-trash"></i></button>';
                    }
                ),
        );

        echo json_encode(
            \SSP::simple($_GET, $dbDetails, $table, $primaryKey, $columns)
        );
    }

    public function create() {
        
        $data = [
            'nama_nasabah' => $this->request->getPost('nama_nasabah'),
            'periode_pertanggungan' => $this->request->getPost('periode_pertanggungan'),
            'kendaraan' => $this->request->getPost('kendaraan'),
            'harga' => $this->request->getPost('harga'),
            'jenis' => $this->request->getPost('jenis'),
            'resiko' => $this->request->getPost('resiko'),
            
        ];

            $postModel = new PolicyModel();
            $postModel->save($data);
            return $this->response->setJSON([
                'error' => false,
                'message' => 'Successfully added new policy!'
            ]);
    }

    public function edit($id)
    {

    }
}
