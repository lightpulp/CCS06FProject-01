$(document).ready(function(){
    $('.toggle-password').click(function () {
        const $icon = $(this).find('i');
        const $input = $(this).siblings('input');
      
        const isPassword = $input.attr('type') === 'password';
      
        $input.attr('type', isPassword ? 'text' : 'password');
        $icon.toggleClass('fa-eye fa-eye-slash');
    });    

    $('.btn-primary').on('click', function (e) {
        const button = $(this);
        
        button.addClass('animate__animated animate__pulse');
    
        // Remove the class after animation ends to allow it to trigger again next click
        button.one('animationend', function () {
        button.removeClass('animate__animated animate__pulse');
        });
    });

    $(document).on('click', '#logoutAccount', function (e) {
        e.preventDefault(); // Prevent actual link behavior
        $('#logoutModal').modal('show'); // Trigger Bootstrap modal
    });

    ////////////////////////////////////////////
    //  START: DATATABLES EXPORT AND SEARCH   //
    ////////////////////////////////////////////

    // custom search
    $('.table-search').on('keyup', function() {
        const tableSelector = $(this).data('table');
        const table = $(tableSelector).DataTable();
        table.search(this.value).draw();
        
        if (!$('#adminCardViewArticleContainer').hasClass('d-none')) {
            renderCards();
        }
    });
    
    // dynamically reference
    $('.export-btn').on('click', function(e) {
        e.preventDefault();
        const type = $(this).data('type');
        const tableSelector = $(this).data('table');
        const table = $(tableSelector).DataTable();

        const buttonIndex = { csv: 0, excel: 1, print: 2 }[type];
        if (table && buttonIndex !== undefined) {
            table.button(buttonIndex).trigger();
        }
    });

    //////////////////////////////////////////
    //  END: DATATABLES EXPORT AND SEARCH   //
    //////////////////////////////////////////

    
    //////////////////////////////////////////
    //           Start: Sidebar             //
    //////////////////////////////////////////
    if (!$('.sidebar').hasClass('collapsed')) {
        $('.sidebar-dropdown-menu-item.active').closest('.sidebar-dropdown-menu').slideDown('fast');
        $('.sidebar-dropdown-menu-item.active').closest('.has-dropdown').addClass('focused');
    } else {
        $('.sidebar-dropdown-menu').hide(); // Ensure all dropdowns stay hidden in collapsed view
    }

    $('.sidebar-dropdown-menu').slideUp('fast')

    $('.sidebar-menu-item.has-dropdown > a, .sidebar-dropdown-menu-item.has-dropdown > a').click(function(e) {
        e.preventDefault()

        if(!($(this).parent().hasClass('focused'))) {
            $(this).parent().parent().find('.sidebar-dropdown-menu').slideUp('fast')
            $(this).parent().parent().find('.has-dropdown').removeClass('focused')
        }

        $(this).next().slideToggle('fast')
        $(this).parent().toggleClass('focused')
    })

    $('.sidebar-toggle').click(function () {
        const isCollapsed = $('.sidebar').hasClass('collapsed');

        $('.sidebar').toggleClass('collapsed');
        
        if ($(window).width() < 768) {
            $('.sidebar-overlay').toggleClass('d-none');
        }

        if (!isCollapsed) {
            // Sidebar is about to collapse – close all dropdowns
            $('.sidebar-dropdown-menu').slideUp('fast');
            // $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused');
        } else {
            // Sidebar is expanding – reopen the active dropdowns
            $('.sidebar-dropdown-menu-item.active').closest('.sidebar-dropdown-menu').slideDown('fast');
            $('.sidebar-dropdown-menu-item.active').closest('.has-dropdown').addClass('focused');
        }
    });

    $('.sidebar-overlay').click(function() {
        if ($(window).width() < 768) {
            $('.sidebar').addClass('collapsed');
            $('.sidebar-overlay').addClass('d-none'); // hide overlay again
            $('.sidebar-dropdown-menu').slideUp('fast');
            $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused');
        }
    });


    if(window.innerWidth < 768) {
        $('.sidebar').addClass('collapsed');
    }

    // Auto-expand the current section
    $('.sidebar-dropdown-menu-item.active').closest('.sidebar-dropdown-menu').slideDown('fast');
    $('.sidebar-dropdown-menu-item.active').closest('.has-dropdown').addClass('focused');

    // Auto-collapse sidebar when window shrinks below 768px
    $(window).on('resize', function () {
        if ($(window).width() < 768) {
            if (!$('.sidebar').hasClass('collapsed')) {
                $('.sidebar').addClass('collapsed');
                $('.sidebar-overlay').addClass('d-none');
                $('.sidebar-dropdown-menu').slideUp('fast');
                $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused');
                $('#exploreCardViewArticleContainer').removeClass('mx-5');
            }
        } else {
            // ✅ EXPAND SIDEBAR WHEN SCREEN > 768px
            if ($('.sidebar').hasClass('collapsed')) {
                $('.sidebar').removeClass('collapsed');
                $('.sidebar-overlay').addClass('d-none');
                $('.sidebar-dropdown-menu-item.active').closest('.sidebar-dropdown-menu').slideDown('fast');
                $('.sidebar-dropdown-menu-item.active').closest('.has-dropdown').addClass('focused');
                $('#exploreCardViewArticleContainer').addClass('mx-5');
            }
        }
        // Trigger it once on load to apply the correct state
        $(window).trigger('resize');
    });

    //////////////////////////////////////////
    //           End: Sidebar               //
    //////////////////////////////////////////
    
    ///////////////////////////////////////////////
    // Start: page_admin_account_management.php  //
    ///////////////////////////////////////////////
    var accountTable = $.fn.dataTable.isDataTable('#accountTable') 
        ? $('#accountTable').DataTable() 
        : $('#accountTable').DataTable({
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
                $('#accountTable_info').appendTo('#infoContainer');
                $('#accountTable_length').appendTo('#lengthContainer');
                $('#accountTable_paginate').appendTo('#paginateContainer');
            },
            drawCallback: function() {
                $('#accountTable_paginate').appendTo('#paginateContainer');
            }
        });


    // filter modal
    $('#filterForm').submit(function(e){
        e.preventDefault();
        accountTable
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
        const table = $('#accountTable').DataTable();
    
        $.getJSON("../backend/phpscripts/admin_account_table.php", function(response) {
            table.clear().rows.add(response.data).draw();
        });
    }

    loadUsers();
    ///////////////////////////////////////////////
    //   End: page_admin_account_management.php  //
    ///////////////////////////////////////////////

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

    loadCategories();
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
});