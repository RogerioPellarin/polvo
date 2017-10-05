<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Order_model');
    }

    function index() {
        redirect('');
    }

    function create() {
        $data['error'] = false;

        if ($this->input->post('create') == 'true') {
            if ($this->input->post('product')) {
                $this->Order_model->_created_at = date("Y-m-d H:i:s");
                $this->Order_model->_pk_order   = $this->Order_model->create();
                if ($this->Order_model->_pk_order) {
                    $this->_create_order_product();
                    redirect('order/index');
                }
            }
            $data['error'] = true;
        }

        //lista de produtos
        $data['products'] = $this->_fetch_products();

        $data['js_include']   = '
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
            <script src="' . base_url() . 'assets/plugins/select2/select2.min.js"></script>
            <script type="text/javascript" src="' . base_url() . 'assets/js/mascara.js"></script>
            <script type="text/javascript" src="' . base_url() . 'assets/pages/js/order/create.js"></script>
        ';
        $data['css_include']  = '
            <link rel="stylesheet" href="' . base_url() . 'assets/plugins/select2/select2.css">';
        $data['main_content'] = 'order/create';
        $this->load->view('template/template', $data);
    }

    function delete() {
        if ($this->input->post('pk_order') > 0) {
            $this->Order_model->_pk_order = $this->input->post('pk_order');
            $this->Order_model->delete();
        }
        redirect('order');
    }

    private function _fetch_products() {
        $this->load->model("Product_model");
        $this->Product_model->_status = $this->Product_model->_status_active;
        return $this->Product_model->fetch();
    }

    private function _create_order_product() {
        $this->load->model("Order_product_model");
        $this->Order_product_model->_status   = $this->Order_product_model->_status_active;
        $this->Order_product_model->_fk_order = $this->Order_model->_pk_order;
        foreach ($this->input->post("product") as $pk_product => $quantity) {
            $this->Order_product_model->_fk_product = $pk_product;
            $this->Order_product_model->_quantity   = $quantity;
            $this->Order_product_model->_created_at = date("Y-m-d H:i:s");
            $this->Order_product_model->create();
        }
    }

}
