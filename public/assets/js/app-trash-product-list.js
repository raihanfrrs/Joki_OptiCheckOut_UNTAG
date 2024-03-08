/**
 * Page User List
 */

'use strict';

// Datatable (jquery)
$(function () {
  let borderColor, bodyBg, headingColor;

  if (isDarkStyle) {
    borderColor = config.colors_dark.borderColor;
    bodyBg = config.colors_dark.bodyBg;
    headingColor = config.colors_dark.headingColor;
  } else {
    borderColor = config.colors.borderColor;
    bodyBg = config.colors.bodyBg;
    headingColor = config.colors.headingColor;
  }

  var dt_brand_table = $('#listTrashProductTable');

  if (dt_brand_table.length) {
    var dt_user = dt_brand_table.DataTable({
      ajax: "/listTrashProductTable",
      columns: [
        { data: '' },
        { data: 'index', class: 'text-center' },
        { data: 'product', class: 'text-center' },
        { data: 'category', class: 'text-center' },
        { data: 'temperature', class: 'text-center' },
        { data: 'size', class: 'text-center' },
        { data: 'topping', class: 'text-center' },
        { data: 'stock', class: 'text-center' },
        { data: 'price', class: 'text-center' },
        { data: 'status', class: 'text-center' },
        { data: 'action' }
      ],
      columnDefs: [
        {
          className: 'control',
          searchable: false,
          orderable: false,
          responsivePriority: 2,
          targets: 0,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          targets: 1,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.index;
          }
        },
        {
          targets: 2,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.product;
          }
        },
        {
          targets: 3,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.category;
          }
        },
        {
          targets: 4,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.temperature;
          }
        },
        {
          targets: 5,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.size;
          }
        },
        {
          targets: 6,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.topping;
          }
        },
        {
          targets: 7,
          responsivePriority: 4,
          render: function (data, type, full, meta) {
            return full.stock;
          }
        },
        {
          targets: 8,
          render: function (data, type, full, meta) {
            return full.price;
          }
        },
        {
          targets: 9,
          render: function (data, type, full, meta) {
            return full.status;
          }
        },
        {
          targets: -1,
          title: 'Aksi',
          searchable: false,
          orderable: false,
          render: function (data, type, full, meta) {
              return full.action;
          }
        },
      ],
      order: [[1, 'desc']],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-secondary dropdown-toggle mx-3',
          text: '<i class="ti ti-screen-share me-1 ti-xs"></i>Export',
          buttons: [
            {
              extend: 'print',
              text: '<i class="ti ti-printer me-2" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
              },
              customize: function (win) {
                $(win.document.body)
                  .css('color', headingColor)
                  .css('border-color', borderColor)
                  .css('background-color', bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              text: '<i class="ti ti-file-text me-2" ></i>Csv',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
              }
            },
            {
              extend: 'excel',
              text: '<i class="ti ti-file-spreadsheet me-2"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
              }
            },
            {
              extend: 'pdf',
              text: '<i class="ti ti-file-code-2 me-2"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
              }
            },
            {
              extend: 'copy',
              text: '<i class="ti ti-copy me-2" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [1, 2, 3, 4, 5, 6],
              }
            }
          ]
        }
      ],
      // For responsive popup
      responsive: {
        details: {
          display: $.fn.dataTable.Responsive.display.modal({
            header: function (row) {
              var data = row.data();
              return 'Rincian';
            }
          }),
          type: 'column',
          renderer: function (api, rowIdx, columns) {
            var data = $.map(columns, function (col, i) {
              return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                ? '<tr data-dt-row="' +
                    col.rowIndex +
                    '" data-dt-column="' +
                    col.columnIndex +
                    '">' +
                    '<td>' +
                    col.title +
                    ':' +
                    '</td> ' +
                    '<td>' +
                    col.data +
                    '</td>' +
                    '</tr>'
                : '';
            }).join('');

            return data ? $('<table class="table"/><tbody />').append(data) : false;
          }
        }
      }
    });
  }

  // Delete Record
  $(document).on('click', '#button-delete-product', function () {
    let id = $(this).attr('data-id');
    let formSelector = ".form-delete-product-" + id;

    Swal.fire({
      title: 'Menghapus permanen?',
      text: "Data yang berkaitan dengan product ini tidak dapat dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Cancel',
      confirmButtonText: 'Yes, Delete it!',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function (result) {
      if (result.isConfirmed) {
        $(formSelector).submit();
      }
    });
  });

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
