<?php
include "../backend/phpscripts/session.php";
include "../backend/phpscripts/account.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <!-- start: Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- start: CSS -->
    <link rel="stylesheet" href="../assets/styles/style.css">
    <!-- end: CSS -->
    <title>Account Management</title>
</head>

<style>
/* Bootstrap 5 core */
/* you can also import via CDN in your <head> instead of bundling */
@import "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css";

/* DataTables core styles */
@import "https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css";

/* DataTables Bootstrap 5 integration */
@import "https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css";

/* Optional: Buttons extension (if you need export/print) */
/* @import "https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css"; */

/* — small tweaks from the original theme — */

/* Card spacing */
.card {
  border: none;
}

/* Make the “entries” and “search” controls sit nicely */
.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
  margin-bottom: 1rem;
}

/* Paginate buttons as BS5 buttons */
.dataTables_wrapper .dataTables_paginate .paginate_button {
  padding: 0.25rem 0.5rem;
  margin-left: 0.25rem;
  border-radius: 0.25rem;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
  background-color: var(--bs-primary);
  color: #fff !important;
}

</style>
<body>
    <main class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12">
        <h2 class="mb-2 page-title">Data table</h2>
        <p>DataTables is a plug-in for the jQuery library that adds advanced features to any HTML table.</p>
        <div class="card shadow mb-4">
            <div class="card-body">
            <table id="dataTable-1" class="table table-striped table-hover">
                <thead>
                <tr>
                    <th>
                    <!-- BS5 checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <label class="form-check-label" for="selectAll"></label>
                    </div>
                    </th>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Company</th>
                    <th>Address</th>
                    <th>City</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <!-- …your rows here… -->
                </tbody>
            </table>
            </div>
        </div>
        </div>
    </div>
    </main>


    <!-- start: JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Core DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Buttons extension + Bootstrap 5 styling -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>

    <!-- Optional dependencies for CSV/Excel/PDF/print buttons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <!-- HTML5 export buttons -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script>
          // ────────────────────────────────────────────
  // DataTables init for Account Management
  // ────────────────────────────────────────────
    $(document).ready(function () {
    const table = $('#dataTable-1').DataTable({
        dom: '<"top"fB>rt<"bottom"lip><"clear">',
        buttons: [
            { extend: 'csv',    text: '<i class="fas fa-file-csv"></i> CSV'   },
            { extend: 'excel',  text: '<i class="fas fa-file-excel"></i> Excel' },
            { extend: 'print',  text: '<i class="fas fa-print"></i> Print'    }
        ],
        paging:   true,
        searching: true,
        info:     true,
        lengthMenu: [16, 32, 64],
        columnDefs: [
        { orderable: false, targets: 0 },   // checkbox column
        { orderable: false, targets: -1 }   // action column
        ]
    });

    // “select all” checkbox
    $('#selectAll').on('click', function () {
        const checked = this.checked;
        $('#dataTable-1 tbody input.form-check-input')
        .prop('checked', checked);
    });
    });

    </script>

    <?php include "../components/button_logout.php" ?>

</body>
</html>

