<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelKeluhan extends CI_Model
{
    public function getKeluhan()
    {
        return $this->db->get('keluhan');
    }

    public function getKeluhanById($id)
    {
        return $this->db->get_where('keluhan', ['id_keluhan' => $id])->row_array();
    }

    public function getAllKeluhan()
    {
        return $this->db->get('keluhan')->result_array();
    }

    public function countAllKeluhan()
    {
        return $this->db->get('keluhan')->num_rows();
    }

    public function keluhanWhere($where)
    {
        return $this->db->get_where('keluhan', $where);
    }

    public function simpanKeluhan()
    {
        $data = array(
            'keluhan' => $this->input->post('keluhan', true)
        );
        $this->db->insert('keluhan', $data);
    }

    public function updateKeluhan()
    {
        $data = array(
            'id_keluhan' => $this->input->post('id_keluhan', true),
            'keluhan' => $this->input->post('keluhan', true)
        );

        $this->db->where('id_keluhan', $this->input->post('id_keluhan'));
        $this->db->update('keluhan', $data);
    }

    public function hapusKeluhan($id)
    {
        $this->db->where('id_keluhan', $id);
        $this->db->delete('keluhan');
    }

    public function joinKeluhanPsikolog($where)
    {
        $this->db->select('');
        $this->db->from('psikolog');
        $this->db->join('keluhan', 'keluhan.id_keluhan = psikolog.id_keluhan');
        $this->db->where($where);
        return $this->db->get();
    }

    public function joinKeluhanClient($where)
    {
        $this->db->select('');
        $this->db->from('client');
        $this->db->join('keluhan', 'keluhan.id_keluhan = client.id_keluhan');
        $this->db->where($where);
        return $this->db->get();
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where && count($where) > 0)) {
            $this->db->where($where);
        }
        $this->db->from('keluhan');
        return $this->db->get()->row($field);
    }

    public function cariDataKeluhan()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->or_like('keluhan', $keyword);

        return $this->db->get('keluhan')->result_array();
    }
}
