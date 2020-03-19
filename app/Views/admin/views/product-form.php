<header class="card-header" >
    <div class="title-header float-left display--inline-block">
        <span>New Product</span>
    </div>
    <div class="text-right float-right display--inline-block">
        <a href="?scope=page&action=showCategories"><button class="btn btn--default " type="button"><i class="fas fa-arrow-left"></i> Back</button></a>
        <button class="btn btn--dark" type="button">Add Attribute</button>
        <button class="btn btn--red-2" id="btn-form--submit"  type="submit">Save</button>
    </div>
</header>
<div class="page-wrapper" style="padding: 90px 0 30px 0">
    <div class="wrapper wrapper--w900">
        <div class="notify">
        </div>
        <form method="POST" action="?scope=product&action=add" enctype="multipart/form-data" name="form-product">
            <div class="card card-6">
                <div class="card-body">
                    <div class="form-row">
                        <div class="name">SKU</div>
                        <div class="required text--color-red">*</div>
                        <div class="value">
                            <div class="input-group">
                                <input class="input--style-6" type="text" name="sku">
                            </div>
                        </div>
                    </div>
                    <?php foreach ($elements as $element): ?>
                    <?php $name_code = $element['attribute_code'] ?>
                    <div class="form-row">
                        <div class="name"><?=@$element['frontend_label']?></div>
                        <div class="required text--color-red"></div>
                        <div class="value">
                        <?php switch ($element['frontend_input']):
                            case "text": ?>
                                <div class="input-group">
                                    <input class="input--style-6" type="text" name="<?=$name_code?>">
                                </div>
                                <?php break; ?>
                            <?php case "multiselect": ?>
                                <div class="select-wrapper">
                                    <select multiple name="<?=$name_code?>" id="select-multiple-<?=$element['attribute_id']?>">
                                        <?php foreach ($element['value'] as $value): ?>
                                            <option value="<?=$value?>"><?=$value?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <?php break; ?>
                            <?php case "price": ?>
                                <div class="input-group">
                                    <input class="input--style-6" type="number" min="0" name="<?=$name_code?>">
                                </div>
                                <?php break; ?>
                            <?php case "multilevel": ?>
                                <div class="input-group select-pure__tree">
                                    <button class="select-pure__select text-small" type="button" for="catalog-categories--1"></button>
                                    <div class="tree" id="catalog-categories--1">
                                        <ul><?php foreach ($element['value'] as $item): ?>
                                            <li>
                                                <label><input type="checkbox" name="<?=@$name_code?>[]" value="<?=$item['item']['entity_id']?>"><?=@$item['item']['name']?></label>
                                                <?php if(isset($item['subItem']) && count($item['subItem'])): ?>
                                                    <ul>
                                                        <?php foreach ($item['subItem'] as $subItem): ?>
                                                            <li>
                                                                <label><input type="checkbox" name="categories_id[]" value="<?=$subItem['item']['entity_id']?>"><?=@$subItem['item']['name']?></label>
                                                                <?php if(isset($subItem['subItem']) && count($subItem['subItem'])): ?>
                                                                    <ul>
                                                                        <?php foreach ($subItem['subItem'] as $sub2Item): ?>
                                                                            <li>
                                                                                <label><input type="checkbox" name="categories_id[]" value="<?=$sub2Item['item']['entity_id']?>"><?=@$sub2Item['item']['name']?></label>
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                <?php endif; ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?></ul>
                                    </div>
                                </div>
                                <?php break; ?>
                            <?php case "textarea": ?>
                                <div class="input-group">
                                    <textarea class="textarea input--style-6" name="<?=$name_code?>"></textarea>
                                </div>
                                <?php break; ?>
                            <?php case "image": ?>
                                <div class="input-group js-input-file">
                                    <input class="input-file" multiple type="file" name="<?=$name_code?>[]" id="file-<?=@$element['attribute_id']?>">
                                    <label class="label--file" for="file-<?=@$element['attribute_id']?>">Choose file</label>
                                    <span class="input-file__info">No file chosen</span>
                                </div>
                                <div class="label--desc">Upload image product</div>
                                <?php break; ?>
                        <?php endswitch; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    var validation = <?=@$validation?>
</script>