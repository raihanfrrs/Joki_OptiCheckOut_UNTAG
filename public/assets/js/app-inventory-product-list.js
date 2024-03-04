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

  var dt_brand_table = $('#listInventoryProductTable');

  if (dt_brand_table.length) {
    var dt_user = dt_brand_table.DataTable({
      ajax: "/listInventoryProductTable",
      columns: [
        { data: '' },
        { data: 'index', class: 'text-center' },
        { data: 'product', class: 'text-center' },
        { data: 'category', class: 'text-center' },
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
            return full.stock;
          }
        },
        {
          targets: 5,
          render: function (data, type, full, meta) {
            return full.price;
          }
        },
        {
          targets: 6,
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
      language: {
        sLengthMenu: '_MENU_',
        search: '',
        searchPlaceholder: 'Search..'
      },
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

  // Filter form control to default size
  // ? setTimeout used for multilingual table initialization
  setTimeout(() => {
    $('.dataTables_filter .form-control').removeClass('form-control-sm');
    $('.dataTables_length .form-select').removeClass('form-select-sm');
  }, 300);
});
