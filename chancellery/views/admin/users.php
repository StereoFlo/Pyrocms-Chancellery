<section class="title">
    <h4><?= lang('page:admin_users:users:title'); ?></h4>
</section>
<section class="item">
    <div>
        <form action="/admin/chancellery/users/index" method="get" accept-charset="utf-8">
            <input style="width: 80%" type="text" name="q" value="" placeholder="Enter a word"/>
            <button style="width: 18%" type="submit" class="btn blue"><span>Search</span></button>
        </form>
    </div>
    <? if (!empty($users)) { ?>
        <div id="filter-stage">
            <table border="0" class="table-list">
                <thead>
                <tr>
                    <th><?= lang('page:admin_users:users:table:login'); ?></th>
                    <th><?= lang('page:admin_users:users:table:name'); ?></th>
                    <th><?= lang('page:admin_users:users:table:code'); ?></th>
                    <th><?= lang('page:admin_users:users:table:manage'); ?></th>
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
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="collapse"><?= $user->username; ?></td>
                        <td class="collapse"><?= user_displayname($user->id, $linked = false); ?></td>
                        <td class="collapse">
                            <? foreach ($codes as $code) { ?>
                                <? if ($code->user == $user->id) { ?>
                                    <?= $code->code; ?>
                                <? } ?>
                            <? } ?>
                        </td>
                        <td class="actions">
                            <?php echo anchor('admin/chancellery/users/edit/' . $user->id, lang('global:edit'),
                                ['class' => 'button edit']); ?>
                            <?php echo anchor('admin/chancellery/users/delete/' . $user->id, lang('global:delete'),
                                ['class' => 'button delete']); ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <? } else { ?>
        <div class="no_data"><?= lang('page:admin_users:users:messages:no_users'); ?></div>
    <? } ?>

</section>