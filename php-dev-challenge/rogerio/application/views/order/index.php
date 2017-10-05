<div class="main-content">
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <!-- start: DYNAMIC TABLE PANEL -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-external-link-square"></i>
                        VENDAS
                        <div class="panel-tools">
                            <a class="btn btn-xs btn-link panel-collapse collapses" href="#">
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <a href="<?= base_url() ?>order/create" class="btn btn-green">Nova Venda</a>
                        <hr>
                        <?php if ($list) : ?>
                            <table class="table table-striped table-bordered table-hover table-full-width" id="tbl_order">
                                <thead>
                                    <tr>
                                        <th>Data da Venda</th>
                                        <th>Itens</th>
                                        <th>Valor Total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $item) : ?>

                                        <tr>
                                            <td><?= date("d/m/Y H:i", strtotime($item['order']['created_at'])) ?></td>
                                            <td>
                                                <?= $item['order_product']['total']['quantity'] ?>
                                                &nbsp;
                                                <button class="btn btn-xs btn-info tooltips show_list" pk_order="<?= $item['order']['pk_order'] ?>" data-placement="top" data-original-title="Ver Itens"><i class="fa fa-list fa fa-white"></i></button>
                                            </td>
                                            <td><?= number_format($item['order_product']['total']['price'], 2, ",", "") ?></td>
                                            <td class="center">
                                                <a data-toggle="modal" href="#modal" class="btn btn-xs btn-bricky tooltips" data-placement="top" data-original-title="Remover" onclick="$('#pk_order').val('<?= $item['order']['pk_order'] ?>');"><i class="fa fa-times fa fa-white"></i></a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">
                                                <table class="table table-striped" id="table_<?= $item['order']['pk_order'] ?>" style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Quantidade</th>
                                                            <th>Produto</th>
                                                            <th>Preço Unitário</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($item['order_product']['order_product'] as $product) : ?>
                                                            <tr>
                                                                <td><?= $product['quantity'] ?></td>
                                                                <td><?= $product['name'] ?></td>
                                                                <td><?= number_format($product['price'], 2, ",", "") ?></td>
                                                                <td><?= number_format($product['price'] * $product['quantity'], 2, ",", "") ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>                                                
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        <?php else : ?>
                            <div class="alert alert-block alert-warning fade in">
                                <h4 class="alert-heading"><i class="fa fa-exclamation-triangle"></i> Atenção!</h4>
                                <p>
                                    Nenhuma venda registrada até o momento.
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
    <form method="post" action="<?= base_url() ?>order/delete" >
        <input type="hidden" name="delete" id="delete" value="true" />
        <input type="hidden" name="pk_order" id="pk_order" value="" />
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header btn-red">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                        &times;
                    </button>
                    <h4 class="modal-title">Cancelar Venda</h4>
                </div>
                <div class="modal-body">
                    <p>
                        Deseja realmente cancelar esta venda?
                    </p>
                </div>
                <div class="modal-footer">
                    <button aria-hidden="true" data-dismiss="modal" class="btn btn-default">
                        Voltar
                    </button>
                    <input type="submit" class="btn btn-red" value="Cancelar Venda" />
                </div>
            </div>
        </div>
    </form>
</div>