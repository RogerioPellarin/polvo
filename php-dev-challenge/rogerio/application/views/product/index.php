<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- start: DYNAMIC TABLE PANEL -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-external-link-square"></i>
                        Produtos
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <a href="<?= base_url() ?>product/create" class="btn btn-green">Novo Registro</a>
                        <hr>
                        <?php if ($list) : ?>
                            <table class="table table-striped table-bordered table-hover table-full-width" id="tbl_product">
                                <thead>
                                    <tr>
                                        <th>Sku</th>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Preço</th>
                                    </tr>
                                    <tr></tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $item) : ?>
                                        <tr>
                                            <td><?= $item['sku'] ?></td>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= substr($item['description'], 0, 40) . "..." ?></td>
                                            <td style="text-align: right"><?= number_format($item['price'], 2, ".", "") ?></td>
                                            <td class="center">
                                                <a href="<?= base_url() ?>product/update/<?= $item['pk_product'] ?>" class="btn btn-xs btn-teal tooltips" data-placement="top" data-original-title="Editar"><i class="fa fa-edit"></i></a>
                                                <a data-toggle="modal" href="#modal" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remover" onclick="$('#pk_product').val('<?= $item['pk_product'] ?>');"><i class="fa fa-times fa fa-white"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <div class="alert alert-block alert-warning fade in">
                                <h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> Atenção!</h4>
                                <p>
                                    Nenhum registro cadastrado.
                                </p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- end: DYNAMIC TABLE PANEL -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <form method="post" action="<?= base_url() ?>product/delete" >
        <input type="hidden" name="delete" id="delete" value="true" />
        <input type="hidden" name="pk_product" id="pk_product" value="" />
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Excluir Registro</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Deseja realmente excluir este registro?
                    </p>
                </div>
                <div class="modal-footer">
                    <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">
                        Cancelar
                    </button>
                    <input type="submit" class="btn btn-red" value="Excluir" />
                </div>
            </div>
        </div>
    </form>
</div>