<script>
    var bookingTable;
    var customerId = $('.customer_id').val();

    $(document).ready(function() {






        bookingTable = $('#booking-table').DataTable({
            "order": [
                [1, 'asc']
            ],
            "processing": true,
            "searchDelay": 500,
            "responsive": true,
            "columns": [{
                    "data": "id",
                    "searchable": false,
                    "orderable": false
                },
                {
                    "data": "job_status_data.job_status"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "connote_no"
                },
                {
                    "data": "total_item_qty"
                },
                {
                    "data": "sender_name"
                },
                {
                    "data": "job_receiver.receiver_name"
                },
                {
                    "data": "ready_date"
                },
                {
                    "data": null
                },
                // {
                //     "data": null,
                //     "searchable": false,
                //     "orderable": false
                // }
            ],
            'columnDefs': [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return '<input type="checkbox" name="id[]" value="' + $('<div/>')
                            .text(
                                data).html() + '">';
                    }
                },
                {
                    'targets': 2,
                    'searchable': true,
                    'orderable': true,
                    'width': 200,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        let date =new Date(data)
                        return date.toISOString().slice(0, 10);
                    }
                },
                {
                    'targets': 8,
                    'searchable': true,
                    'orderable': true,
                    'width': 200,
                    'className': 'dt-body-center',
                    'render': function(data, type, full, meta) {
                        return "-";
                    }
                },
                // {
                //     'targets': 9,
                //     'searchable': false,
                //     'orderable': false,
                //     'width': 200,
                //     'className': 'dt-body-center',
                //     'render': function(data, type, full, meta) {
                //         return ` <a title="Edit Booking" class="btn btn-sm btn-clean btn-icon edit-booking">
                //            <i class="icon-1x text-dark-50 flaticon-edit"></i>
                //         </a>
                //         <a class="btn btn-sm btn-clean btn-icon del-booking" title="Delete Booking" >
                //             <i class="icon-1x text-dark-50 flaticon-delete"></i>
                //         </a>
                //         `;
                //     }
                // }
            ],
        });

        $.post("{{ route('get_customer_bookings') }}", {
            "_token": "{{ csrf_token() }}",
            customer_id: customerId
        }, function(data) {
            var objData = JSON.parse(data);
            objData = objData.map(e=>{
                var total_qty = 0;
                e.job_items.map(item=>{
                    total_qty += parseInt(item.item_qty);
                })
                e.total_item_qty = total_qty;
                return e;
            })
            bookingTable.clear();
            bookingTable.rows.add(objData).draw();
            // addEvent();
        });

        // var addBookingForms = ['statusv', 'consignment', 'item_qty', 'sender',
        //     'receiver', 'delivery_date', 'amount', 'id'
        // ];

        // function getFormData() {
        //     var res = [];
        //     res = addBookingForms.map(e => {
        //         return $('#updateBookingForm #' + e).val();
        //     })
        //     return res;
        // }

        // function clearFormData() {
        //     addBookingForms.map(e => {
        //         return $('#updateBookingForm #' + e).val('');
        //     });
        // }

        // function setFormData(bookingData) {
        //     $('#statusv').val(bookingData['statusv']);
        //     $('#consignment').val(bookingData['consignment']);
        //     $('#item_qty').val(bookingData['item_qty']);
        //     $('#sender').val(bookingData['sender']);
        //     $('#receiver').val(bookingData['receiver']);
        //     $('#delivery_date').val(bookingData['delivery_date']);
        //     $('#amount').val(bookingData['amount']);
        //     $('#updateBookingForm #id').val(bookingData['id']);
        // }

        // var index = 0;
        // var updateRow;

        // function addEvent() {
        //     $('.del-booking').click(function() {
        //         if (customerId) {
        //             var rowObj = bookingTable.row($(this).parents('tr'));
        //             rowData = rowObj.data();
        //             rowData['_token'] = "{{ csrf_token() }}";
        //             $.post("{{ route('delete_booking') }}", rowData, function(data) {
        //                 rowObj.remove().draw();
        //             });
        //         } else {
        //             bookingTable
        //                 .row($(this).parents('tr'))
        //                 .remove()
        //                 .draw();
        //         }
        //     });
        //     $('.edit-booking').click(function() {
        //         updateRow = bookingTable.row($(this).parents('tr'));
        //         formData = updateRow.data();

        //         setFormData(formData);
        //         console.log(bookingTable
        //             .row($(this).parents('tr')).data());
        //         $('#bookingModalLabel').html('Update Booking');
        //         $('.update_booking_btn').html('Update');
        //         $("#bookingModal").modal('show');
        //     });
        // }


        // $('.update_booking_btn').click(function() {
        //     $("#bookingModal").modal('hide');
        //     var vals = getFormData();
        //     if ($('.update_booking_btn').html() == 'Add') {
        //         if (customerId) {
        //             var formData = $("#updateBookingForm").serialize();
        //             formData += "&customer_id=" + customerId;
        //             console.log(formData);
        //             $.post("{{ route('customer_bookings.store') }}", formData, function(data) {
        //                 console.log("res", data);
        //                 bookingTable.row.add(JSON.parse(data)).draw(false);
        //                 addEvent();
        //             });
        //         } else {
        //             bookingTable.row.add({
        //                 id: index,
        //                 statusv: vals[0],
        //                 consignment: vals[1],
        //                 item_qty: vals[2],
        //                 sender: vals[3],
        //                 receiver: vals[4],
        //                 delivery_date: vals[5],
        //                 amount: vals[6],
        //             }).draw(false);
        //             index++;
        //             addEvent();
        //         }
        //     } else {
        //         if (customerId) {
        //             var formData = $("#updateBookingForm").serialize();
        //             $.post("{{ route('update_booking') }}", formData, function(data) {
        //                 console.log("res", data);
        //                 formData = updateRow.data();
        //                 updateRow.data(JSON.parse(data));
        //                 addEvent();
        //             });
        //         } else {
        //             formData = updateRow.data();
        //             updateRow.data({
        //                 id: formData['id'],
        //                 statusv: vals[0],
        //                 consignment: vals[1],
        //                 item_qty: vals[2],
        //                 sender: vals[3],
        //                 receiver: vals[4],
        //                 delivery_date: vals[5],
        //                 amount: vals[6],
        //             });
        //             addEvent();
        //         }
        //     }

        // });

        // $('#add_booking_btn').click(function() {
        //     clearFormData();
        //     $('#bookingModalLabel').html('Add Booking');
        //     $('.update_booking_btn').html('Add');
        //     $("#bookingModal").modal('show');
        // });

        // $('#del_booking_btn').click(function() {
        //     $('input[name^="id"]:checked').each(function() {
        //         if (customerId) {
        //             var rowObj = bookingTable.row($(this).parents('tr'));
        //             rowData = rowObj.data();
        //             rowData['_token'] = "{{ csrf_token() }}";
        //             $.post("{{ route('delete_booking') }}", rowData, function(data) {
        //                 rowObj.remove().draw();
        //             });
        //         } else {
        //             bookingTable
        //                 .row($(this).parents('tr'))
        //                 .remove()
        //                 .draw();
        //         }
        //     });
        // });

        $('#booking-select-all').on('click', function() {
            // Get all rows with search applied
            var rows = bookingTable.rows({
                'search': 'applied'
            }).nodes();
            // Check/uncheck checkboxes for all rows in the table
            $('input[type="checkbox"]', rows).prop('checked', this.checked);
        });

    });
</script>
