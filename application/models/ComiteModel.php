<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ComiteModel extends CI_Model
{
    // public function getComite($id = '')
    // {
    //     $this->db->select('id_comite,agenda,description,lieu_comite,date_comite'); 
    //     $this->db->from('comite'); 
    //     if($id){ 
    //         $this->db->where('id_comite',$id); 
    //         $query = $this->db->get(); 
    //         $result = $query->row_array(); 
    //     }else{ 
    //         $this->db->order_by('date_comite','desc'); 
    //         $query = $this->db->get(); 
    //         $result = $query->result_array(); 
    //     } 
    //     return !empty($result)?$result:false; 
    // }

     /* 
     * Fetch comite data from the database 
     * @param id returns a single record if specified, otherwise all records 
     */ 
    public function getRows($id = ''){ 
        $this->db->select("*, (SELECT piece_jointe FROM archives WHERE comite_id = comite.id_comite ORDER BY id_comite DESC LIMIT 1) as default_file"); 
        $this->db->from('comite'); 
        if($id){ 
            $this->db->where('id_comite', $id); 
            $query  = $this->db->get(); 
            $result = ($query->num_rows() > 0)?$query->row_array():array(); 
             
            if(!empty($result)){ 
                $this->db->select('*'); 
                $this->db->from('archives'); 
                $this->db->where('comite_id', $result['id_comite']); 
                $this->db->order_by('comite_id', 'desc'); 
                $query  = $this->db->get(); 
                $result2 = ($query->num_rows() > 0)?$query->result_array():array(); 
                $result['files'] = $result2;  
            }  
        }else{ 
            $this->db->order_by('id_comite', 'desc'); 
            $query  = $this->db->get(); 
            $result = ($query->num_rows() > 0)?$query->result_array():array(); 
        } 
         
        // return fetched data 
        return !empty($result)?$result:false; 
    } 
     
    /* 
     * Fetch file data from the database 
     * @param id returns a single record 
     */ 
    public function getArchiveRow($id){ 
        $this->db->select('*'); 
        $this->db->from('archives'); 
        $this->db->where('piece_jointe', $id); 
        $query  = $this->db->get(); 
        return ($query->num_rows() > 0)?$query->row_array():false; 
    } 

    /* 
     * Insert comite data into the database 
     * @param $data data to be insert based on the passed parameters 
     */ 
    public function insertComite($data = array())
    {
        if(!empty($data)){ 
            $req = $this->db->insert('comite', $data);
            return $req?$this->db->insert_id():false;
        } 
        return false;
    }

    /* 
     * Insert archives data into the database 
     * @param $data data to be insert based on the passed parameters 
     */ 
    public function insertArchive($data = array()) { 
        if(!empty($data)){ 
             
            // Insert archives data 
            $insert = $this->db->insert_batch('archives', $data); 
             
            // Return the status 
            return $insert?$this->db->insert_id():false; 
        } 
        return false; 
    }

    /* 
     * Update comite data into the database 
     * @param $data array to be update based on the passed parameters 
     * @param $id num filter data 
     */ 
    public function update($data, $id) { 
        if(!empty($data) && !empty($id)){ 

            // Update comite data 
            $update = $this->db->update('comite', $data, array('id_comite' => $id)); 
             
            // Return the status 
            return $update?true:false; 
        } 
        return false; 
    } 
     
    /* 
     * Delete comite data from the database 
     * @param num filter data based on the passed parameter 
     */ 
    public function deleteComite($id){ 
        // Delete comite data 
        $delete = $this->db->delete('comite', array('id_comite' => $id)); 
         
        // Return the status 
        return $delete?true:false; 
    }

    /* 
     * Delete archives data from the database 
     * @param array filter data based on the passed parameter 
     */ 
    public function deleteArchives($con){ 
        // Delete archives data 
        $delete = $this->db->delete('archives', $con); 
         
        // Return the status 
        return $delete?true:false; 
    } 

    public function editComite($id)
    {
        $req = $this->db->get_where('comite', ['id_comite' => $id]);
        return $req->row();
    }

    public function getC_A()
    {
        $this->db->select('*');
        $this->db->from('comite');
        $this->db->join('archives', 'archives.comite_id = comite.id_comite','inner');
        $req = $this->db->get();
        return $req->result();
    }

    public function download($id){
        $req = $this->db->get_where('archives',array('piece_jointe'=>$id));
        return $req->row_array();
    }

    public function countRowC() {
        $this->db->select('*');
        $this->db->from('comite');
        $id = $this->db->get()->num_rows();
        return $id;
    }

   
     
}
?>