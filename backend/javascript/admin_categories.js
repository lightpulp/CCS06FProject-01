    ///////////////////////////////////////
    // Start: page_admin_categories.php  //
    ///////////////////////////////////////
    $('#categoryModal').on('shown.bs.modal', function () {
        $('#categoryName').trigger('focus');
    });

    var categoryTable = $.fn.dataTable.isDataTable('#categoryTable') 
        ? $('#categoryTable').DataTable() 
        : $('#categoryTable').DataTable({
            dom: 'lfrtip',
            lengthChange: true,
            lengthMenu: [[10,20,50],[10,20,50]],
            pageLength: 10,
            ordering: true,
            order: [[0, 'desc']],
            responsive: true,
            language: { paginate: { previous: '<', next: '>' } },
            initComplete: function() {
                $('#categoryTable_info').appendTo('#infoContainer');
                $('#categoryTable_length').appendTo('#lengthContainer');
                $('#categoryTable_paginate').appendTo('#paginateContainer');
            },
            drawCallback: function() {
                $('#categoryTable_paginate').appendTo('#paginateContainer');
            }
    });
    loadCategories();

    function loadCategories() {
        $.ajax({
            url: '../backend/phpscripts/admin_categories.php',
            type: 'GET',
            success: function(data) {
            const categories = JSON.parse(data);
            
            // Clear and repopulate DataTable
            categoryTable.clear();
    
            categories.forEach(cat => {
                categoryTable.row.add([
                    cat.category_id,
                    cat.category_name,
                    cat.created_at,
                    `<a href='#' id='delete-category-btn' class='link-danger' data-id='${cat.category_id}'>
                        <i class='fa-solid fa-trash fs-5'></i>
                    </a>`
                ]);
            });
            categoryTable.draw();
            },
            error: function() {
              alert('There was an error adding the category.');
            }
        });
    }

    $('#categoryForm').on('submit', function(e) {
        e.preventDefault();
        const categoryName = $('#categoryName').val().trim();
      
        if (categoryName === '') {
          alert('Please enter a category name.');
          return;
        }
      
        $.ajax({
          url: '../backend/phpscripts/admin_categories.php',
          type: 'POST',
          data: { categoryName },
          success: function(response) {
            $('#categoryModal').modal('hide');
            $('#categoryForm')[0].reset();
            alert('Category successfully added!');
            loadCategories();
          },
          error: function() {
            alert('There was an error adding the category.');
          }
        });
    });

    $(document).on('click', '#delete-category-btn', function() {
        var id = $(this).data('id');

        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: "../backend/phpscripts/admin_categories.php",
                type: "DELETE",
                data: { id: id },
                success: function() {
                    loadCategories();
                }
            });
        }
    });
    ///////////////////////////////////////////////
    //   End: page_admin_categories.php          //
    ///////////////////////////////////////////////
