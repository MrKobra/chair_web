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
    // Количество выводимых постов
    $('#items-count').on('change', function(){
        var count = $(this).val();
        var url = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
        var search = window.location.search;
        if(search.length == 0) {
            url = url + '?count='+value;
        } else {
            search = search.split('&');
            $.each(search, function(index, value) {
                var item = value.split('=');
                if(item[0] == 'count') {
                    url = url + '&count=' + count;
                } else if(item[0] == '?count') {
                    url = url + '?count=' + count;
                } else if(item[0] != 'page' && item[0] != '?page'){
                    url = url + value;
                }
            })
        }
        window.location.href = url;
    })
    // Изменение типа поля
    if($('#billing_agreement_agree').length != 0) {
        $('#billing_agreement_agree').attr('type', 'checkbox');
    }
    function billingAgreementChange() {
        if($('#billing_agreement_agree').prop('checked')) {
            $('#billing_agreement_agree').parent().find('label').addClass('active');
        } else {
            $('#billing_agreement_agree').parent().find('label').removeClass('active');
        }
    }
    billingAgreementChange();
    $('#billing_agreement_agree').on('change', function(){
        billingAgreementChange();
    })
    // Изменение активного элемента способа оплаты
    function setPayment() {
        $('#payment li').removeClass('active');
        $('#payment input:checked').parents('li').addClass('active');
    }
    $(document).on('change', '#payment input', function(){
        setPayment();
    })
    $(document).on('click', '#payment li', function(){
        $(this).find('input').prop('checked', 'checked');
        setPayment();
    })
    // Выбор доставки
    function setDelivery() {
        if($('input[name=ship_type]').length != 0) {
            $('.delivery-type').removeClass('active');
            $('.shipping-block').hide();
            var cur = $('input[name=ship_type]:checked').val();
            if(cur == 'delivery') {
                $('#ship-to-different-address-checkbox').prop('checked', 'checked');
            } else {
                $('#ship-to-different-address-checkbox').prop('checked', false);
            }
            $('#'+cur).show();
            $('input[name=ship_type]:checked').parents('.delivery-type').addClass('active');
            $('#billing_delivery option[value='+cur+']').prop('selected', 'selected');
            $.ajax({
                method: 'POST',
                url: myajax.url,
                async: false,
                dataType: 'json',
                data: {
                    action: 'set_delivery_cost',
                    nonce_code: myajax.nonce,
                    delivery: cur,
                },
            })
        }
    }
    setDelivery();
    $('input[name=ship_type]').on('change', function(){
        setDelivery();
        //window.location.href = window.location.href;
    })
    $('.delivery-type').on('click', function(){
        $(this).find('input').prop('checked', 'checked');
        setDelivery();
        //window.location.href = window.location.href;
    })
    function setDeliveryInfo() {
        if($('.cart-payment-info-delivery').length != 0) {
            $('.cart-payment-info-delivery .date').text($('input[name=shipping_date]').val());
            $('.cart-payment-info-delivery .time').text($('input[name=shipping_time]').val());
        }
    }
    setDeliveryInfo();
    // Вывод списка дат
    $(function(){
        if($('input[name=shipping_date]').length != 0) {
            $.ajax({
                method: 'POST',
                url: myajax.url,
                async: false,
                dataType: 'json',
                data: {
                    action: 'delivery_data',
                    nonce_code: myajax.nonce,
                },
                success: function (data) {
                    if(data) {
                        $('#shipping_date_field label').after('<select name="shipping_date_select"></select>');
                        var i = 0;
                        $.each(data, function(index, value) {
                            i++;
                            if(i == 1) {
                                $('#shipping_date_field select').append('<option selected="selected" value="' + value + '">' + value + '</option>');
                            } else {
                                $('#shipping_date_field select').append('<option value="' + value + '">' + value + '</option>');
                            }
                        })
                        setDeliveryDate();
                        $('select[name=shipping_date_select]').styler();
                    }
                },
            })
        }
    })
    function setDeliveryDate() {
        var value = $('select[name=shipping_date_select]').val();
        $('input[name=shipping_date]').val(value);
    }
    $(document).on('change', 'select[name=shipping_date_select]', function(){
        setDeliveryDate();
        setDeliveryInfo();
    })
    // Выбор времени
    $(function(){
        if($('input[name=shipping_time]').length != 0) {
            $.ajax({
                method: 'POST',
                url: myajax.url,
                async: false,
                dataType: 'json',
                data: {
                    action: 'delivery_time',
                    nonce_code: myajax.nonce,
                },
                success: function (data) {
                    if(data) {
                        $('#shipping_time_field label').after('<select name="shipping_time_select"></select>');
                        var i = 0;
                        $.each(data, function(index, value) {
                            i++;
                            if(i == 1) {
                                $('#shipping_time_field select').append('<option selected="selected" value="' + value + '">' + value + '</option>');
                            } else {
                                $('#shipping_time_field select').append('<option value="' + value + '">' + value + '</option>');
                            }
                        })
                        setDeliveryTime();
                        $('select[name=shipping_time_select]').styler();
                    }
                },
            })
        }
    })
    function setDeliveryTime() {
        var value = $('select[name=shipping_time_select]').val();
        $('input[name=shipping_time]').val(value);
    }
    $(document).on('change', 'select[name=shipping_time_select]', function(){
        setDeliveryTime();
        setDeliveryInfo();
    })
    // Выбор магазин
    function setShop(){
        if($('input[name=shipping_shop_title]').length != 0) {
            $('.shipping_shop-card label').removeClass('active');
            $('input[name=shipping_shop_title]:checked').parent().addClass('active');
            var value = $('input[name=shipping_shop_title]:checked').val();
            $('input[name=billing_shop]').val(value);
        }
    }
    setShop();
    $('input[name=shipping_shop_title]').on('change', function(){
        setShop();
    })
    // Кнопка оформить заказ
    $('.fake_btn').on('click', function(e){
        e.preventDefault();
        $('.woocommerce-NoticeGroup').remove();
        var flag = true;
        if($('input[name=ship_type]:checked').val() == 'delivery') {
            var error = [];
            if($('input[name=shipping_town]').val().length == 0) {
                error.push('<strong>Город для выставления счета</strong> является обязательным полем');
                flag = false;
            }
            if($('input[name=shipping_street]').val().length == 0) {
                error.push('<strong>Улица для выставления счета</strong> является обязательным полем');
                flag = false;
            }
            if($('input[name=shipping_house]').val().length == 0) {
                error.push('<strong>Дом для выставления счета</strong> является обязательным полем');
                flag = false;
            }
            if($('input[name=shipping_tel]').val().length == 0) {
                error.push('<strong>Телефон для выставления счета</strong> является обязательным полем');
                flag = false;
            }
            if(flag) {
                $('input[name=billing_shop]').val('');
                $('.order_btn').trigger('click');
            } else {
                $('.cart-items').before('<div class="woocommerce-NoticeGroup woocommerce-NoticeGroup-checkout"><ul class="woocommerce-error"></ul></ul></div>');
                $.each(error, function(index, value) {
                    $('.woocommerce-NoticeGroup ul').append('<li>'+value+'</li>');
                })
                $('html, body').animate({
                    scrollTop: $('.cart').offset().top
                }, 300)
            }
        } else {
            $('.order_btn').trigger('click');
        }
    })
})