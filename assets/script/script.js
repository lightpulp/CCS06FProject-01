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


    if (window.innerWidth < 768) {
        $('.sidebar').addClass('collapsed');
        $('.sidebar-overlay').addClass('d-none');
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

    $('#newAccountBtn').on('click', function () {
        $('#createUserModal').modal('show');
    });

        // initialize validation
    $('#createUserForm').validate({
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        highlight(el) {
            $(el).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight(el) {
            $(el).addClass('is-valid').removeClass('is-invalid');
        },
        // << add this block >>
        errorPlacement(error, element) {
            if (element.parent('.input-group').length) {
            error.insertAfter(element.parent());
            } else {
            error.insertAfter(element);
            }
        },
        // validation rules
        rules: {
            user_fname: { required: true },
            user_lname: { required: true },
            user_name:  { required: true },
            user_pass:  { required: true },
            confirm_password: { required: true, equalTo: '#userPassword' },
            user_email: { required: true, email: true },
            birthdate:  { date: true },
            address:    { required: true },
            number: { 
                required: true, 
                digits: true, 
                minlength: 11, 
                maxlength: 11 
                },
            role:       { required: true },
            active:     { required: true }
        },

        // optional custom messages
        messages: {
            confirm_password: {
                equalTo: 'Passwords must match.'
            },
            number: {
                minlength: 'Enter an 11-digit phone number, e.g. 09171234567',
                maxlength: 'Enter an 11-digit phone number, e.g. 09171234567'
            }
        },
        submitHandler: function(form) {
            // serialize *that* form
            const data = $(form).serialize();
            $.ajax({
                type: 'POST',
                url: '../backend/phpscripts/admin_create_user.php',
                data: data,
                dataType: 'json'
            })
            .done(function(res) {
                if (res.success) {
                    alert(res.message);
                    $('#createUserModal').modal('hide');
                    loadUsers();
                } else {
                    alert('Error: ' + res.message);
                }
                })
                .fail(function(xhr, status, err) {
                alert('AJAX failed: ' + status + ' — ' + err);
            });
        }
    });

    // 2) reset on close
    $('#createUserModal').on('hidden.bs.modal', function(){
        const $form = $('#createUserForm');
        // a) HTML reset

        $form[0].reset();
        // b) Reset jQuery Validate
        if ($form.data('validator')) {
            $form.validate().resetForm(); // clears internal error tracking
        }

        // c) Remove all Bootstrap validation classes and feedback messages manually
        $form.find('.form-control, .form-select')
            .removeClass('is-valid is-invalid');

        $form.find('.invalid-feedback').remove(); // also remove error <div>s from DOM
    });

    $('#createUserModal').on('shown.bs.modal', function () {
        $('#userFname').trigger('focus');
    });
    ///////////////////////////////////////////////
    //   End: page_admin_account_management.php  //
    ///////////////////////////////////////////////
});