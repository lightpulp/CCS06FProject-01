$(document).ready(function(){
    $('.toggle-password').click(function () {
        const $icon = $(this).find('i');
        const $input = $(this).siblings('input');
      
        const isPassword = $input.attr('type') === 'password';
      
        $input.attr('type', isPassword ? 'text' : 'password');
        $icon.toggleClass('fa-eye fa-eye-slash');
    });    

    $('.btn-primary').on('click', function (e) {
        e.preventDefault(); // prevent form from submitting instantly for demo
        const button = $(this);
        
        button.addClass('animate__animated animate__pulse');
    
        // Remove the class after animation ends to allow it to trigger again next click
        button.one('animationend', function () {
          button.removeClass('animate__animated animate__pulse');
        });
    });
});