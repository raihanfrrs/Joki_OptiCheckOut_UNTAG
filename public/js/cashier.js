$(document).on('click', '#button-trigger-modal-edit-inventory-product', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/inventory-product/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-inventory-product-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});