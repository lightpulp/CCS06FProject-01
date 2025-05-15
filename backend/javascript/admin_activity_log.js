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

    // new account
    $('#newUserBtn').click(function(){
        window.location.href = 'page_admin_account_new.php';
    });

    function loadLogs() {
        const table = $('#logTable').DataTable();
    
        $.getJSON("../backend/phpscripts/admin_activity_log.php", function(response) {
            table.clear().rows.add(response.data).draw();
        });
    }

    $(function(){
        const logTable = $('#logTable').DataTable(/* … your existing init … */);

        let allLogs = [];
        $.getJSON('../backend/phpscripts/admin_activity_log.php', resp => {
            allLogs = resp.data;
            logTable.clear().rows.add(allLogs).draw();

            // populate Action dropdown
            const actions = [...new Set(allLogs.map(r => r[3]))].sort();
            const actSel  = $('#filterLogAction').empty().append('<option value="">All</option>');
            actions.forEach(a => actSel.append(`<option>${a}</option>`));
        });

        // custom date-range + action filter
        $.fn.dataTable.ext.search.push((settings, row) => {
            if (settings.nTable.id !== 'logTable') return true;

            const startDate = $('#filterLogStart').val();
            const endDate   = $('#filterLogEnd').val();
            const actionVal = $('#filterLogAction').val();

            const tsRow = row[1];
            const rowDate = tsRow.slice(0, 10);
            const rowAction = row[3];

            // exclude if before start
            if (startDate && rowDate < startDate) return false;
            // exclude if after  end
            if (endDate   && rowDate > endDate)   return false;
            // exclude if action filter set and mismatched
            if (actionVal && rowAction !== actionVal) return false;

            return true;
        });

        // re-draw on filter submit
        $('#filterActivityLogForm').on('submit', e => {
            e.preventDefault();
            logTable.draw();
            $('#filterActivityLogModal').modal('hide');
        });
    });

    loadLogs();
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