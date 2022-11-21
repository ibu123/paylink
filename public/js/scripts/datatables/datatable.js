/*=========================================================================================
    File Name: datatables-basic.js
    Description: Basic Datatable
    ----------------------------------------------------------------------------------------
    Item Name: Frest HTML Admin Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
(function( factory ){
	if ( typeof define === 'function' && define.amd ) {
		// AMD
		define( ['jquery', 'datatables.net'], function ( $ ) {
			return factory( $, window, document );
		} );
	}
	else if ( typeof exports === 'object' ) {
		// CommonJS
		module.exports = function (root, $) {
			if ( ! root ) {
				root = window;
			}

			if ( ! $ || ! $.fn.dataTable ) {
				// Require DataTables, which attaches to jQuery, including
				// jQuery if needed and have a $ property so we can access the
				// jQuery object that is used
				$ = require('datatables.net')(root, $).$;
			}

			return factory( $, root, root.document );
		};
	}
	else {
		// Browser
		factory( jQuery, window, document );
	}
}(function( $, window, document, undefined ) {
'use strict';
var DataTable = $.fn.dataTable;


$.extend( DataTable.ext.pager, {

     custom: function (page, pages) {
        return [ 'first', 'previous', DataTable.ext.pager._numbers(page, pages), 'next', 'last' ];
    },

} );

$.extend(true, DataTable.ext.renderer, {
    pageButton: {
      bootstrap: function(settings, host, idx, buttons, page, pages, eeee) {
        var classes = settings.oClasses;
        var lang = settings.oLanguage.oPaginate;
        var aria = settings.oLanguage.oAria.paginate || {};
        var _fnBindAction = settings.oApi._fnBindAction || {};
        var _fnPageChange = settings.oApi._fnPageChange || {};
        var btnDisplay,
          btnClass,
          counter = 0;
        var attach = function(container, buttons) {
          var i, ien, node, button;
          var clickHandler = function(e) {
            _fnPageChange(settings, e.data.action, true);
          };
          for (i = 0, ien = buttons.length; i < ien; i++) {
            button = buttons[i];

            if ($.isArray(button)) {
              var inner;
              if (settings.sPaginationType == "custom") {
                // window.pageNumber = ;
                // if(window.pagination + 1 > 1) {
                //     pageNumber = window.pagination + 1
                // }
                inner = $(
                  "<input type='text' class='custom-pagination' value='" + parseInt(page + 1)  + "'>"
                ).appendTo(container);
              } else {
                inner = $("<" + (button.DT_el || "div") + "/>").appendTo(
                  container
                );
                attach(inner, button);
              }
            } else {
              btnDisplay = null;
              btnClass = "";

              switch (button) {
                case "ellipsis":
                  container.append('<span class="ellipsis">&#x2026;</span>');
                  break;

                case "first":
                  btnDisplay = lang.sFirst + " (" + 1 + ")";
                  btnClass =
                    button +
                    (page > 0 ? "" : " " + classes.sPageButtonDisabled);
                  break;

                case "previous":
                  btnDisplay = lang.sPrevious;
                  btnClass =
                    button +
                    (page > 0 ? "" : " " + classes.sPageButtonDisabled);
                  break;

                case "next":
                  btnDisplay = lang.sNext;
                  btnClass =
                    button +
                    (page < pages - 1 ? "" : " " + classes.sPageButtonDisabled);
                  break;

                case "last":
                  btnDisplay = lang.sLast + " (" + (pages) + ")";
                  btnClass =
                    button +
                    (page < pages - 1 ? "" : " " + classes.sPageButtonDisabled);
                  break;

                default:
                  // To Button
                  btnDisplay = button + 1;
                  btnClass = page === button ? classes.sPageButtonActive : "";
                  break;
              }

              if (btnDisplay !== null) {
//
                  node = $("<a>", {
                    class: classes.sPageButton + " " + btnClass,
                    "aria-controls": settings.sTableId,
                    "aria-label": aria[button],
                    "data-dt-idx": counter,
                    tabindex: settings.iTabIndex,
                    id:
                      idx === 0 && typeof button === "string"
                        ? settings.sTableId + "_" + button
                        : null
                  })
                    .html(btnDisplay)
                    .appendTo(container);
//                 }

                _fnBindAction(node, { action: button }, clickHandler);

                counter++;
              }
            }
          }
        };

        // IE9 throws an 'unknown error' if document.activeElement is used
        // inside an iframe or frame. Try / catch the error. Not good for
        // accessibility, but neither are frames.
        var activeEl;

        try {
          // Because this approach is destroying and recreating the paging
          // elements, focus is lost on the select button which is bad for
          // accessibility. So we want to restore focus once the draw has
          // completed
          activeEl = $(host)
            .find(document.activeElement)
            .data("dt-idx");
        } catch (e) {}

        attach($(host).empty(), buttons);

        if (activeEl !== undefined) {
          $(host)
            .find("[data-dt-idx=" + activeEl + "]")
            .focus();
        }
      }
    }
});
return DataTable;
}));

$(document).ready(function() {

    /****************************************
    *       js of zero configuration        *
    ****************************************/
    $("#file").on("change", function(){
        var file = this.files[0].name;
        $(this).parent().find(".form-control span:first").text(file);
    });
    let url = $('.zero-configuration').data("url");
    window.mainTable = $('.zero-configuration').DataTable({


        dom: 'trp',
        pagingType : 'custom',
        processing: true,
        serverSide: true,
        ajax : {
            url : url,
            dataType : "json",
            type : "POST",
            data : function ( d ) {
                return $.extend( {}, d, {
                    "id" : window.filtreIDS,
                    "merchant_name" : window.filterMerchantName,
                    "_token" : window._token,
                    // "start" : ($(".custom-pagination").val() - 1)* 10,
                } );
            }
        },
        language : {
            "paginate": {
                "first":      "الأولى",
                "last":       "الأخيرة",
                "next":       "التالي",
                "previous":   "السابق"
            },
            "emptyTable" : "لا توجد بيانات متوفرة في الجدول",
            "processing" : "يتم المعالجة"
        },
        order: [[0, 'desc']],
        columns: [
            {data: 'id', name: 'id'},
            {data: 'store_display_name', name: 'store_display_name'},
            {data: 'phone_no', name: 'user.phone_no'},
            {data: 'no_of_links', name: 'no_of_links', searchable : false },
            {data: 'revenues', name: 'revenues', searchable : false },
            {data: 'net_profit', name: 'net_profit', searchable : false},
            {data: 'action', name: 'action', searchable : false, sortable : false},

        ],
    });
    let urll = $('.zero-configuration-2').data("url");
    window.mainTable = $('.zero-configuration-2').DataTable({
        dom: 'trp',
        pagingType : 'custom',
        processing: true,
        serverSide: true,
        ajax : {
            url : urll,
            dataType : "json",
            type : "POST",
            data : function ( d ) {
                console.log(d);
                return $.extend( {}, d, {
                    "_token" : window._token,
                    "id" : window.filtreIDS,
                    "status" : window.filterStatus,
                    "amount_from" : window.filterAmountFrom,
                    "amount_to" : window.filterAmountTo,
                    // "start" : ($(".custom-pagination").val() - 1)* 10,
                } );
            }
        },
        language : {
            "paginate": {
                "first":      "الأولى",
                "last":       "الأخيرة",
                "next":       "التالي",
                "previous":   "السابق"
            },
            "emptyTable" : "لا توجد بيانات متوفرة في الجدول",
            "processing" : "يتم المعالجة"
        },
        columns: [
            {data: 'id', name: 'id'},
            {data: 'amount', name: 'amount'},
            {data: 'payment_status', name: 'payment_status'},
            {data: 'send_payment_status', name: 'send_payment_status', searchable : false, sortable : false},
            {data: 'action', name: 'action', searchable : false, sortable : false},

        ],
        drawCallback : function(settings) {
            // alert("Eee");
            let clipboard2= new ClipboardJS('.copy_text_2',
            document.getElementsByClassName('custom__copy__container'));
            clipboard2.on('success', function(e) {
                console.log(e);
            });
            clipboard2.on('error', function(e) {
                console.log(e);
            });

            $('[data-toggle="tooltip"]').tooltip()
        }

    });

    /********************************************
     *        js of Order by the grouping        *
     ********************************************/

    var groupingTable = $('.row-grouping').DataTable({
        "columnDefs": [{
            "visible": false,
            "targets": 2
        }],
        "order": [
            [2, 'asc']
        ],
        "displayLength": 10,
        "drawCallback": function(settings) {
            var api = this.api();
            var rows = api.rows({
                page: 'current'
            }).nodes();
            var last = null;

            api.column(2, {
                page: 'current'
            }).data().each(function(group, i) {
                if (last !== group) {
                    $(rows).eq(i).before(
                        '<tr class="group"><td colspan="5">' + group + '</td></tr>'
                    );

                    last = group;
                }
            });
        }
    });

    $('.row-grouping tbody').on('click', 'tr.group', function() {
        var currentOrder = groupingTable.order()[0];
        if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
            groupingTable.order([2, 'desc']).draw();
        }
        else {
            groupingTable.order([2, 'asc']).draw();
        }
    });

    /*************************************
    *       js of complex headers        *
    *************************************/

    $('.complex-headers').DataTable();


    /*****************************
    *       js of Add Row        *
    ******************************/

    var t = $('.add-rows').DataTable();
    var counter = 2;

    $('#addRow').on( 'click', function () {
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw( false );

        counter++;
    });


    /**************************************************************
    * js of Tab for COLUMN SELECTORS WITH EXPORT AND PRINT OPTIONS *
    ***************************************************************/

    $('.dataex-html5-selectors').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, ':visible' ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                text: 'JSON',
                action: function ( e, dt, button, config ) {
                    var data = dt.buttons.exportData();

                    $.fn.dataTable.fileSave(
                        new Blob( [ JSON.stringify( data ) ] ),
                        'Export.json'
                    );
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            }
        ]
    });

    /**************************************************
    *       js of scroll horizontal & vertical        *
    **************************************************/

    $('.scroll-horizontal-vertical').DataTable( {
        "scrollY": 200,
        "scrollX": true
    });


});
