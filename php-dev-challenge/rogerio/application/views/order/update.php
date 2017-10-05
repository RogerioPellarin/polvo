<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-external-link-square"></i>
                        Editar Order
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

                        <form method="post" class="form-horizontal" action="<?= base_url() ?>order/update/<?=$this->Order_model->_pk_order?>">
                            <input type="hidden" name="update" id="update" value="true" />



                            <div class="text-right">
                                <button type="submit" class="btn btn-success"><i class="icon-check position-right"></i> Salvar </button>
                                <button type="button" class="btn btn-default" onclick="location.href = '<?= base_url() ?>order';"> Voltar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>