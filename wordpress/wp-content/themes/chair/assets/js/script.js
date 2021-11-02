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
    // Слайдер на главной
    $('.home-slider').slick({
        infinite: false
    });
    // Стилизация
    $('#catalog-sort').styler();
    $('#items-count').styler();
    $('#pa_cvet').styler();
    $('#count-var').styler();
    $('#pa_razmer').styler();
    $('.catalog-sidebar-slider input').styler();
    // Ввод только цифр
    $('.catalog-sidebar-slider input').keydown(function (event){
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 ||
            (event.keyCode == 65 && event.ctrlKey === true) ||
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            return;
        } else {
            if ((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    })
    // Ползунок
    $(function(){
        if($('#price-slider').length != 0) {
            var min = $('#price-slider').data('min');
            var max = $('#price-slider').data('max');
            $('#price-slider').slider({
                animate: "slow",
                range: true,
                min: min,
                max: max,
                values: [$('input[name=min_price]').val(), $('input[name=max_price]').val()],
                slide: function(event, ui) {
                    $('input[name=min_price]').val(ui.values[0]);
                    $('input[name=max_price]').val(ui.values[1]);
                }
            })
        }
        if($('#weight-slider').length != 0) {
            var min = $('#weight-slider').data('min');
            var max = $('#weight-slider').data('max');
            $('#weight-slider').slider({
                animate: "slow",
                range: true,
                min: min,
                max: max,
                values: [$('input[name=min_weight]').val(), $('input[name=max_weight]').val()],
                slide: function(event, ui) {
                    $('input[name=min_weight]').val(ui.values[0]);
                    $('input[name=max_weight]').val(ui.values[1]);
                }
            })
        }
    })
    // Checkbox
    $('.catalog-sidebar-row input[type=checkbox]').each(function(){
        if($(this).prop('checked')) {
            $(this).parent().addClass('checked')
        } else {
            $(this).parent().removeClass('checked')
        }
    })
    $('.catalog-sidebar-row input[type=checkbox]').on('change', function(){
        if($(this).prop('checked')) {
            $(this).parent().addClass('checked')
        } else {
            $(this).parent().removeClass('checked')
        }
    })
    // Скрыть пункты
    function hideSidebarCheckbox() {
        $('.catalog-sidebar-checkbox').each(function(){
            var count = $(this).find('.catalog-sidebar-row').length;
            if(count > 7) {
                var i = 0;
                $(this).find('.catalog-sidebar-row').each(function(){
                    i++;
                    if(i > 7) {
                        $(this).hide();
                    }
                    if(i == count && $(this).parent().find('.show-full-filter').length == 0) {
                        $(this).after('<a href="#" class="show-full-filter show">Показать еще ('+(count - 7)+')</a>');
                    }
                })
            }
        })
    }
    hideSidebarCheckbox();
    // Показать пункты
    $('.show-full-filter').on('click', function(e){
        e.preventDefault();
        if($(this).hasClass('show')) {
            $(this).removeClass('show');
            $(this).addClass('hide');
            $(this).parent().find('.catalog-sidebar-row').show();
            $(this).text('Скрыть');
        } else {
            $(this).removeClass('hide');
            $(this).addClass('show');
            hideSidebarCheckbox();
        }
    })
    // Показать блоки
    $('.catalog-sidebar-checkbox .catalog-sidebar-header').on('click', function(){
        $(this).parent().toggleClass('active');
        $(this).parent().find('.catalog-sidebar-body').slideToggle(500);
    })
    // Слайдер в карточке товаров
    $('.single-item-slider-big').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.single-item-slider-small',
    });
    $('.single-item-slider-small').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.single-item-slider-big',
        focusOnSelect: true,
    });
    // Выбор цвета
    function selectColor(){
        var color = $('#pa_cvet option:selected').data('color');
        $('#pa_cvet').parent().find('.jq-selectbox__select').css('background', color);
    }
    selectColor();
    $('#pa_cvet').on('change', function(){
        selectColor();
    })
    $('#pa_cvet').parent().find('.jq-selectbox__dropdown li').each(function(){
        $(this).css('background', $(this).data('color'));
    })
    // Выбор количества элементов
    $('select[name=item-count]').on('change', function(){
        $('input[name=quantity]').val($(this).val());
    })
    // Изменение размера в характеристиках
    function setSizeProperty() {
        if($('#pa_razmer').length != 0) {
            var width = $('#pa_razmer').find('option:selected').data('width');
            var height = $('#pa_razmer').find('option:selected').data('height');
            var length = $('#pa_razmer').find('option:selected').data('length');
            $('.single-item-property li.width').html('<span>Ширина</span> '+width);
            $('.single-item-property li.height').html('<span>Высота</span> '+height);
            $('.single-item-property li.length').html('<span>Глубина</span> '+length);
        }
    }
    setSizeProperty();
    $('#pa_razmer').on('change', function(){
        setSizeProperty();
    })
})