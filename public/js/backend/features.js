(function () {

    FTX.Features = {

        list: {
        
            selectors: {
                features_table: $('#features-table'),
            },
        
            init: function () {

                this.selectors.features_table.dataTable({

                    processing: false,
                    serverSide: true,
                    ajax: {
                        url: this.selectors.features_table.data('ajax_url'),
                        type: 'post',
                    },
                    columns: [

                        { data: 'name', name: 'name' },
                        { data: 'created_at', name: 'created_at' },
                        { data: 'actions', name: 'actions', searchable: false, sortable: false }

                    ],
                    order: [[0, "asc"]],
                    searchDelay: 500,
                    "createdRow": function (row, data, dataIndex) {
                        FTX.Utils.dtAnchorToForm(row);
                    }
                });
            }
        },

        edit: {
            init: function (locale) {
                FTX.tinyMCE.init(locale);                
            }
        },
    }
})();