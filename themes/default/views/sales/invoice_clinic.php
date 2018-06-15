<!DOCTYPE html>
<html>
	<head>
		<title>Invoice</title>
		<meta charset="utf-8">
		<link href="<?php echo $assets ?>styles/helpers/bootstrap.min-inv.css" rel="stylesheet">
		<script type="text/javascript" src="<?= $assets ?>js/jquery-2.0.3.min.js"></script>
		<style>
			.hidden{
				display:none;
			}
			@media print{
				.bottom-print{
					display:none;
				}
				#buttons{
					display:none;
				}
				.header_address{
					margin-left: -195px !important;
				}
				.header_company{
					margin-left : -25px !important;
				}
				.header_company_kh{
					margin-left : -20px !important;
				}
				.header_center{
					margin-left : 15px !important;
				}
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<?php if ($logo) { ?>
					 <div class="col-xs-3 text-left" style="margin-top:20px !important;floatleft;">
						<img style="width:130px;margin-left:-10px !important;" src="<?= base_url() . 'assets/uploads/logos/' . $biller->logo; ?>" alt="">
					</div>
					<div class="col-xs-9 text-center pull-left" style="text-align:left !important;">
						<?php if($biller->company_kh){ ?>
							<h2 class="header_company_kh" style="font-family : Khmer OS Muol !important; margin-left:100px; "><strong style="text-transform: uppercase;"><?= $biller->company_kh ?></strong></h2>
						<?php } ?>
						<h4 class="header_company" style="font-family : Khmer OS Muol !important; margin-left:100px;"><strong style="text-transform: uppercase;"><?= $biller->company ?></strong></h4>
						<p class="header_address" style="font-size:12px !important; text-align:center !important; margin-left: -260px;">
							<?php 
								if($biller->address){echo $biller->address;}
								echo '<br>';
								if($biller->phone){echo lang("tel") . " : ".$biller->phone;}
								echo '<br>';
								if($biller->email){echo "&nbsp &nbsp".lang("email")." : ". $biller->email;}
							?>
						</p>
					</div>
				<?php } ?>
			</div>
            <div class="clearfix"></div>
			<div class="row">
				<center>
					<h4 class="header_center" style="font-family : Khmer OS Muol !important;margin-left: 10px;">របៀបប្រើប្រាស់ថ្នំា</h4>
				</center>
			</div>
			<div class="clearfix"></div>
			<br/>
		<!--	<div class="row" style="font-size:15px !important;">
				<div class="col-xs-6">
					<div style="font-size: 15px;">
						<span><b>ឈ្មោះ :</b></span><span> <?=$customer->name;?></span>
					</div>
				</div>
				<div class="col-xs-6">
					<div style="font-size: 15px;text-align:center;">
						<div>
							<span><b>ភេទ :</b></span><span> <?=$customer->gender;?></span>
						</div>
					</div>
				</div>
			</div>
			<div class="row" style="font-size:15px !important;">
				<div class="col-xs-6">
					<div style="font-size: 15px; text-align:right;">
						<div>
							<span style="text-align:right;"><b>អាយុ :</b></span><span> <?=$customer->age;?></span>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div style="font-size: 15px;text-align:center;">
						<div>
							<span style="text-align:center;"><b>Tel :</b></span><span> <?=$customer->phone;?></span>
						</div>
					</div>
				</div>
			</div> -->
			<div class="row">
				<div class="col-sm-5 col-xs-5" style="padding-left:20px !important;">
					<table style="font-size:​15px; line-height:25px !important;">
						<tr>
							<td>ឈ្មោះ</td>
							<td> : <?= $customer->name; ?></td>
						</tr>
						<tr>
							<td>ភេទ</td>
							<td> : <?= $customer->gender; ?></td>
						</tr>
						<tr>
							<td>អាយុ</td>
							<td> : <?= $customer->age; ?></td>
						</tr>
						<tr>
							<td>ទូរសព្ទ</td>
							<td> : <?= $customer->phone; ?></td>
						</tr>
					</table>
				</div>
				<div class="col-sm-2 col-xs-2">
					
				</div>
				<div class="col-sm-5 col-xs-5" style="margin-right:0px !important">
					<table style="font-size: 15px; margin-left:60px !important; line-height:25px !important;">
						<tr>
							<td>វិក័យបត្រ</td>
							<td> : <?= $inv->reference_no; ?></td>
						</tr>
						<tr>
							<td>ថ្ងៃខែឆ្នំា</td>
							<td> : <?= $this->erp->hrld($inv->date); ?></td>
						</tr>
						<tr>
							<td>អ្នកលក់</td>
							<td> : <?= $saleman->username; ?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
		<div class="container" style="padding-top:10px !important;">
			<?php
				
				$style = 0;
				foreach($product_notes as $product_note){
					$this->db->select('erp_sale_items.*, erp_products.name_kh as product_kh, erp_products.details as product_detail');
					$this->db->from('erp_sale_items');
					$this->db->join('erp_products', 'erp_products.id = erp_sale_items.product_id', 'left');
					$this->db->where(array('erp_sale_items.sale_id' => $inv->id, 'erp_sale_items.product_noted' => $product_note->note));
					$datas = $this->db->get()->result(); 
			?>
				<div class="container" style="width:50%; float:left;padding:5px !important;">
					<table style="width: 100%;">
						<tbody style="border : 1px solid black !important; text-align:left !important;">
							<?php if($datas > 0){ ?>
								<tr style="font-family : Khmer OS Muol !important;font-size:13px !important;line-height:2;">
									<td colspan="2" class="text-center"><?= $product_note->note; ?></td>
								</tr>
							<?php } ?>	
							
						<?php	
							$i = 1;
							foreach($datas as $data){ ?>
								<tr style="font-size:12px !important; line-height:2;">
									<td width="5%" style="text-align:center; vertical-align:top; font-weight:bold;"><?= $i; ?></td>
									<td width="85%" style="padding-left:10px !important; vertical-align:top;"><?= $data->product_name .' ('. $data->product_kh .') '. strip_tags($data->product_detail); ?></td>
								</tr>
							<?php 
								$i++;
								}
							?>
						</tbody>
					</table>
				</div>
			<?php
				}
			?>
		</div>
		
		<div class="container" style="padding-top:30px;">
			<div class="container" style="width:50%; float:left;">
				&nbsp;
			</div>
			<div class="container" style="width:50%; float:left; padding-right:0px !important;">
				<div class="col-sm-3 col-xs-3">
					&nbsp;
				</div>
				
				<div class="col-sm-9 col-xs-9" style="padding-right:0px !important;">
					<table style="width: 100%;">
						<tbody style="border : 1px solid black !important;">							
							<?php
								foreach($total_items as $total_item){ 
							?>
								<tr style="font-size:12px !important; line-height:2;">
									<td width="95%" style="text-align:left; vertical-align:top; padding-left:10px;"><?= $total_item->product_name .' ('. $total_item->product_name_kh .')'; ?></td>
									<td width="5%" style="padding-left:10px !important; vertical-align:top; padding-right:10px;"><?= $this->erp->formatQuantity($total_item->qty); ?></td>
								</tr>
							<?php 
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>

<div id="buttons" style="position:absolute; bottom:0px; padding-left:220px; text-transform:uppercase;" class="no-print">
	<span class="no-print col-xs-2" style="width:200px;">
		<a href="<?=base_url()?>pos" class="btn btn-block btn-primary no-print" ><?= lang("back_to_pos"); ?></a>
	</span>
	<span class="no-print col-xs-2" style="width:200px;">
		<a href="javascript:window.print()" id="web_print" class="btn btn-block btn-primary"
           onClick="window.print();return false;"><?= lang("print"); ?></a>
	</span>
</div>