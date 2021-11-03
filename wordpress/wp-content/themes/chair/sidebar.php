<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Chair
 */
?>

<aside class="catalog-sidebar">
    <div class="catalog-sidebar-block catalog-sidebar-slider">
        <div class="catalog-sidebar-header">
            Цена, ₽
        </div>
        <div class="catalog-sidebar-body">
            <p>
                        <span>
                            <input type="number" name="min_price" value="2000">
                        </span>
                <span>
                            <input type="number" name="max_price" value="1000000">
                        </span>
            </p>
            <div class="catalog-slider" data-max="1000000" data-min="2000" id="price-slider"></div>
        </div>
    </div>
    <div class="catalog-sidebar-block catalog-sidebar-slider">
        <div class="catalog-sidebar-header">
            Мак. нагрузка (кг)
        </div>
        <div class="catalog-sidebar-body">
            <p>
                        <span>
                            <input type="number" name="min_weight" value="10">
                        </span>
                <span>
                            <input type="number" name="max_weight" value="200">
                        </span>
            </p>
            <div class="catalog-slider" data-max="200" data-min="10" id="weight-slider"></div>
        </div>
    </div>
    <div class="catalog-sidebar-block catalog-sidebar-checkbox">
        <div class="catalog-sidebar-header">
            <span>Производители</span>
        </div>
        <div class="catalog-sidebar-body">
            <div class="catalog-sidebar-row">
                <label for="first">Gym80</label>
                <input type="checkbox" id="first">
            </div>
            <div class="catalog-sidebar-row">
                <label for="second">Gym80</label>
                <input type="checkbox" id="second">
            </div>
            <div class="catalog-sidebar-row">
                <label for="third">Gym80</label>
                <input type="checkbox" id="third">
            </div>
            <div class="catalog-sidebar-row">
                <label for="five">Gym80</label>
                <input type="checkbox" id="five">
            </div>
            <div class="catalog-sidebar-row">
                <label for="six">Gym80</label>
                <input type="checkbox" id="six">
            </div>
            <div class="catalog-sidebar-row">
                <label for="seven">Gym80</label>
                <input type="checkbox" id="seven">
            </div>
            <div class="catalog-sidebar-row">
                <label for="eight">Gym80</label>
                <input type="checkbox" id="eight">
            </div>
            <div class="catalog-sidebar-row">
                <label for="nine">Gym80</label>
                <input type="checkbox" id="nine">
            </div>
            <div class="catalog-sidebar-row">
                <label for="ten">Gym80</label>
                <input type="checkbox" id="ten">
            </div>
            <div class="catalog-sidebar-row">
                <label for="eleven">Gym80</label>
                <input type="checkbox" id="eleven">
            </div>
            <div class="catalog-sidebar-row">
                <label for="twelve">Gym80</label>
                <input type="checkbox" id="twelve">
            </div>
            <div class="catalog-sidebar-row">
                <label for="thirteen">Gym80</label>
                <input type="checkbox" id="thirteen">
            </div>
            <div class="catalog-sidebar-row">
                <label for="fourteen">Gym80</label>
                <input type="checkbox" id="fourteen">
            </div>
        </div>
    </div>
    <div class="catalog-sidebar-block catalog-sidebar-checkbox">
        <div class="catalog-sidebar-header">
            <span>Подлокотник</span>
        </div>
        <div class="catalog-sidebar-body">
            <div class="catalog-sidebar-row">
                <label for="have">Есть</label>
                <input type="checkbox" id="have">
            </div>
            <div class="catalog-sidebar-row">
                <label for="not">Нет</label>
                <input type="checkbox" id="not">
            </div>
            <div class="catalog-sidebar-row">
                <label for="optial">Опционально</label>
                <input type="checkbox" id="optial">
            </div>
        </div>
    </div>
    <div class="catalog-sidebar-block catalog-sidebar-checkbox">
        <div class="catalog-sidebar-header">
            <span>Наличие газлифта</span>
        </div>
        <div class="catalog-sidebar-body">
            <div class="catalog-sidebar-row">
                <label for="have1">Есть</label>
                <input type="checkbox" id="have1">
            </div>
        </div>
    </div>
    <div class="catalog-sidebar-block catalog-sidebar-checkbox">
        <div class="catalog-sidebar-header">
            <span>Акция, наличие</span>
        </div>
        <div class="catalog-sidebar-body">
            <div class="catalog-sidebar-row">
                <label for="have1">Есть</label>
                <input type="checkbox" id="have1">
            </div>
        </div>
    </div>
    <div class="catalog-sidebar-block catalog-sidebar-btn">
        <div class="catalog-sidebar-body">
            <a href="#" class="btn">Очистить</a>
        </div>
    </div>
</aside>