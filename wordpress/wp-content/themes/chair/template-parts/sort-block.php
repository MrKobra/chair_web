<div class="catalog-sort">
    <div class="mobile-filter-btn btn">
        <span>Фильтр</span>
    </div>
    <select name="catalog-sort" id="catalog-sort">
        <option <?php if(!isset($_GET['sort'])) { echo 'selected="selected"'; } ?> disabled >Сортировать</option>
        <option <?php if(isset($_GET['sort'])) { if($_GET['sort'] == 'DESC') { echo 'selected="selected"'; } } ?> value="DESC">по убыванию цены</option>
        <option <?php if(isset($_GET['sort'])) { if($_GET['sort'] == 'ASC') { echo 'selected="selected"'; } } ?> value="ASC">по возрастанию цены</option>
        <option <?php if(isset($_GET['sort'])) { if($_GET['sort'] == 'popular') { echo 'selected="selected"'; } } ?> value="popular">по популярности</option>
    </select>
</div>