$(document).on('click', '#button-trigger-modal-edit-product', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/product/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-product-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-edit-category', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/category/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-category-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-add-alternative-matrik', function () {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/alternative-matrik/add",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-add-alternative-matrik-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-trigger-modal-edit-alternative-matrik', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/alternative-matrik/"+id+"/edit",
        method: "get",
        processData: false,
        contentType: false,
        success: function(response) {
            $("#data-edit-alternative-matrik-modal").html(response);
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-add-new-cashier', function () {
    location.href = '/master/cashier/add';
});