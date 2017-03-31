<section class="title">
    <h4><?= lang('page:admin_items:items:title'); ?></h4>
</section>
<section class="item">
    <div>
        <form action="/admin/chancellery/items/index" method="get" accept-charset="utf-8">
            <input style="width: 80%" type="text" name="q" value="" placeholder="Enter a word"/>
            <button style="width: 18%" type="submit" class="btn blue"><span>Search</span></button>
        </form>
    </div>
    <? if (!empty($items)) { ?>
        <div id="filter-stage">
            <table border="0" class="table-list">
                <thead>
                <tr>
                    <th><?= lang('page:admin_items:items:table:name'); ?></th>
                    <th><?= lang('page:admin_items:items:table:quote'); ?></th>
                    <th><?= lang('page:admin_items:items:table:price'); ?></th>
                    <th><?= lang('page:admin_items:items:table:ed'); ?></th>
                    <th><?= lang('page:admin_items:items:table:contractor'); ?></th>
                    <th><?= lang('page:admin_items:items:table:period'); ?></th>
                    <th><?= lang('page:admin_items:items:table:kod1'); ?></th>
                    <th><?= lang('page:admin_items:items:table:kod2'); ?></th>
                    <th><?= lang('page:admin_items:items:table:manage'); ?></th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td colspan="8">
                        <div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
                    </td>
                </tr>
                </tfoot>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td class="collapse"><?= $item->name; ?></td>
                        <td class="collapse"><?= $item->quote; ?></td>
                        <td class="collapse"><?= $item->price; ?></td>
                        <td class="collapse"><?= $item->ed; ?></td>
                        <? foreach ($contractors as $contractor) { ?>
                            <? if ($contractor->id == $item->contractor) { ?>
                                <td class="collapse"><a
                                            href="admin/chancellery/contractors/edit/<?= $contractor->id; ?>"><?= $contractor->name; ?></a>
                                </td>
                            <? } ?>
                        <? } ?>
                        <td class="collapse"><?= $item->period; ?></td>
                        <td class="collapse"><?= $item->kod1; ?></td>
                        <td class="collapse"><?= $item->kod2; ?></td>
                        <td class="actions">
                            <?php echo anchor('admin/chancellery/items/edit/' . $item->id, lang('global:edit'),
                                ['class' => 'button edit']); ?>
                            <?php echo anchor('admin/chancellery/items/delete/' . $item->id, lang('global:delete'),
                                ['class' => 'button delete']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <? } else { ?>
        <div class="no_data"><?= lang('page:admin_items:items:messages:no_items'); ?></div>
    <? } ?>

</section>