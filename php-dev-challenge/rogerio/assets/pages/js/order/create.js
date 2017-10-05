function initialise() {
    $("#product_list").select2({
        placeholder: "Selecione um produto",
        allowClear: true
    });

    $(".quantity").blur(function () {
        var quantity = $(this).val();
        var pk_product = $(this).attr("product_price_id");
        var price = $("#price_" + pk_product).html();
        if (parseInt(quantity) > 0) {
            var total = quantity * parseFloat(price);
            $("#total_" + pk_product).html(total.toFixed(2));
        } else {
            $(this).val("1");
            $("#total_" + pk_product).html(price);
        }
    });

    $(".remove").click(function () {
        var pk_product = $(this).attr("product_id");
        $("#tr_" + pk_product).remove();
    });

}


jQuery(document).ready(function () {
    initialise();

    $('#frm_create').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.preventDefault();
            return false;
        }
    });
});

//seleção de produto
$("#product_add").click(function () {
    var pk_product = $("#pk_product").val();

    if (parseInt(pk_product) > 0) {
        $.ajax({
            method: "POST",
            url: $('#base_url').val() + "product/ajax_find",
            dataType: "json",
            data: {
                pk_product: pk_product
            }
        }).done(function (value) {
            generate_table(value);
            initialise();
        });
    }
    $("#modal").modal('hide');
});



function generate_table(product) {
    var table = "";
    table += '<tr id="tr_' + product._pk_product + '">' +
            '<td><input class="form-controll numeric quantity" type="text" id="quantity_' + product._pk_product + '" name="product[' + product._pk_product + ']" value="1" product_price_id="' + product._pk_product + '"></td>' +
            '<td>' + product._name + '</td>' +
            '<td id="price_' + product._pk_product + '">' + product._price + '</td>' +
            '<td id="total_' + product._pk_product + '">' + product._price + '</td>' +
            '<td><button class="btn btn-xs btn-bricky tooltips remove" data-placement="top" data-original-title="Remover" product_id="' + product._pk_product + '"><i class="fa fa-times fa fa-white"></i></button></td>' +
            '</tr>';
    $("#table_product").append(table);
}

