<?php

namespace App\Controllers;
use App\Models\PolicyModel;
use Dompdf\Dompdf;
use Dompdf\Options;


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
        $table = "vw_policy";
        $primaryKey = 'id';

        $columns = array(
            array( 'db'=>'id', 'dt'=>0 ),
            array( 'db'=>'nama_nasabah', 'dt'=>1 ),
            array( 'db'=>'periode', 'dt'=>2),                 
            array( 'db'=>'kendaraan', 'dt'=>3 ),
            array( 'db'=>'harga', 'dt'=>4,
                    'formatter'=>function($d, $row){
                        return 'Rp '.number_format($row['harga'],0,",",".");                 
                    } ),
            array( 'db'=>'jenis', 'dt'=>5,
                    'formatter'=>function($d, $row){
                        if ($row['jenis']==1) {
                            return ' Comprehensive';
                        }else{
                            return ' Total Loss Only';
                        }                        
                        
                    } ),
            array( 'db'=>'resiko', 'dt'=>6,
                    'formatter'=>function($d, $row){
                        if ($row['resiko']==0) {
                            return ' Banjir';
                        }else{
                            return ' Gempa';
                        }                        
                        
                    } ),
            array( 'db'=>'id', 'dt'=>7,
                    'formatter'=>function($d, $row){
                        return '<a href="/policy/'.$row['id'].'" target="blank" class="btn btn-xs btn-outline-success" title="Cetak"><i class="fas fa-print"> Print</i></a>
                        ';
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
            'start_date' => $this->request->getPost('start_date'),
            'end_date' => $this->request->getPost('end_date'),
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

    public function show($id)
    {
        $db   = \Config\Database::connect();

        $data = $db->query('SELECT id, nama_nasabah, concat(date_format(start_date, "%m/%d/%Y" )," - ",date_format(end_date, "%m/%d/%Y")) AS periode, kendaraan, harga, jenis, resiko,
                                TIMESTAMPDIFF(YEAR, start_date, end_date) AS jumlah_periode,
                                IF(TIMESTAMPDIFF(YEAR, start_date, end_date) = 0, 1, TIMESTAMPDIFF(YEAR, start_date, end_date)) * harga * IF ((  jenis = 1 ), 0.0015, 0.005 ) AS premi_kendaraan,
                                IF(TIMESTAMPDIFF(YEAR, start_date, end_date) = 0, 1, TIMESTAMPDIFF(YEAR, start_date, end_date)) * harga * IF ((  resiko = 0 ), 0.0005, 0.0002 ) AS premi_resiko,
                                (IF(TIMESTAMPDIFF(YEAR, start_date, end_date) = 0, 1, TIMESTAMPDIFF(YEAR, start_date, end_date)) * harga * IF ((  jenis = 1 ), 0.0015, 0.005 )) 
                                + (IF(TIMESTAMPDIFF(YEAR, start_date, end_date) = 0, 1, TIMESTAMPDIFF(YEAR, start_date, end_date)) * harga * IF (( resiko = 0 ), 0.0005, 0.0002 )) AS total_premi 
                            FROM
                                policys
                            WHERE id = '.$id.'')->getRow();

        $nama = $data->nama_nasabah;
        $periode = $data->periode;
        $kendaraan = $data->kendaraan;
        $harga = number_format($data->harga,0);
        if($data->jenis == 1){
            $jenis = 'Comprehensive';
        }else {
            $jenis = 'Total Loss Only';
        };
        if ($data->resiko == 0) {
            $resiko = 'Banjir';
        }else {
            $resiko = 'Gempa';
        }
        $premi_kendaraan = number_format($data->premi_kendaraan,0);
        $premi_resiko = number_format($data->premi_resiko,0);
        $total = number_format($data->total_premi,0);

        $filename = $id. ' - Kb Insurance';
        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('pages/print',compact('nama','periode','kendaraan','harga','jenis','resiko','premi_kendaraan','premi_resiko','total')));
        $dompdf->setPaper('A5', 'potrait');
        $dompdf->render();

        return $dompdf->stream($filename, ['Attachment'=>false]);

    }
}
