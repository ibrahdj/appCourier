<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Chart extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->database();
        $this->load->helper(array('url','html','form'));
    }       
     public function pie_chart_js() {
   
      $query =  $this->db->query("SELECT created_at as y_date, MONTHNAME(created_at) as day_name, 
      COUNT(id_depart) as count  FROM depart WHERE date(created_at) > (DATE(NOW()) - INTERVAL 7 DAY) AND 
      MONTH(created_at) = '" . date('m') . "' AND YEAR(created_at) = '" . date('Y') . "
      ' GROUP BY MONTHNAME(created_at) ORDER BY (y_date) ASC"); 
 
      $record = $query->result();
      $data = [];
 
      foreach($record as $row) {
            $data['label'][] = $row->day_name;
            $data['data'][] = (int) $row->count;
      }
      $data['chart_data'] = json_encode($data);
      $this->load->view('pie_chart',$data);
    }
    #ONLY_FULL_GROUP_BY,
     
    // WHERE created_at > (NOW() - INTERVAL 365 DAY) AND 
    // MONTH(created_at) = '" . date('m') . "' AND YEAR(created_at) = '" . date('Y') . "
    // '


    





}
?>