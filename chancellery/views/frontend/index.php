<style type="text/css">
.focus {
	background-color : #ff0000; 
}
</style>
<script>
$(document).ready(function(){
	$("form").keypress(function(e) {
	  if (e.which == 13) {
	    return false;
	  }
	});
});
    
function check(input, limit) {
	var IValue = $('#' + input).val();
	var ostatok = 0;
	var lim = <?= $limit; ?>;
	$('#' + input).keyup(function(e){
		if (IValue > limit | e.keyCode == 8) {
			$('#' + input).addClass("focus");
            $("#btnSubmit").attr("disabled", "disabled");
            $("#btnSubmit2").attr("disabled", "disabled");
		}
		else
		{
            $('#' + input).removeClass("focus");
            $("#btnSubmit").removeAttr("disabled");
            $("#btnSubmit2").removeAttr("disabled");
		}
	});
} 
</script>
<h2 id="page_title" class="page-title"><?= lang('page:chancellery:index:title');?></h2>
<p><?= lang('page:chancellery:index:message');?>. Ваш лимит на заказ канцелярии: <b><?= $limit; ?></b></p>
<div style="display: inline" id="sum"></div>
	<? if(validation_errors()) { ?>
	<div class="error-box">
		<?= validation_errors();?>
	</div>
	<? } ?>
        <?= form_open('chancellery/order');?>
        <div id="section" style="width: 100%;">
        	<div class="btnSave"><?= form_submit(array('value'=> lang('buttons:save'), 'id'=>'btnSubmit')); ?></div>
            <div style="float: left; width: 40%; font-weight: bold"><?= lang('page:chancellery:index:table:name');?></div>
            <div style="float: left; width: 15%; font-weight: bold"><?= lang('page:chancellery:index:table:count');?></div>
            <div style="float: left; width: 15%; font-weight: bold"><?= lang('page:chancellery:index:table:ed');?></div>
            <div style="float: left; width: 15%; font-weight: bold"><?= lang('page:chancellery:index:table:quote');?></div>
            <div style="float: left; width: 15%; font-weight: bold"><?= lang('page:chancellery:index:table:price');?></div>
            
	    <? foreach ($items as $item) { ?>
	    
		<? if (!empty($ordered_items)) { ?>
		<? foreach ($ordered_items as $ordered_item) { ?>
		<? if ($item->id == $ordered_item->kanz_id) { ?>
		<p>
			<div style="float: left; width: 40%"><?= $item->name; ?></div>
			<div style="float: left; width: 15%"><?= form_input(array('onkeyup'=>"check('input_".$item->id."', ".$item->quote.");", 'id' => "input_".$item->id, 'name' => $item->id, 'size'=>'5', 'value' => $ordered_item->kolvo)); ?></div>
			<div style="float: left; width: 15%"><?= $item->ed; ?></div>
			<div style="float: left; width: 15%" id="quote_<?= $item->id; ?>"><?= $item->quote; ?></div>
			<div style="float: left; width: 15%" id="price_<?= $item->id; ?>"><?= $item->price; ?></div>
		</p>
		<? } ?>
		<? } ?>
		<? } else { ?>
		<p>
			<div style="float: left; width: 40%"><?= $item->name; ?></div>
			<div style="float: left; width: 15%"><?= form_input(array('onkeyup'=>"check('input_".$item->id."', ".$item->quote.");", 'id' => "input_".$item->id, 'name' => $item->id, 'size'=>'5', 'value' => '0')); ?></div>
			<div style="float: left; width: 15%"><?= $item->ed; ?></div>
			<div style="float: left; width: 15%" id="quote_<?= $item->id; ?>"><?= $item->quote; ?></div>
			<div style="float: left; width: 15%" id="price_<?= $item->id; ?>"><?= $item->price; ?></div>
		</p>
		<? } ?>
	    
	    <? } ?>
		<div class="btnSave"><?= form_submit(array('value'=> lang('buttons:save'), 'id'=>'btnSubmit2')); ?></div>
		</div>
        <?= form_close(); ?>
        
<script>
    $(document).ready(function(){
        $("[id^=input_]").each(function() {
            $(this).keyup(function(){
                calculateSum();
            });
        });
 
    });
 
    function calculateSum() {
 
        var sum = 0;
        $("[id^=input_]").each(function() {
 			var num = $(this).attr('id').match(/\d+/);
 			var price = $('#price_' + num).text();
            if(!isNaN(this.value) && this.value.length!=0) {
                sum += parseFloat(this.value * price);
            }
 
        });
        var limit = <?= $limit; ?>;
        if (limit < sum) {
        	alert("Вы превысили лимит заказа!\nВаш лимит: " + limit + "\nВы заказали на " + sum);
			$("#sum").html("<div style='color: red; display: inline'>"+ sum +"</div>");
		} else {
			$("#sum").html("<div style='color: green; display: inline'>Вы заказали насумму: "+ sum +"</div>");
			
		}
    }
</script>