<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_latih_model extends CI_Model
{

    public $table = 'tb_data_latih';
    public $id = 'id';
    public $order = 'ASC';

    function __construct()
    {
        parent::__construct();
    }

    // get all
    function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    function get_by_id($id)
    {
        $this->db->where($this->id, $id);
        return $this->db->get($this->table)->row();
    }

    // get total rows
    function total_rows($q = NULL)
    {
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('nim', $q);
        $this->db->or_like('usia', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('ips_1', $q);
        $this->db->or_like('ips_2', $q);
        $this->db->or_like('ips_3', $q);
        $this->db->or_like('ips_4', $q);
        $this->db->or_like('status', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('nama', $q);
        $this->db->or_like('jenis_kelamin', $q);
        $this->db->or_like('nim', $q);
        $this->db->or_like('usia', $q);
        $this->db->or_like('alamat', $q);
        $this->db->or_like('ips_1', $q);
        $this->db->or_like('ips_2', $q);
        $this->db->or_like('ips_3', $q);
        $this->db->or_like('ips_4', $q);
        $this->db->or_like('status', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }


    function get_data_prob($field)
    {
        $this->db->group_by($field);
        return $this->db->get($this->table)->result();
    }

    function total_data_prob($field, $status, $q = NULL)
    {
        $this->db->where('status', $status);
        $this->db->where($field, $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    function get_sub_data_prob($field, $status)
    {
        $this->db->where('status', $status);
        // $this->db->where($field, $q);
        return $this->db->get($this->table)->result();
    }

    function total_sub_data_prob($field, $status)
    {
        $this->db->where('status', $status);
        // $this->db->where($field, $q);
        $this->db->get($this->table);
        return $this->db->count_all_results();

    }

    // function total_data_prob_ips($field, $status, $q = NULL)
    // {

    //     $this->db->where('status', $status);
    //     $this->db->where($field, floatval($q));
    //     $this->db->from($this->table);
    //     return $this->db->count_all_results();
    // }
    // insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    public function insert_excell($data)
    {
        $insert = $this->db->insert_batch($this->table, $data);
        if ($insert) {
            return true;
        }
    }

    // update data
    function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->order_by($this->id, $this->order);
        $this->db->update($this->table, $data);
    }

    // delete data
    function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }

    function empty_data()
    {
        $this->db->from($this->table);
        $this->db->truncate();
    }
}

/* End of file Data_uji_model.php */
/* Location: ./application/models/Data_uji_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-05-10 07:49:29 */
/* http://harviacode.com */