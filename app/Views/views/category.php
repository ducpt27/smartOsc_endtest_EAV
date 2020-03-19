<?php ob_start() ?>
<style>
    #categories-list .active > a {
        color: coral;
    }
    #categories-list .active > a {
        color: coral;
    }
    .notify {
        padding-top: 50px;
        font-weight: bold;
        font-size: 2em;
        text-align: center;
        margin: 0 auto;
    }
</style>
<?php $css = ob_get_clean() ?>
<!--================Home Banner Area =================-->
<section class="banner_area">
    <div class="banner_inner d-flex align-items-center">
        <div class="container">
            <div class="banner_content text-center">
                <h2>Shop Category Page</h2>
                <div class="page_link">
                    <a href="?scope=page">Home</a>
                    <a href="?scope=page&action=showCategories">Category</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Home Banner Area =================-->

<!--================Category Product Area =================-->
<section class="cat_product_area p_120">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <div class="product_top_bar">
                    <div class="right_page ml-auto">
                        <nav class="cat_page" aria-label="Page navigation example">
                            <ul class="pagination">
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="latest_product_inner row">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="left_sidebar_area">
                    <aside class="left_widgets cat_widgets">
                        <div class="l_w_title">
                            <h3>Browse Categories</h3>
                        </div>
                        <div class="widgets_inner filter">
                            <ul class="list" id="categories-list">
                                <?php foreach ($categories as $item): ?>
                                <li>
                                    <a href="#" name="_6" value="<?=@$item['item']['entity_id']?>"><?=@$item['item']['name']?></a>
                                    <?php if (isset($item['subItem']) && count($item['subItem'])): ?>
                                    <ul class="list">
                                    <?php foreach ($item['subItem'] as $subItem): ?>
                                        <li>
                                            <a href="#" name="_6" value="<?=@$subItem['item']['entity_id']?>"><?=@$subItem['item']['name']?></a>
                                        </li>
                                    <?php endforeach; ?>
                                    </ul>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </aside>
                    <aside class="left_widgets p_filter_widgets">
                        <div class="l_w_title">
                            <h3>Product Filters</h3>
                        </div>
                        <?php foreach ($filter as $item): ?>
                        <div class="widgets_inner filter">
                            <h4><?=@$item['frontend_label']?></h4>
                            <ul class="list">
                                <?php foreach ($item['value'] as $value): ?>
                                <li><a href="#" name="_<?=@$item['attribute_id']?>" value="<?=@$value?>" ><?=@$value?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <?php endforeach; ?>
                    </aside>
                </div>
            </div>
        </div>
    </div>
</section>
<form action="?scope=page&action=getProduct" method="post" name="form-filter" style="display: none; opacity: 0; visibility: hidden">
</form>
<!--================End Category Product Area =================-->
<?php ob_start() ?>
<script src="<?=@$this->asset('js/category.js')?>"></script>
<?php $js = ob_get_clean() ?>