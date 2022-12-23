<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPsikolog extends CI_Model
{
    public function getPsikolog($id = null)
    {
        $this->db->select('psikolog.*, keluhan.keluhan as jenis_keluhan');
        $this->db->from('psikolog');
        $this->db->join('keluhan', 'keluhan.id_keluhan = psikolog.id_keluhan');

        if ($id != null) {
            $this->db->where('sipp', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getPsikologById($id)
    {
        return $this->db->get_where('psikolog', ['sipp' => $id])->row_array();
    }

    public function getAllPsikolog()
    {
        return $this->db->get('psikolog')->result_array();
    }

    public function countAllPsikolog()
    {
        return $this->db->get('psikolog')->num_rows();
    }

    public function psikologWhere($where)
    {
        return $this->db->get_where('psikolog', $where);
    }

    public function simpanPsikolog($data = null)
    {
        $this->db->insert('psikolog', $data);
    }

    public function updatePsikolog($data = null, $where = null)
    {
        $this->db->update('psikolog', $data, $where);
    }

    public function hapusPsikolog($id)
    {
        $this->db->where('sipp', $id);
        $this->db->delete('psikolog');
    }

    public function joinPsikologClient($where)
    {
        $this->db->select('');
        $this->db->from('client');
        $this->db->join('psikolog', 'psikolog.sipp = client.id_psikolog');
        $this->db->where($where);
        return $this->db->get();
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where && count($where) > 0)) {
            $this->db->where($where);
        }
        $this->db->from('psikolog');
        return $this->db->get()->row($field);
    }

    public function cariDataPsikolog()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->or_like('nama', $keyword);
        $this->db->or_like('id_keluhan', $keyword);

        return $this->db->get('psikolog')->result_array();
    }

    public function getLimitPsikolog()
    {
        $this->db->select('*');
        $this->db->from('psikolog');
        $this->db->limit(10, 0);
        return $this->db->get();
    }
}
