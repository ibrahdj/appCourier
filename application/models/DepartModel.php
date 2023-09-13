<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class DepartModel extends CI_Model
{
    public function getDepart()
    {
        $req = $this->db->get('depart');
        return $req->result();
    }

    public function insertDepart($data)
    {
        $req = $this->db->insert('depart', $data);
        return $req;
    }

    public function editDepart($id)
    {
        $req = $this->db->get_where('depart', ['id_depart' => $id]);
        return $req->row();
    }

    public function updateDepart($data, $id)
    {
        $req = $this->db->update('depart', $data, ['id_depart' => $id]);
    }

    public function deletDepart($id)
    {
        $req = $this->db->delete('depart', ['id_depart' => $id]);
    }

    public function checkCourrierFile($id)
    {
        $req = $this->db->get_where('depart', ['id_depart' => $id]);
        return $req->row();
    }
 
    public function download($id){
        $req = $this->db->get_where('depart',array('id_depart'=>$id));
        return $req->row_array();
    }

    public function countRowD() {
        $this->db->select('*');
        $this->db->from('depart');
        $id = $this->db->get()->num_rows();
        return $id;
    }

    public function fetch_year()
    {
        $this->db->query("SET LC_TIME_NAMES = 'FR_FR'");
        $this->db->select('YEAR(created_at) as anne, MONTHNAME(created_at) as month_name');
        $this->db->from('depart');
        $this->db->group_by('anne');
        $this->db->order_by('anne', 'DESC');
        return $this->db->get()->result();
    }

    public function fetch_chart_data($year)
    {
        $this->db->query("SET lc_time_names = 'fr_FR'");
        $query = $this->db->query("SELECT created_at as y_date, YEAR(created_at) as annee, MONTHNAME(created_at) as month_name, 
        COUNT(id_depart) as count  FROM depart WHERE  YEAR(created_at) = '" . $year . "' GROUP BY month_name ORDER BY (y_date) ASC"); 
        return $query->result();
    }

    public function fetch_default_chart_data()
    {
        $this->db->query("SET lc_time_names = 'fr_FR'");
        $query = $this->db->query("SELECT created_at as y_date, YEAR(created_at) as annee, MONTHNAME(created_at) as month_name, 
        COUNT(id_depart) as count  FROM depart WHERE  YEAR(created_at) = '" . date('Y') . "' GROUP BY month_name ORDER BY (y_date) ASC"); 
        return $query->result();
    }

    public function countDepart()
    {
        $query2 = $this->db->query("SELECT created_at as y_date, YEAR(created_at) as annee, COUNT(id_depart) as count  FROM depart WHERE  YEAR(created_at) < '" . date('Y') . "' GROUP BY y_date ORDER BY (y_date) ASC"); 
        return $query2->result();
    }

}



    // $query = $this->db->query("SELECT created_at as y_date, YEAR(created_at) as annee, MONTHNAME(created_at) as month_name, 
    // COUNT(id_depart) as count  FROM depart WHERE  YEAR(created_at) = '" . date('Y') . "' GROUP BY month_name ORDER BY (y_date) ASC"); 
    // $record = $query->result();

//         $query1 = $this->db->query("SELECT created_at as y_date, YEAR(created_at) as annee, COUNT(id_depart) as count  FROM depart WHERE  YEAR(created_at) < '" . date('Y') . "' GROUP BY y_date ORDER BY (y_date) ASC"); 
//         $record1 = $query1->result();
//         $dataPass = [];
        
//         if ($record1) {
//             foreach($record1 as $row1)
//             {
//                 $d['data1'][] = (int) $row1->count;
//             }
//             $dataPass = json_encode($d);
//         }
//         #var_dump($dat);die;

//         $dataDE = [];
//         if ($record) {
//             foreach($record as $row) {
//                 $dataC['label'][] = $row->month_name;
//                 $dataC['data'][] = (int) $row->count;
//             }
//             $dataDE = json_encode($dataC);
//         }
?>