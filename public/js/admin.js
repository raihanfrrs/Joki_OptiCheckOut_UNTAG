$(document).ready(() => {
    allAdminDetailData();
});

const adminDetailData = (url, targetSelector, property) => {
    return $.get(url, property)
        .done(data => {
            $(targetSelector).html(data);

            if (data != 0) {
                $(targetSelector).removeClass(property);
            } else {
                $(targetSelector).addClass(property);
            }
        })
        .fail((jqXHR, textStatus, errorThrown) => {
            return;
        });
};

const allAdminDetailData = () => {
    adminDetailData("/ajax/trash-count", "#label-total-trash-count", 'd-none');
    adminDetailData("/ajax/category-trash-count", "#label-total-category-trash-count", 'd-none');
    adminDetailData("/ajax/product-trash-count", "#label-total-product-trash-count", 'd-none');
    adminDetailData("/ajax/cashier-trash-count", "#label-total-cashier-trash-count", 'd-none');
};

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

$('#filter-product-form').submit(function(event) { 
    event.preventDefault();

    const formData = new FormData(this);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
    
    $.ajax({
        type: 'POST',
        url: '/filter/product',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
            $("#data-filter-product-result").html(response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
        }
    });
});

$(document).on('click', '#button-filter-product-add-alternative-matrik', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/alternative-matrik/"+id+"/store",
        method: "post",
        processData: false,
        contentType: false,
        success: function(response) {
            console.log(response);
            if (response == '') {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Produk Berhasil Ditambahkan!',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Produk Tidak Berhasil Ditambahkan!',
                    showConfirmButton: false,
                    timer: 2000
                })
            }
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '#button-add-new-cashier', function () {
    location.href = '/master/cashier/add';
});