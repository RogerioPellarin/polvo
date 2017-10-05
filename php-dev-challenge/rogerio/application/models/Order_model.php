<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_model extends CI_Model {

    var $_pk_order   = "";
    var $_status     = "";
    var $_created_at = "";
    var $_updated_at = "";
    var $_status_active   = 1;
    var $_status_inactive = 0;

    function __construct() {
        parent::__construct();
    }

    function create() {
        $this->db->insert('order', get_array_from_object($this));
        return $this->db->insert_id();
    }

    function read() {
        $this->db->where('pk_order', $this->_pk_order);
        $rec = $this->db->get('order');
        if ($rec->result_id->num_rows == 1) {
            $this->_set($rec->result_array());
            return TRUE;
        }
        return FALSE;
    }

    function update() {
        $this->db->where('pk_order', $this->_pk_order);
        $this->db->update('order', get_array_from_object($this));
        return $this->db->affected_rows();
    }

    function upsert() {
        $data = get_array_from_object($this);

        $this->db->where('pk_order', $this->_pk__order);
        $q = $this->db->get('order');

        if ($q->result_id->num_rows == 0) {
            $this->db->insert('order', $data);
            $ret = $this->db->insert_id();
            return $ret;
        }
        else {
            unset($data['created_at']);
            $this->db->where('pk_order', $this->_pk_order);
            $this->db->update('order', $data);
            return $this->db->affected_rows();
        }
    }

    function delete() {
        $data = array(
            'status' => $this->_status_inactive
        );
        $this->db->where('pk_order', $this->_pk_order);
        $this->db->update('order', $data);
        return $this->db->affected_rows();
    }

    function fetch() {
        if ($this->_status !== "") {
            $this->db->where('status', $this->_status);
        }
        $rec = $this->db->get('order');
        if ($rec->result_id->num_rows >= 1) {
            return $rec->result_array();
        }
        return FALSE;
    }

    private function _set($ret) {
        foreach ($ret[0] as $key => $value) {
            if ($value !== "") {
                $this->{"_" . $key} = $value;
            }
        }
    }

}
