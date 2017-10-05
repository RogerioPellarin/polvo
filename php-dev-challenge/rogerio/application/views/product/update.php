<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-external-link-square"></i>
                        Editar Produto
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

                        <form method="post" class="form-horizontal" action="<?= base_url() ?>product/update/<?= $this->Product_model->_pk_product ?>">
                            <input type="hidden" name="update" id="update" value="true" />


                            <div class="form-group <?= form_error('sku') != "" ? "has-error" : ""; ?>">
                                <label class="col-lg-3 control-label">Sku:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control numeric" placeholder="" name="sku" id="sku" value="<?= set_value('sku') != "" ? set_value('sku') : $this->Product_model->_sku ?>" >
                                </div>
                            </div>

                            <div class="form-group <?= form_error('name') != "" ? "has-error" : ""; ?>">
                                <label class="col-lg-3 control-label">Nome:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control " placeholder="" name="name" id="name" value="<?= set_value('name') != "" ? set_value('name') : $this->Product_model->_name ?>" >
                                </div>
                            </div>

                            <div class="form-group <?= form_error('description') != "" ? "has-error" : ""; ?>">
                                <label class="col-lg-3 control-label">Descrição:</label>
                                <div class="col-lg-9">
                                    <textarea class="form-control " placeholder="" name="description" id="description"><?= set_value('description') != "" ? set_value('description') : $this->Product_model->_description ?></textarea>
                                </div>
                            </div>

                            <div class="form-group <?= form_error('price') != "" ? "has-error" : ""; ?>">
                                <label class="col-lg-3 control-label">Preço:</label>
                                <div class="col-lg-9">
                                    <input type="text" class="form-control money" placeholder="" name="price" id="price" value="<?= set_value('price') != "" ? set_value('price') : number_format($this->Product_model->_price, 2, ".", "") ?>" >
                                </div>
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i class="icon-check position-right"></i> Salvar </button>
                                <button type="button" class="btn btn-default" onclick="location.href = '<?= base_url() ?>product';"> Voltar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>