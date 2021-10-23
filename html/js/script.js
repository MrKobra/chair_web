$(document).ready(function(){
    // Карточка товара
    $('.items-card').on('mouseover', function(){
        if(!($(this).hasClass('active'))) {
            $(this).addClass('active');
            $(this).find('.items-card-hidden').slideDown(250);
        }
    })
    $('.items-card').on('mouseleave', function(){
        if($(this).hasClass('active')) {
            $(this).removeClass('active');
            $(this).find('.items-card-hidden').slideUp(250);
        }
    })
})