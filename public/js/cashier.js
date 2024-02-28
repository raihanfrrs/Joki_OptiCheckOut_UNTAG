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

$(document).on('click', '#button-delete-shopping-cart-product', function () {
    let id = $(this).attr('data-id');

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/delete-shopping-cart-product",
        method: "post",
        data: {
            id: id
        },
        success: function(response) {
            allCashierDetailData();
            $("#wizard-checkout").load(location.href + " #wizard-checkout");
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('change', '#input-product-cart-quantity', function () {
    let id = $(this).attr('data-id');
    let qty = $(this).val();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/update-quantity-shopping-cart-product",
        method: "post",
        data: {
            id: id,
            qty: qty
        },
        success: function(response) {
            $("#checkout-cart-summary").load(location.href + " #checkout-cart-summary");
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '.radio-product-cart-temperature', function () {
    let transaction_id = $(this).attr('data-id');
    let temperature_id = $(this).val();
    
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/update-temperature-shopping-cart-product",
        method: "post",
        data: {
            transaction_id: transaction_id,
            temperature_id: temperature_id
        },
        success: function(response) {
            $("#wizard-checkout").load(location.href + " #wizard-checkout");
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '.radio-product-cart-size', function () {
    let transaction_id = $(this).attr('data-id');
    let size_id = $(this).val();
    
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/update-size-shopping-cart-product",
        method: "post",
        data: {
            transaction_id: transaction_id,
            size_id: size_id
        },
        success: function(response) {
            $("#wizard-checkout").load(location.href + " #wizard-checkout");
        },
        error: function(xhr, status, error) {
        }
    });
});

$(document).on('click', '.radio-product-cart-topping', function () {
    let transaction_id = $(this).attr('data-id');
    let topping_id = $(this).val();
    
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $.ajax({
        url: "/ajax/update-topping-shopping-cart-product",
        method: "post",
        data: {
            transaction_id: transaction_id,
            topping_id: topping_id
        },
        success: function(response) {
            $("#wizard-checkout").load(location.href + " #wizard-checkout");
        },
        error: function(xhr, status, error) {
        }
    });
});