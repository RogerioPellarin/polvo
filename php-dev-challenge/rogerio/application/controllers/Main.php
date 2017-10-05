<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Order_model');
    }

    public function index() {
        $data['list']         = $this->_process_order();
        $data['js_include']   = '
            <script type="text/javascript" src="' . base_url() . 'assets/plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
            <script type="text/javascript" src="' . base_url() . 'assets/plugins/DataTables/media/js/DT_bootstrap.js"></script>
            <script type="text/javascript" src="' . base_url() . 'assets/pages/js/main/index.js"></script>
            ';
        $data['css_include']  = '
            <link rel="stylesheet" href="' . base_url() . 'assets/plugins/DataTables/media/css/DT_bootstrap.css" />
            ';
        $data['main_content'] = 'order/index';
        $this->load->view('template/template', $data);
    }

    private function _process_order() {
        $return                     = false;
        $this->Order_model->_status = $this->Order_model->_status_active;
        $orders                     = $this->Order_model->fetch();
        if ($orders) {
            foreach ($orders as $k => $order) {
                $return[$k]['order']         = $order;
                $return[$k]['order_product'] = $this->_get_order_product($order);
            }
        }
        return $return;
    }

    private function _get_order_product($order) {
        $return                               = array(
            'order_product' => array(),
            'total'         => array(
                'quantity' => 0,
                'price'    => 0
            )
        );
        $this->load->model("Order_product_model");
        $this->Order_product_model->_fk_order = $order['pk_order'];
        $order_products                       = $this->Order_product_model->fetch();
        if ($order_products) {
            $return['order_product'] = $order_products;
            foreach ($order_products as $order_product) {
                $return['total']['quantity'] += $order_product['quantity'];
                $return['total']['price']    += ($order_product['price'] * $order_product['quantity']);
            }
        }
        return $return;
    }

}
