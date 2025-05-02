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

    // start: Sidebar
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
        $('.sidebar').addClass('collapsed')
    }

    // Auto-expand the current section
    $('.sidebar-dropdown-menu-item.active').closest('.sidebar-dropdown-menu').slideDown('fast');
    $('.sidebar-dropdown-menu-item.active').closest('.has-dropdown').addClass('focused');

    
    $(document).on('click', '#logoutAccount', function (e) {
        e.preventDefault(); // Prevent actual link behavior
        $('#logoutModal').modal('show'); // Trigger Bootstrap modal
    });
});

    // Auto-collapse sidebar when window shrinks below 768px
    $(window).on('resize', function () {
        if ($(window).width() < 768) {
            if (!$('.sidebar').hasClass('collapsed')) {
                $('.sidebar').addClass('collapsed');
                $('.sidebar-overlay').addClass('d-none');
                $('.sidebar-dropdown-menu').slideUp('fast');
                $('.sidebar-menu-item.has-dropdown, .sidebar-dropdown-menu-item.has-dropdown').removeClass('focused');
            }
        } else {
            // ✅ EXPAND SIDEBAR WHEN SCREEN > 768px
            if ($('.sidebar').hasClass('collapsed')) {
                $('.sidebar').removeClass('collapsed');
                $('.sidebar-overlay').addClass('d-none');
                $('.sidebar-dropdown-menu-item.active').closest('.sidebar-dropdown-menu').slideDown('fast');
                $('.sidebar-dropdown-menu-item.active').closest('.has-dropdown').addClass('focused');
            }
        }
    // Trigger it once on load to apply the correct state
    $(window).trigger('resize');
    // end: Sidebar
});