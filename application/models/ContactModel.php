<?php

class ContactModel extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->model('UsersModel');
    }

    //La methode get contact
    public function getContact()
    {
        $this->db->query("SET lc_time_names = 'fr_FR'");
        $this->db->from('contact');
        $this->db->order_by('idcontact', 'desc');
        $req = $this->db->get();
        return $req->result();
    }

    //La methode insert contact
    public function insertContact($data)
    {
        return $req = $this->db->insert('contact', $data);
    }

    //La methode edit personne
    public function editContact($id)
    {
        $query = $this->db->get_where('contact', ['idcontact' => $id]);
        return $query->row();
    }

    //La methode update personne
    public function updatePers($data, $id){
        $query = $this->db->update('personne', $data, ['idcontact' => $id]);
    }

    //La methode delete personne
    public function deletePers($id){
        $query = $this->db->delete('personne', ['idcontact' => $id]);
    }

    public function loginUser($data)
    {
        $this->db->select('*');
        $this->db->where('nomcomplet', $data['nomcomplet']);
        $this->db->where('email', $data['email']);
        $this->db->from('users');
        $this->db->limit(1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->row();
        }else{
            return false;
        }
    }



}