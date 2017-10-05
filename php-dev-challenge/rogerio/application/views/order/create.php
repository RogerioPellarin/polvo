<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-external-link-square"></i>
                        Nova Venda
                        <div class="panel-tools">
                            <a class="btn btn-info btn-xs" data-toggle="modal" href="#modal">Adicionar Produto</a>
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

                        <form method="post" class="form-horizontal" id="frm_create" name="frm_create" action="<?= base_url() ?>order/create">
                            <input type="hidden" name="create" id="create" value="true" />
                            <input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>" disabled />

                            <table class="table table-full-width table-hover table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Quantidade</th>
                                        <th>Produto</th>
                                        <th>Valor unitário</th>
                                        <th>Valor total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="table_product" name="table_product">
                                </tbody>
                            </table>



                            <div class="text-right">
                                <a class="btn btn-info" data-toggle="modal" href="#modal">Adicionar Produto</a>
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

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-info">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
                <h4 class="modal-title">Selecionar produto</h4>
            </div>
            <div class="modal-body">
                <p>
                    <?php if ($products) : ?>
                        <select class="form-control search-select" id="pk_product" name="pk_product">
                            <option></option>
                            <?php foreach ($products as $product) : ?>
                                <option value="<?= $product['pk_product'] ?>"><?= $product['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else: ?>
                    <div class="alert alert-block alert-warning fade in">
                        <h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> Atenção!</h4>
                        <p>
                            Não existe nenhum produto cadastrado.
                        </p>
                        <a class="btn btn-info" href="<?= site_url('product/create') ?>">Cadastrar Produtos</a>
                    </div>
                <?php endif; ?>
                </p>
            </div>
            <div class="modal-footer">
                <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">
                    Voltar
                </button>
                <button class="btn btn-info" name="product_add" id="product_add">Adicionar</button>
            </div>
        </div>
    </div>
</div>