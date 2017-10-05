<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order_product extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Order_product_model');
    }

    function index() {
        $this->Order_product_model->_status = $this->Order_product_model->_status_active;
        $data['list']              = $this->Order_product_model->fetch();
        $data['js_include']        = '
            <script type="text/javascript" src="'.base_url().'assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="'.base_url().'assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
            ';
        $data['css_include']       = '
            <link rel="stylesheet" href="'.base_url().'assets/plugins/DataTables/media/css/DT_bootstrap.css" />
            ';
        $data['main_content']      = 'order_product/index';
        $this->load->view('template/template', $data);
    }

    function create() {
        $data['error'] = false;

        if ($this->input->post('create') == 'true') {
            $this->_validate_form();
            if ($this->form_validation->run() == TRUE) {
                $this->_fill_model();
                $this->Order_product_model->_created_at = date("Y-m-d H:i:s");
                $create                        = $this->Order_product_model->create();
                if ($create) {
                    redirect('order_product/index');
                }
            }
            $data['error'] = true;
        }

        $data['js_include']   = '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
            <script type="text/javascript" src="'.base_url().'assets/js/mascara.js"></script>
        ';
        $data['css_include']  = '';
        $data['main_content'] = 'order_product/create';
        $this->load->view('template/template', $data);
    }

    function update() {
        $data['error'] = false;
        if ($this->uri->segment(3, 0) <= 0) {
            redirect('order_product/index');
        }
        $this->Order_product_model->_pk_order_product = $this->uri->segment(3);
        $read                       = $this->Order_product_model->read();
        if (!$read) {
            redirect('order_product/index');
        }

        if ($this->input->post('update') == 'true') {
            $this->_validate_form();
            if ($this->form_validation->run() == TRUE) {
                $this->_fill_model();
                $update = $this->Order_product_model->update();
                redirect('order_product/index');
            }
            $data['error'] = true;
        }

        $data['js_include']   = '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
            <script type="text/javascript" src="'.base_url().'assets/js/mascara.js"></script>
        ';
        $data['css_include']  = '';
        $data['main_content'] = 'order_product/update';
        $this->load->view('template/template', $data);
    }

    function upsert() {
        $data['error'] = false;
        if ($this->uri->segment(3, 0) <= 0) {
            redirect('order_product/index');
        }
        $this->Order_product_model->_pk_order_product = $this->uri->segment(3);
        $read                       = $this->Order_product_model->read();
        if (!$read) {
            redirect('order_product/index');
        }

        if ($this->input->post('upsert') == 'true') {
            $this->_validate_form();
            if ($this->form_validation->run() == TRUE) {
                $this->_fill_model();
                $upsert = $this->Order_product_model->upsert();
                redirect('order_product/index');
            }
            $data['error'] = true;
        }

        $data['js_include']   = '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
            <script type="text/javascript" src="'.base_url().'assets/js/mascara.js"></script>
        ';
        $data['css_include']  = '';
        $data['main_content'] = 'order_product/upsert';
        $this->load->view('template/template', $data);
    }

    function delete() {
        if ($this->input->post('pk_order_product') > 0) {
            $this->Order_product_model->_pk_order_product = $this->input->post('pk_order_product');
            $this->Order_product_model->delete();
        }
        redirect('order_product');
    }

    private function _validate_form() {
                $this->form_validation->set_rules('fk_order', 'fk_order', 'trim|required');
                $this->form_validation->set_rules('fk_product', 'fk_product', 'trim|required');
                $this->form_validation->set_rules('quantity', 'quantity', 'trim|required');

    }

    private function _fill_model() {
                $this->Order_product_model->_fk_order       = preg_replace("([^\d]*)", "", $this->input->post('fk_order'));
                $this->Order_product_model->_fk_product       = preg_replace("([^\d]*)", "", $this->input->post('fk_product'));
                $this->Order_product_model->_quantity       = preg_replace("([^\d]*)", "", $this->input->post('quantity'));

    }

}
