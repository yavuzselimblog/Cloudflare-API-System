<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model{

    public function __construct()
    {
        $query = $this->db->query("SELECT * FROM ayarlar")->row();
        $this->config->set_item('base_url',$query->site_url);
    }

    public function getlist($where = [], $limit = "", $pkCount = "",$table,$orderbysutun = "id",$orderby = "DESC",$select = '*')
    {
        return $this
            ->db
            ->select($select)
            ->where($where)
            ->order_by($orderbysutun,$orderby)
            ->limit($limit, $pkCount)
            ->get($table)
            ->result();
    }

    
    public function getcount($where = [],$table,$orderbysutun = "id",$orderby ="DESC",$select = '*'){
        return $this
            ->db
            ->select($select)
            ->where($where)
            ->order_by($orderbysutun,$orderby)
            ->count_all_results($table);
    }

  
   

    public function addata($table,$where = array()){
        return $this->db->insert($table,$where);
    }

    public function update($where = [],$data = [],$table){
        return $this
            ->db
            ->where($where)
            ->update($table,$data);
    }

    public function delete($where = [],$table){
        return $this->db->where($where)->delete($table);
    }


    public function get($where,$table){
        return $this->db->where($where)->get($table)->row();
    }

    public function getAll($where = array(),$table,$orderbysutun = 'siteid',$orderby = 'desc',$select = '*'){
        return $this
            ->db
            ->select($select)
            ->where($where)
            ->order_by($orderbysutun,$orderby)
            ->get($table)
            ->result();
    }


    public function getlimit($where = array(),$limit, $pkCount, $table,$orderbysutun = 'siteid',$orderby = 'desc',$select = '*'){
        return $this
            ->db
            ->select($select)
            ->where($where)
            ->order_by($orderbysutun,$orderby)
            ->limit($limit, $pkCount)
            ->get($table)
            ->result();
    }


    public function getlistjoin($where = [], $limit, $pkCount,$table,$orderbysutun = "siteid",$orderby = "DESC",$select = '*')
    {
        return $this
            ->db
            ->select($select)
            ->where($where)
            ->join('websiteler','websiteler.sitekodu = dnsler.dnssitekodu')
            ->order_by($orderbysutun,$orderby)
            ->limit($limit, $pkCount)
            ->get($table)
            ->result();
    }

 




    public function custom($query,$status){
        if($status == true){
            return $this->db->query($query)->result();
        }else{
            return $this->db->query($query)->row();
        }
    }




    public function search($search_term, $start=0,$limit=0)
    {
        $this->db->like('sipno', $search_term);
        $this->db->or_like('siteadi', $search_term);
        $this->db->or_like('sitedomain', $search_term);
        if($limit>0) $this->db->limit($limit, $start);
        $query = $this->db->get('websiteler');
        return $query->result();
    }

}

?>