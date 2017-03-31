<section class="title">
    <h4><?= lang('page:admin_report:report:title'); ?></h4>
</section>

<section class="item">
    <table>
        <tr>
            <td style="vertical-align: top;">
                <?php echo form_open('admin/chancellery/report/excel/user'); ?>
                <table style="width: 100%; border: 1px solid #eee;">
                    <tr>
                        <td><?= lang('page:admin_report:report:messages:select_for_user'); ?></td>
                        <td><?= form_dropdown('user', $users); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button class="btn blue" value="save" name="btnAction" type="submit">
                                <span><?= lang('buttons:save'); ?></span></button>
                            &nbsp;&nbsp;
                            <a class="btn-more" href="/admin/chancellery/report/"><?= lang('buttons:cancel'); ?></a>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <?= form_close(); ?>

                <table style="width: 100%; border: 1px solid #eee;">
                    <tr>
                        <?= form_open('admin/chancellery/report/excel/period'); ?>
                        <td colspan="2">
                            <p>
                                <?= form_dropdown('start_day', $start_day, 01); ?>
                                <?= form_dropdown('end_day', $end_day, 31); ?>
                            </p>
                            <p>
                                <?= form_dropdown('start_month', $start_month, date('m', strtotime('-1 month'))); ?>
                                <?= form_dropdown('end_month', $end_month, date('m')); ?>
                            </p>
                            <p>
                                <?= form_dropdown('start_year', $start_year, date('Y')); ?>
                                <?= form_dropdown('end_year', $end_year, date('Y')); ?>
                            </p>
                            <button class="btn blue" value="save" name="btnAction" type="submit">
                                <span><?= lang('page:admin_report:report:messages:report_period'); ?></span></button>
                        </td>
                        <?= form_close(); ?>
                    </tr>
                    <tr>
                        <?= form_open('admin/chancellery/report/excel/all'); ?>
                        <td colspan="2">
                            <button class="btn blue" value="save" name="btnAction" type="submit">
                                <span><?= lang('page:admin_report:report:messages:close_period'); ?></span></button>
                        </td>
                        <?= form_close(); ?>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</section>