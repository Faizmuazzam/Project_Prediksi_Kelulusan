<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Data_probabilitas_model_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Data_probabilitas_model extends CI_Model
{

  // ------------------------------------------------------------------------
  public $tableStatus = 'tb_prob_status';
  public $tableJenkel = 'tb_prob_jenkel';
  public $id = 'id';
  public $order = 'ASC';

  public function __construct()
  {

    parent::__construct();
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------
  public function index()
  {
    // 
  }

  function get_all_tb_prob($tb)
  {
    $this->db->order_by($this->id, $this->order);
    return $this->db->get($tb)->result_array();
  }

  // function mean_data($tb)
  // {
  //   $this->db->select_avg('name');
  //   $query = $this->db->get($tb);
  //   return $query->row()->name;

  // }

  function count_data($tb)
  {
    $this->db->from($tb);
    return $this->db->count_all_results();
  }

  function insert_tb_prob($tb, $data)
  {
    $this->db->insert($tb, $data);
  }

  function empty_data_prob($tb)
  {
    $this->db->from($tb);
    $this->db->truncate();
  }


  // ------------------------------------------------------------------------

}

/* End of file Data_probabilitas_model_model.php */
/* Location: ./application/models/Data_probabilitas_model_model.php */