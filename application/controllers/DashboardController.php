<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('DepartModel');
        $this->load->model('ArriverModel');
        $this->load->model('UsersModel');
        $this->load->model('ComiteModel');
        $this->load->model('Authentication');
    }

    public function index()
    {
        $comite = array();
        $data['page_title'] = 'Tableau de bord';
        $this->load->view('template/entete_page', $data);
        $this->load->view('template/barre_lateral', $data);
        //Arriver
        $nbreA = $this->ArriverModel->countRowA();
        $arriver = $this->ArriverModel->getArriver();
        $getArYear = $this->ArriverModel->fetch_year();
        $arriv_result = $this->ArriverModel->fetch_default_chart_data();
        $arrivPass = $this->ArriverModel->countArriv();
        $dataPas = [];

        if ($arrivPass) {
            foreach($arrivPass as $row2)
            {
                $d1['data2'][] = (int) $row2->count;
            }
            $dataPas = json_encode($d1);
        }

        $dataAR = [];
        if ($arriv_result) {
            foreach($arriv_result as $row) {
                $dataA['label'][] = ucfirst($row->month_name);
                $dataA['data'][] = (int) $row->count;
            }
            $dataAR = json_encode($dataA);
        }

        //Depart
        $nbreD = $this->DepartModel->countRowD();
        $depart = $this->DepartModel->getDepart();
        $getYear = $this->DepartModel->fetch_year();
        $depart_result = $this->DepartModel->fetch_default_chart_data();
        $departPass = $this->DepartModel->countDepart();

        $dataPass = [];
        
        if ($departPass) {
            foreach($departPass as $row1)
            {
                $d['data1'][] = (int) $row1->count;
            }
            $dataPass = json_encode($d);
        }
        #var_dump($dat);die;

        $dataDE = [];
        if ($depart_result) {
            foreach($depart_result as $row) {
                $dataC['label'][] = ucfirst($row->month_name);
                $dataC['data'][] = (int) $row->count;
            }
            $dataDE = json_encode($dataC);
        }
        #var_dump($dataDE);die;
        //User
        $user = $this->UsersModel->getUs();
        $nbreU = $this->UsersModel->countRowD();
        //Session du comité
        $getC_A = $this->ComiteModel->getC_A();
        $comite = $this->ComiteModel->getRows();
        $nbreC = $this->ComiteModel->countRowC();
        $this->load->view('dashboard', 
        ['nbreA'=>$nbreA,
         'arriver'=>$arriver,
         'depart'=>$depart,
         'nbreD'=>$nbreD,
         'user'=>$user,
         'nbreU'=>$nbreU,
         'nbreC'=>$nbreC,
         'getC_A'=>$getC_A,
         'comite'=>$comite,
         'chartAR'=>$dataAR,
         'dataPas'=>$dataPas,
         'chartDE'=>$dataDE,
         'dat'=>$dataPass,
         'getYear'=>$getYear,
         'getArYear'=>$getArYear,
        ]);
        $this->load->view('template/pied_page', $data);
    }

    public function fetch_data()
    {
        if($this->input->post('year'))
        {
            $chart_data = $this->ArriverModel->fetch_chart_data($this->input->post('year'));
            $dataAR = [];
            if ($chart_data) {
                foreach($chart_data as $row) {
                    $dataCA['label'][] = ucfirst($row->month_name);
                    $dataCA['data'][] = (int) $row->count;
                }
                $dataAR = json_encode($dataCA);
                echo $dataAR;
            }
        
        }
    }

    public function fetch_data1()
    {
        if($this->input->post('year1'))
        {
            $chart_data = $this->DepartModel->fetch_chart_data($this->input->post('year1'));

            $dataDE = [];
            if ($chart_data) {
                foreach($chart_data as $row) {
                    $dataD['label1'][] = ucfirst($row->month_name);
                    $dataD['data1'][] = (int) $row->count;
                }
                $dataDE = json_encode($dataD);
                echo $dataDE;
            }
        
        }
    }
}
?>