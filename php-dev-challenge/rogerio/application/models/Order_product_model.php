<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_product_model extends CI_Model {

    var $_pk_order_product = "";
    var $_fk_order         = "";
    var $_fk_product       = "";
    var $_quantity         = "";
    var $_status           = "";
    var $_created_at       = "";
    var $_updated_at       = "";
    var $_status_active   = 1;
    var $_status_inactive = 0;

    function __construct() {
        parent::__construct();
    }

    function create() {
        $this->db->insert('order_product', get_array_from_object($this));
        return $this->db->insert_id();
    }

    function read() {
        $this->db->where('pk_order_product', $this->_pk_order_product);
        $rec = $this->db->get('order_product');
        if ($rec->result_id->num_rows == 1) {
            $this->_set($rec->result_array());
            return TRUE;
        }
        return FALSE;
    }

    function update() {
        $this->db->where('pk_order_product', $this->_pk_order_product);
        $this->db->update('order_product', get_array_from_object($this));
        return $this->db->affected_rows();
    }

    function upsert() {
        $data = get_array_from_object($this);

        $this->db->where('pk_order_product', $this->_pk__order_product);
        $q = $this->db->get('order_product');

        if ($q->result_id->num_rows == 0) {
            $this->db->insert('order_product', $data);
            $ret = $this->db->insert_id();
            return $ret;
        }
        else {
            unset($data['created_at']);
            $this->db->where('pk_order_product', $this->_pk_order_product);
            $this->db->update('order_product', $data);
            return $this->db->affected_rows();
        }
    }

    function delete() {
        $data = array(
            'status' => $this->_status_inactive
        );
        $this->db->where('pk_order_product', $this->_pk_order_product);
        $this->db->update('order_product', $data);
        return $this->db->affected_rows();
    }

    function fetch() {
                //select order_product.*, product.name, product.price from order_product join product on product.pk_product = order_product.fk_product where order_product.fk_order = 1;
        $this->db->select(array(
            'order_product.*', 
            'product.name', 
            'product.price'
        ));
        $this->db->join('product', 'product.pk_product = order_product.fk_product');
        if ($this->_status !== "") {
            $this->db->where('order_product.status', $this->_status);
        }
        if ($this->_fk_order !== "") {
            $this->db->where('order_product.fk_order', $this->_fk_order);
        }
        $rec = $this->db->get('order_product');
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
