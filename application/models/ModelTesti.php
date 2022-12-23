<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelTesti extends CI_Model
{
    public function getTesti()
    {
        return $this->db->get('testi');
    }

    public function getAllTesti()
    {
        return $this->db->get('testi')->result_array();
    }

    public function TestiWhere($where)
    {
        return $this->db->get_where('testi', $where);
    }

    public function getTestiById($id)
    {
        return $this->db->get_where('testi', ['id' => $id])->row_array();
    }

    public function countAllTesti()
    {
        return $this->db->get('testi')->num_rows();
    }

    public function simpanTesti($data = null)
    {
        $this->db->insert('testi', $data);
    }

    public function updateTesti()
    {
        $data = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'email' => $this->input->post('email', true),
            'tanggal' => $this->input->post('tanggal', true),
            'testimoni' => $this->input->post('testimoni', true)
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('testi', $data);
    }

    public function hapusTesti($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('testi');
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where && count($where) > 0)) {
            $this->db->where($where);
        }
        $this->db->from('testi');
        return $this->db->get()->row($field);
    }

    public function cariDataTesti()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->or_like('nama', $keyword);
        $this->db->or_like('testimoni', $keyword);

        return $this->db->get('testi')->result_array();
    }
}
