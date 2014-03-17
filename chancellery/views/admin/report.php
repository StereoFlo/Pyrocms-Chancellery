<section class="title">
	<h4><?= lang('page:admin_report:report:title');?></h4>
</section>

<section class="item">
<table>
    <tr>
        <td>
        <?php echo form_open('admin/chancellery/report/excel');?>
        <table style="width: 100%; border: 1px solid #eee;">
                <tr>
			<td><?= lang('page:admin_report:report:messages:select_for_user');?></td>
                        <td><?= form_dropdown('user', $users); ?></td>
                </tr>
                <tr>
                        <td colspan="2">
                                <button class="btn blue" value="save" name="btnAction" type="submit"><span><?= lang('buttons:save'); ?></span></button>
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
			<?= form_open('admin/chancellery/report/excel');?>
                        <td colspan="2">
				<p>
					<?= form_dropdown('start_day', $start_day); ?>
					<?= form_dropdown('start_year', $end_day); ?>
				</p>
				<p>
					<?= form_dropdown('end_day', $start_year); ?>
					<?= form_dropdown('end_year', $end_year); ?>
				</p>
				<button class="btn blue" value="save" name="btnAction" type="submit"><span><?= lang('page:admin_report:report:messages:report_period');?></span></button>
                        </td>
			<?= form_close(); ?>
                </tr>
                <tr>
			<?= form_open('admin/chancellery/report/excel');?>
                        <td colspan="2">
                                <input type='hidden' name="user" value="999999" />
                                <button class="btn blue" value="save" name="btnAction" type="submit"><span><?= lang('page:admin_report:report:messages:close_period');?></span></button>
                        </td>
			<?= form_close(); ?>
                </tr>
        </table>
        </td>
    </tr>
</table>
</section>