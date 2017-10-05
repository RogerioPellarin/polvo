<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-external-link-square"></i>
                        Editar Order_product
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if ($error) : ?>
                            <div class="alert alert-danger">
                                <strong>Atenção!</strong> Houve um erro ao salvar os dados. 
                            </div>
                        <?php endif; ?>

                        <form method="post" class="form-horizontal" action="<?= base_url() ?>order_product/update/<?=$this->Order_product_model->_pk_order_product?>">
                            <input type="hidden" name="update" id="update" value="true" />


                                            <div class="form-group <?= form_error('fk_order') != "" ? "has-error" : ""; ?>">
                                                <label class="col-lg-3 control-label">Fk Order:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control numeric" placeholder="" name="fk_order" id="fk_order" value="<?= set_value('fk_order') != "" ? set_value('fk_order') : $this->Order_product_model->_fk_order  ?>" >
                                                </div>
                                            </div>
                    
                                            <div class="form-group <?= form_error('fk_product') != "" ? "has-error" : ""; ?>">
                                                <label class="col-lg-3 control-label">Fk Product:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control numeric" placeholder="" name="fk_product" id="fk_product" value="<?= set_value('fk_product') != "" ? set_value('fk_product') : $this->Order_product_model->_fk_product  ?>" >
                                                </div>
                                            </div>
                    
                                            <div class="form-group <?= form_error('quantity') != "" ? "has-error" : ""; ?>">
                                                <label class="col-lg-3 control-label">Quantity:</label>
                                                <div class="col-lg-9">
                                                    <input type="text" class="form-control numeric" placeholder="" name="quantity" id="quantity" value="<?= set_value('quantity') != "" ? set_value('quantity') : $this->Order_product_model->_quantity  ?>" >
                                                </div>
                                            </div>
                    

                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i class="icon-check position-right"></i> Salvar </button>
                                <button type="button" class="btn btn-default" onclick="location.href = '<?= base_url() ?>order_product';"> Voltar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>