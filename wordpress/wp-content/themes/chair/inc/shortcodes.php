<?php

function form_agreement_func(){
    return '<span class="warning">Нажимая кнопку вы соглашаетесь с политикой конфиденциальности</span>';
}

wpcf7_add_form_tag('form_agreement', 'form_agreement_func');