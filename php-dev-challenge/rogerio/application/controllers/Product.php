<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Product_model');
    }

    function index() {
        $this->Product_model->_status = $this->Product_model->_status_active;
        $data['list']                 = $this->Product_model->fetch();
        $data['js_include']           = '
            <script type="text/javascript" src="' . base_url() . 'assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="' . base_url() . 'assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
            ';
        $data['css_include']          = '
            <link rel="stylesheet" href="' . base_url() . 'assets/plugins/DataTables/media/css/DT_bootstrap.css" />
            ';
        $data['main_content']         = 'product/index';
        $this->load->view('template/template', $data);
    }

    function create() {
        $data['error'] = false;

        if ($this->input->post('create') == 'true') {
            $this->_validate_form();
            if ($this->form_validation->run() == TRUE) {
                $this->_fill_model();
                $this->Product_model->_created_at = date("Y-m-d H:i:s");
                $create                           = $this->Product_model->create();
                if ($create) {
                    redirect('product/index');
                }
            }
            $data['error'] = true;
        }

        $data['js_include']   = '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
            <script type="text/javascript" src="' . base_url() . 'assets/js/mascara.js"></script>
        ';
        $data['css_include']  = '';
        $data['main_content'] = 'product/create';
        $this->load->view('template/template', $data);
    }

    function update() {
        $data['error'] = false;
        if ($this->uri->segment(3, 0) <= 0) {
            redirect('product/index');
        }
        $this->Product_model->_pk_product = $this->uri->segment(3);
        $read                             = $this->Product_model->read();
        if (!$read) {
            redirect('product/index');
        }

        if ($this->input->post('update') == 'true') {
            $this->_validate_form();
            if ($this->form_validation->run() == TRUE) {
                $this->_fill_model();
                $update = $this->Product_model->update();
                redirect('product/index');
            }
            $data['error'] = true;
        }

        $data['js_include']   = '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
            <script type="text/javascript" src="' . base_url() . 'assets/js/mascara.js"></script>
        ';
        $data['css_include']  = '';
        $data['main_content'] = 'product/update';
        $this->load->view('template/template', $data);
    }

    function upsert() {
        $data['error'] = false;
        if ($this->uri->segment(3, 0) <= 0) {
            redirect('product/index');
        }
        $this->Product_model->_pk_product = $this->uri->segment(3);
        $read                             = $this->Product_model->read();
        if (!$read) {
            redirect('product/index');
        }

        if ($this->input->post('upsert') == 'true') {
            $this->_validate_form();
            if ($this->form_validation->run() == TRUE) {
                $this->_fill_model();
                $upsert = $this->Product_model->upsert();
                redirect('product/index');
            }
            $data['error'] = true;
        }

        $data['js_include']   = '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
            <script type="text/javascript" src="' . base_url() . 'assets/js/mascara.js"></script>
        ';
        $data['css_include']  = '';
        $data['main_content'] = 'product/upsert';
        $this->load->view('template/template', $data);
    }

    function delete() {
        if ($this->input->post('pk_product') > 0) {
            $this->Product_model->_pk_product = $this->input->post('pk_product');
            $this->Product_model->delete();
        }
        redirect('product');
    }

    function ajax_find() {
        $this->disableLayout = TRUE;
        $this->output->set_content_type('application/json');
        @header('Access-Control-Allow-Origin: *');
        @header('Access-Control-Allow-Methods: GET, POST');

        if ($this->input->post('pk_product')) {
            $this->Product_model->_pk_product = $this->input->post('pk_product');
            $read = $this->Product_model->read();
            if ($read) {
                print_r(json_encode($this->Product_model));
            }
            else {
                print 0;
            }
        }
    }
    
    private function _validate_form() {
        $this->form_validation->set_rules('sku', 'sku', 'trim|required');
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $this->form_validation->set_rules('price', 'price', 'trim|required');
    }

    private function _fill_model() {
        $this->Product_model->_sku         = preg_replace("([^\d]*)", "", $this->input->post('sku'));
        $this->Product_model->_name        = mb_strtoupper($this->input->post('name'), 'UTF-8');
        $this->Product_model->_description = mb_strtoupper($this->input->post('description'), 'UTF-8');
        $this->Product_model->_price       = number_format($this->input->post('price'), 2, '.', '');
    }

}
