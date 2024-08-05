<?php

namespace App\Controllers;
use App\Models\PolicyModel;
use Hermawan\DataTables\DataTable;

class Policy extends BaseController
{   
    public function index()
    {   
        $title = [
            'title' => 'Policy'
        ];
        return view('pages/policy', $title);
    }

    public function new()
    {
        $db = db_connect();
        $builder = $db->table('policys')->select('nama_nasabah','periode_pertanggungan','kendaraan','harga','jenis','resiko');

        return DataTable::of($builder)
                        ->add('action', function($r){
                            return '<button type="button" class="btn btn-primary btn-sm" id="'.$r->id.'" ><i class="fas fa-edit"></i></button>';
                        })
                        ->addNumbering('no')
                        ->toJson();
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
}
