$(document).ready(function(){
    ///////////////////////////////////////////////
    // Start: admin_activity_logs.js             //
    ///////////////////////////////////////////////
    var logTable = $.fn.dataTable.isDataTable('#logTable') 
        ? $('#logTable').DataTable() 
        : $('#logTable').DataTable({
            dom: 'Blfrtip',
            buttons: [
                { extend: 'csv',   className: 'd-none' },
                { extend: 'excel', className: 'd-none' },
                { extend: 'print', className: 'd-none' }
            ],
            lengthChange: true,
            lengthMenu: [[10,20,50,100],[10,20,50,100]],
            pageLength: 10,
            ordering: true,
            order: [[0, 'desc']],
            responsive: true,
            language: { paginate: { previous: '<', next: '>' } },
            initComplete: function() {
                $('#logTable_info').appendTo('#infoContainer');
                $('#logTable_length').appendTo('#lengthContainer');
                $('#logTable_paginate').appendTo('#paginateContainer');
            },
            drawCallback: function() {
                $('#logTable_paginate').appendTo('#paginateContainer');
            }
        });


    // filter modal
    $('#filterForm').submit(function(e){
        e.preventDefault();
        logTable
        .column(7).search($('#filterRole').val())
        .column(8).search($('#filterActive').val())
        .draw();
        $('#filterModal').modal('hide');
    });

    // new account
    $('#newUserBtn').click(function(){
        window.location.href = 'page_admin_account_new.php';
    });

    function loadUsers() {
        const table = $('#logTable').DataTable();
    
        $.getJSON("../backend/phpscripts/admin_activity_log.php", function(response) {
            table.clear().rows.add(response.data).draw();
        });
    }

    loadUsers();
    ///////////////////////////////////////////////
    //   End: admin_activity_logs.js             //
    ///////////////////////////////////////////////


    ///////////////////////////////////////////////
    //   Start: Clean Logs                       //
    ///////////////////////////////////////////////
    document.querySelectorAll('.clean-logs-option').forEach(item => {
        item.addEventListener('click', function () {
            const days = this.getAttribute('data-days');
            if (confirm(`Are you sure you want to delete logs older than ${days} days?`)) {
                fetch('../backend/phpscripts/delete_logs.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `days=${days}`
                })
                .then(res => res.text())
                .then(data => {
                    alert(data); // You can use toast/sweetalert if preferred
                })
                .catch(err => {
                    console.error(err);
                    alert('An error occurred while deleting logs.');
                });
            }
        });
    });
});