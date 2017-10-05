$(".show_list").click(function() {
    var pk_order = $(this).attr("pk_order");
    $("#table_"+pk_order).toggle();
});