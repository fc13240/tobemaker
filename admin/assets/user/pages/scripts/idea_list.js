var TableManaged = function () {

    var initTable = function () {

        
        var table = $('#sample_1');

        // begin first table
        table.dataTable({
            "serverSide": true,
            "ajax": {
                "url": 'http://localhost/tobemaker/api/idea.php',
                "type": 'post',
                "timeout": 20000,
                "data": function (data) { // add request parameters before submit

                },
                    
                "dataSrc": function (res) { // Manipulate the data returned from the server
                    
                    return res.data;
                },
                "error": function () { // handle general connection errors
                    
                },
                
            },
            
            "columns": [{
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": false
            }, {
                "orderable": false
            }, {
                "orderable": true
            }, {
                "orderable": true
            }, {
                "orderable": false
            }],
            "lengthMenu": [
                [25, 50, 100, -1],
                [25, 50, 100, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 25,            
            "pagingType": "bootstrap_full_number",
            "language": {
                "lengthMenu": "  _MENU_ records",
                "paginate": {
                    "previous":"Prev",
                    "next": "Next",
                    "last": "Last",
                    "first": "First"
                }
            },
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ], // set first column as a default sort by asc
            "drawCallback": function (oSettings) { // run some code on table redraw
//                if (tableInitialized === false) { // check if table has been initialized
//                    tableInitialized = true; // set table initialized
                    table.show(); // display table
//                }
                Metronic.initUniform($('input[type="checkbox"]', table)); // reinitialize uniform checkboxes on each table reload
//                countSelectedRecords(); // reset selected records indicator
            },
        });

        var tableWrapper = jQuery('#sample_1_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
        });

        tableWrapper.find('.dataTables_length select').addClass("form-control input-xsmall input-inline"); // modify table per page dropdown
    }

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable();
        }

    };

}();