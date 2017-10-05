<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product_model extends CI_Model {

    var $_pk_product  = "";
    var $_sku         = "";
    var $_name        = "";
    var $_description = "";
    var $_price       = "";
    var $_status      = "";
    var $_created_at  = "";
    var $_updated_at  = "";
    var $_status_active   = 1;
    var $_status_inactive = 0;

    function __construct() {
        parent::__construct();
    }

    function create() {
        $this->db->insert('product', get_array_from_object($this));
        return $this->db->insert_id();
    }

    function read() {
        $this->db->where('pk_product', $this->_pk_product);
        $rec = $this->db->get('product');
        if ($rec->result_id->num_rows == 1) {
            $this->_set($rec->result_array());
            return TRUE;
        }
        return FALSE;
    }

    function update() {
        $this->db->where('pk_product', $this->_pk_product);
        $this->db->update('product', get_array_from_object($this));
        return $this->db->affected_rows();
    }

    function upsert() {
        $data = get_array_from_object($this);

        $this->db->where('pk_product', $this->_pk__product);
        $q = $this->db->get('product');

        if ($q->result_id->num_rows == 0) {
            $this->db->insert('product', $data);
            $ret = $this->db->insert_id();
            return $ret;
        }
        else {
            unset($data['created_at']);
            $this->db->where('pk_product', $this->_pk_product);
            $this->db->update('product', $data);
            return $this->db->affected_rows();
        }
    }

    function delete() {
        $data = array(
            'status' => $this->_status_inactive
        );
        $this->db->where('pk_product', $this->_pk_product);
        $this->db->update('product', $data);
        return $this->db->affected_rows();
    }

    function fetch() {
        if ($this->_status !== "") {
            $this->db->where('status', $this->_status);
        }
        $rec = $this->db->get('product');
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
