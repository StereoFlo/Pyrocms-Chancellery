<h2 id="page_title" class="page-title"><?= lang('page:chancellery:ordered:title'); ?></h2>

<? foreach ($items as $item) { ?>
    <? if (!empty($ordered_items)) { ?>
        <? foreach ($ordered_items as $ordered_item) { ?>
            <? if ($item->id == $ordered_item->kanz_id) { ?>
                <? if ($ordered_item->kolvo != 0) { ?>
                    <p>
                    <div style="float: left; width: 40%"><?= $item->name; ?></div>
                    <div style="float: left; width: 15%"><?= $ordered_item->kolvo ?></div>
                    <div style="float: left; width: 15%"><?= $item->ed; ?></div>
                    <div style="float: left; width: 15%" id="quote_<?= $item->id; ?>"><?= $item->quote; ?></div>
                    <div style="float: left; width: 15%" id="price_<?= $item->id; ?>"><?= $item->price; ?></div>
                    </p>
                <? } else { ?>
                    <p>
                    <div style="float: left; width: 40%"><?= $item->name; ?></div>
                    <div style="float: left; width: 15%"><?= lang('page:chancellery:ordered:no_order'); ?></div>
                    <div style="float: left; width: 15%"><?= $item->ed; ?></div>
                    <div style="float: left; width: 15%" id="quote_<?= $item->id; ?>"><?= $item->quote; ?></div>
                    <div style="float: left; width: 15%" id="price_<?= $item->id; ?>"><?= $item->price; ?></div>
                    </p>
                <? } ?>
            <? } ?>
        <? } ?>
    <? } else { ?>
        <p>
        <p>Вы не сделали заказ в этом месяце</p>
        </p>
    <? } ?>
<? } ?>