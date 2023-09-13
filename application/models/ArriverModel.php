<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ArriverModel extends CI_Model
{
    public function getArriver()
    {
        $req = $this->db->get('arriver');
        return $req->result();
    }

    public function insertArriver($data)
    {
        $req = $this->db->insert('arriver', $data);
        return $req;
    }

    public function editArriver($id)
    {
        $req = $this->db->get_where('arriver', ['id_arriv' => $id]);
        return $req->row();
    }

    public function updateArriver($data, $id)
    {
        $req = $this->db->update('arriver', $data, ['id_arriv' => $id]);
    }

    public function deletArriver($id)
    {
        $req = $this->db->delete('arriver', ['id_arriv' => $id]);
    }

    public function checkCourrierFile($id)
    {
        $req = $this->db->get_where('arriver', ['id_arriv' => $id]);
        return $req->row();
    }

    public function download($id){
        $req = $this->db->get_where('arriver',array('id_arriv'=>$id));
        return $req->row_array();
    }

    public function countRowA() {
        $this->db->select('*');
        $this->db->from('arriver');
        $id = $this->db->get()->num_rows();
        return $id;
    }

    public function fetch_year()
    {
        $this->db->query("SET lc_time_names = 'fr_FR'");
        $this->db->select('YEAR(created_at) as anne, MONTHNAME(created_at) as month_name');
        $this->db->from('arriver');
        $this->db->group_by('anne');
        $this->db->order_by('anne', 'DESC');
        return $this->db->get()->result();
    }

    public function fetch_chart_data($year)
    {
        $this->db->query("SET lc_time_names = 'fr_FR'");
        $query = $this->db->query("SELECT created_at as y_date, YEAR(created_at) as annee, MONTHNAME(created_at) as month_name, 
        COUNT(id_arriv) as count  FROM arriver WHERE  YEAR(created_at) = '" . $year . "' GROUP BY month_name ORDER BY (y_date) ASC"); 
        return $query->result();
    }
    
    public function fetch_default_chart_data()
    {   
        $this->db->query("SET lc_time_names = 'fr_FR'");
        $query = $this->db->query("SELECT created_at as y_date, YEAR(created_at) as annee, MONTHNAME(created_at) as month_name,
        COUNT(id_arriv) as count  FROM arriver WHERE  YEAR(created_at) = '" . date('Y') . "' GROUP BY month_name ORDER BY (y_date) ASC"); 
        return $query->result();
    }

    public function countArriv()
    {
        $query2 = $this->db->query("SELECT created_at as y_date, YEAR(created_at) as annee, COUNT(id_arriv) as count  FROM arriver WHERE  YEAR(created_at) < '" . date('Y') . "' GROUP BY y_date ORDER BY (y_date) ASC"); 
        return $query2->result();
    }
    
}


?>