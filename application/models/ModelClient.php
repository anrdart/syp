<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelClient extends CI_Model
{
    public function getClient($id = null)
    {
        $this->db->select('client.*, keluhan.keluhan as jenis_keluhan, psikolog.nama as nama_psikolog');
        $this->db->from('client');
        $this->db->join('keluhan', 'keluhan.id_keluhan = client.id_keluhan');
        $this->db->join('psikolog', 'psikolog.sipp = client.id_psikolog');

        if ($id != null) {
            $this->db->where('id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function getClientById($id)
    {
        return $this->db->get_where('client', ['id' => $id])->result_array();
    }

    public function getAllClient()
    {
        return $this->db->get('client')->result_array();
    }

    public function clientWhere($where)
    {
        return $this->db->get_where('client', $where);
    }

    public function simpanClient()
    {
        $data = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'email' => $this->input->post('email', true),
            'whatsapp' => $this->input->post('whatsapp', true),
            'id_keluhan' => $this->input->post('id_keluhan', true),
            'id_psikolog' => $this->input->post('id_psikolog', true),
            'tanggal_konsultasi' => $this->input->post('tanggal_konsultasi', true),
            'jam_konsultasi' => $this->input->post('jam_konsultasi', true)
        );
        $this->db->insert('client', $data);
    }

    public function updateClient()
    {
        $data = array(
            'id' => $this->input->post('id', true),
            'nama' => $this->input->post('nama', true),
            'email' => $this->input->post('email', true),
            'whatsapp' => $this->input->post('whatsapp', true),
            // 'id_keluhan' => $this->input->post('id_keluhan', true),
            // 'id_psikolog' => $this->input->post('id_psikolog', true),
            'tanggal_konsultasi' => $this->input->post('tanggal_konsultasi', true),
            'jam_konsultasi' => $this->input->post('jam_konsultasi', true)
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('client', $data);
    }

    public function hapusClient($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('client');
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where && count($where) > 0)) {
            $this->db->where($where);
        }
        $this->db->from('client');
        return $this->db->get()->row($field);
    }

    public function cariDataClient()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->or_like('nama', $keyword);
        $this->db->or_like('id_psikolog', $keyword);
        $this->db->or_like('id_keluhan', $keyword);

        return $this->db->get('client')->result_array();
    }

    // public function jointable($where)
    // {
    //     $this->db->select('');
    //     $this->db->from('client');
    //     $this->db->join('keluhan', 'keluhan.keluhan = client.keluhan');
    //     $this->db->where($where);
    //     return $this->db->get();
    // }

    public function countAllClient()
    {
        return $this->db->get('client')->num_rows();
    }

    public function getClientLimit()
    {
        $this->db->select('*');
        $this->db->from('client');
        $this->db->limit(10, 0);
        return $this->db->get();
    }
}
