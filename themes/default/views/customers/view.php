<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header"> 
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-2x">&times;</i>
            </button>
			<button type="button" class="btn btn-primary btn-xs no-print pull-right " onclick="window.print()">
				<i class="fa fa-print"></i>&nbsp;<?= lang("print"); ?>
			</button>
            <h4 class="modal-title" id="myModalLabel"><?= $customer->company && $customer->company != '-' ? $customer->company : $customer->name; ?></h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" style="margin-bottom:0;">
                    <tbody>
						<tr>
							<td><strong><?= lang("customer_group"); ?></strong></td>
							<td><?= $customer->customer_group_name; ?></strong></td>
						</tr>
						<tr>
							<td><strong><?= lang("date"); ?></strong></td>
							<td><?= $customer->start_date; ?></strong></td>
						</tr>
						<tr>
							<td><strong><?= lang("name"); ?></strong></td>
							<td><?= $customer->name; ?></strong></td>
						</tr>
						<tr>
							<td><strong><?= lang("gender"); ?></strong></td>
							<td><?= lang($customer->gender); ?></strong></td>
						</tr>
						<tr>
							<td><strong><?= lang("age"); ?></strong></td>
							<td><?= lang($customer->age); ?></strong></td>
						</tr>
						<tr>
							<td><strong><?= lang("phone"); ?></strong></td>
							<td><?= $customer->phone; ?></strong></td>
						</tr>
						<tr>
							<td><strong><?= lang("address"); ?></strong></td>
							<td><?= $customer->address; ?></strong>
							<span style="float:right;">
							<input type="radio" value="<?= $customer->address; ?>" class="checkbox" name="address" id="addr" >
							</span>
							</td>
						</tr>
						<tr>
							<td><strong><?= lang("group_area"); ?></strong></td>
							<td><?= $customer->areas_group; ?></strong></td>
						</tr>
						<tr>
							<td><strong><?= lang("award_points"); ?></strong></td>
							<td><?= $customer->award_points; ?></strong></td>
						</tr>
						<tr>
							<td><strong><?= lang("note"); ?></strong></td>
							<td><?= $customer->invoice_footer; ?></strong></td>
						</tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer no-print">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal"><?= lang('close'); ?></button>
                <?php if ($Owner || $Admin || $GP['reports-customers']) { ?>
                    <a href="<?=site_url('reports/customer_sale_report/'.$customer->id);?>" target="_blank" class="btn btn-primary"><?= lang('customers_report'); ?></a>
                <?php } ?>
                <?php if ($Owner || $Admin || $GP['customers-edit']) { ?>
                    <a href="<?=site_url('customers/edit/'.$customer->id);?>" data-toggle="modal" data-target="#myModal2" class="btn btn-primary"><?= lang('edit_customer'); ?></a>
                <?php } ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	
	var not2 = localStorage.getItem('nott');
	var addr = $("#addr").val();
	var addr1 = $("#addr1").val();
	var addr2 = $("#addr2").val();
	var addr3 = $("#addr3").val();
	var addr4 = $("#addr4").val();
	var addr5 = $("#addr5").val();
	if(not2 == addr){
		$("#addr").attr('checked', 'checked');
	}else if(not2 == addr1){
		$("#addr1").attr('checked', 'checked');
	}else if(not2 == addr2){
		$("#addr2").attr('checked', 'checked');
	}else if(not2 == addr3){
		$("#addr3").attr('checked', 'checked');
	}else if(not2 == addr4){
		$("#addr4").attr('checked', 'checked');
	}else{
		$("#addr5").attr('checked', 'checked');
	}
});
</script>
