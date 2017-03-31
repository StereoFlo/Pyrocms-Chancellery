<style type="text/css">
    label {
        width: 23% !important;
    }
</style>
<section class="title">
    <h4><?= lang('page:admin:title:main'); ?></h4>
</section>

<section class="item">
    <?= form_open('admin/chancellery/index?action=save', 'class="crud"'); ?>
    <table style="width: 450px; border: 1px solid #eee;">
        <tr>
            <td><?= lang('page:admin:label:default_contractor'); ?></td>
            <? $data = ['' => 'Select one'];
            foreach ($contractors as $row) {
                $data[$row->id] = $row->name;
            } ?>
            <td><?= form_dropdown('default_contractor', $data,
                    (isset($chancellery[0]->default_contractor) ? $chancellery[0]->default_contractor : '')); ?></td>
        </tr>
        <tr>
            <td>Do you want to use a sap codes?</td>
            <td><?= form_dropdown('sap_codes', ['0' => 'No', '1' => 'Yes'],
                    (isset($chancellery[0]->sap_codes) ? $chancellery[0]->sap_codes : '0')); ?></td>
        </tr>
        <tr>
            <td>Email for the send letters</td>
            <td><?= form_input('email', (isset($chancellery[0]->email) ? $chancellery[0]->email : '')); ?></td>
        </tr>
        <tr>
            <td colspan="2">
                <button class="btn blue" value="save" name="btnAction" type="submit">
                    <span><?= lang('buttons:save'); ?></span></button>
                &nbsp;&nbsp;
                <a class="btn-more" href="/admin/chancellery"><?= lang('buttons:cancel'); ?></a>
            </td>
        </tr>
    </table>

    <?php
    if (isset($chancellery[0]->id)) {
        ?>
        <input type="hidden" name="id" value="<?= $chancellery[0]->id; ?>">
    <?php } ?>

    <?php echo form_close(); ?>
</section>