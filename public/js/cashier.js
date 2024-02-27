$(document).ready(() => {
    allCashierDetailData();
});

const cashierDetailData = (url, targetSelector, property) => {
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

const allCashierDetailData = () => {
    cashierDetailData("/ajax/shopping-cart-count", "#label-total-shopping-cart-count", 'd-none');
};

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

$(document).on('click', '#button-add-to-cart', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/add-to-cart",
        method: "post",
        data: {
            id: id
        },
        success: function(response) {
            if (response == false) {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'Product already added to cart',
                    showConfirmButton: false,
                    timer: 2000
                });
            } else {
                allCashierDetailData();
                $("#row-list-products").load(location.href + " #row-list-products");

                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Product added to cart',
                    showConfirmButton: false,
                    timer: 2000
                });
            }
        },
        error: function(xhr, status, error) {
        }
    });
});