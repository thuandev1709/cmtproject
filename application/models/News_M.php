<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News_M extends CI_Model{

  public function __construct()
  {
    parent::__construct();
  }

  public function getAllNews($aData)
  {
    if (isset($aData['start']) && isset($aData['limit'])) {
      $this->db->select('lm16_news_id,lm16_news_title,lm16_news_content,lm16_news_status,lm16_news_created_at,lm16_news_updated_at,lm16_news_date');
      $this->db->order_by('lm16_news_id','desc');
      return $this->db->get('lm16_news',$aData['start'],$aData['limit'])->result_array();
    } else {
      $this->db->select('lm16_news_id,lm16_news_title,lm16_news_content,lm16_news_status,lm16_news_created_at,lm16_news_updated_at,lm16_news_date');
      return $this->db->count_all_results('lm16_news');
    }
  }

  public function getAllNewsHome()
  {
    $this->db->select('*');
    $this->db->where('lm16_news_status', 1);
    $this->db->order_by('lm16_news_id','desc');
    return $this->db->get('lm16_news', 3, 0)->result_array();
  }

  public function getMaxID()
  {
    $this->db->select_max('lm16_news_id');
    return $this->db->get('lm16_news')->row();
  }

 public function addNews($data)
 {
   return $this->db->insert('lm16_news', $data);
 }

 public function updateNews($id,$data)
 {
   $this->db->where('lm16_news_id', $id);
   return $this->db->update('lm16_news', $data);
 }

 public function fetchNewsDetails($id)
 {
   $this->db->select('*');
   $this->db->where('lm16_news_id', $id);
   return $this->db->get('lm16_news')->row_array();
 }

}
