﻿<!DOCTYPE html>
<html>

<?php $path = "../";
include($path."include/config_header_top.php");
include 'css.php';
$page_key ='2_1';
$sql     = " SELECT *
FROM tb_producttype
where productTypeID ='".$productTypeID."' ";

$query = $db->query($sql);
$nums = $db->db_num_rows($query);
$rec = $db->db_fetch_array($query);
$proc = ($proc=='')?"add":$proc;
$txt =  ($proc=='add')?"เพิ่ม":"แก้ไข";
$readonly = "readonly";

?>

<body class="theme-red">
	<?php include 'MasterPage.php';?>

	<section class="content">
		<div class="container-fluid">
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2><?php echo $txt;?>ข้อมูลประเภทสินค้า</h2>
						</div>
						<form id="frm-input" method="post" enctype="multipart/form-data" action="process/ProductType_process.php" >
							<input type="hidden" id="proc" name="proc" value="<?php echo $proc;?>">
							<input type="hidden" id="productTypeID" name="productTypeID" value="<?php echo $productTypeID;?>">
							<input type="hidden" id="form_page" name="form_page" value="<?php echo  $form_page?>">
							<input type="hidden" id="chk" name="chk" value="0">
							<input type="hidden" id="chk2" name="chk2" value="0">
							<input type="hidden" id="chk3" name="chk3" value="0">
							<div class="body">
								<div class="row clearfix">
									<div class="col-sm-12">
										<b>รหัสประเภทสินค้า <span style="color:red"> *</span></b>
										<div class="form-group">
											<div class="form-line">
												<input type="text " <?php echo $readonly ?> name="productTypeCode" id="productTypeCode" class="form-control" value="<?php echo $rec['productTypeCode'];?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-12">
										<b>ชื่อประเภทสินค้า <span style="color:red"> *</span></b>
										<div class="form-group">
											<div class="form-line">
												<input type="text " onkeyup="chkName();" name="productTypeName" id="productTypeName" class="form-control" placeholder="ชื่อประเภทสินค้า" value="<?php echo $rec['productTypeName'];?>">
											</div>
											<label id="productTypeName-error" class="error" for="productTypeName">กรุณาระบุ ประเภทสินค้า</label>
											<label id="productTypeName2-error" class="error" for="productTypeName">มีชื่อประเภทสินค้านี้แล้ว</label>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-12">
										<b>ชื่อย่อประเภทสินค้า <span style="color:red"> *</span></b>
										<div class="form-group">
											<div class="form-line">
												<input type="text" maxlength="2" onkeyup="chkShort();" name="productTypeNameShort" id="productTypeNameShort" class="form-control" placeholder="ชื่อย่อประเภทสินค้า" value="<?php echo $rec['productTypeNameShort'];?>">
											</div>
											<label id="productTypeNameShort-error" class="error" for="productTypeNameShort">กรุณาระบุ ประเภทสินค้า</label>
											<label id="productTypeNameShort2-error" class="error" for="productTypeNameShort">มีชื่อย่อประเภทสินค้านี้แล้ว</label>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-sm-12">
										<b>รายละเอียด </b>
										<div class="form-group">
											<div class="form-line">
												<textarea  class="form-control" placeholder="รายละเอียด" id="productTypeDetail" name="productTypeDetail"> <?php echo $rec['productTypeDetail'];?> </textarea>
											</div>
										</div>
									</div>
								</div>

								<div class="align-center">
									<button type="button" class="btn btn-success waves-effect" onclick="chkinput();">บันทึก</button>
									<button type="button" class="btn btn-warning waves-effect" onclick="OnCancel();">ยกเลิก</button>
								</div>

							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include 'js.php';?>
</body>

</html>

<script>
	function OnCancel()
	{

		$(location).attr('href',"<?php echo  $form_page?>");
	}

	function chkinput(){
		debugger


			if($('#productTypeCode').val()==''){
				$('#productTypeCode-error').show();
	
				return false;
			}else{
				$('#productTypeCode-error').hide();
			}

		if($('#productTypeName').val()==''){
			$('#productTypeName-error').show();
			$('#productTypeName').focus();
			return false;
		}else{
			$('#productTypeName-error').hide();
		}

		if($('#productTypeID').val() !=1 || $('#productTypeID').val() !=2){			
			if($('#productTypeNameShort').val()==''){
				$('#productTypeNameShort-error').show();
				$('#productTypeNameShort').focus();
				return false;
			}else{
				$('#productTypeNameShort-error').hide();
			}
		}

		if($('#chk').val()==1){
			$('#productTypeCode2-error').show();
			return false;
		}

		if($('#chk1').val()==1){
			$('#productTypeNameShort2-error').show();
			return false;
		}else{
			$('#productTypeNameShort2-error').hide();
		}
		
		if(confirm("กรุณายืนยันการบันทึกอีกครั้ง ?")){
			$("#frm-input").submit();
		}
	}

	$(document).ready(function() {

		$('.error').hide();

		if($('#proc').val()=='add'){
          var productTypeCode ='';
          $.ajaxSetup({async: false});
          $.post('process/get_process.php',{proc:'get_productTypeCode'},function(data){
           productTypeCode =  data['name'];
         },'json');
          $('#productTypeCode').val(productTypeCode);
        }

	});

	function chk(){

		var productTypeCode= $('#productTypeCode').val();
		var productTypeID= $('#productTypeID').val();
		$.ajaxSetup({async: false});
		$.post('process/get_process.php',{proc:'chk_productTypeCode',productTypeCode:productTypeCode,productTypeID:productTypeID},function(data){
			if(data==1){
				$('#productTypeCode2-error').show();
				$('#chk').val(1);
			}else{
				$('#productTypeCode2-error').hide();
				$('#chk').val(0);

			}

		},'json');
	}
	function chkName(){

		var productTypeName= $('#productTypeName').val();
		var productTypeID= $('#productTypeID').val();
		$.ajaxSetup({async: false});
		$.post('process/get_process.php',{proc:'chk_productTypeName',productTypeName:productTypeName,productTypeID:productTypeID},function(data){
			if(data==1){
				$('#productTypeName2-error').show();
				$('#chk2').val(1);
			}else{
				$('#productTypeName2-error').hide();
				$('#chk2').val(0);

			}

		},'json');
	}

	function chkShort(){
		debugger
		var productTypeNameShort= $('#productTypeNameShort').val();
		var productTypeID= $('#productTypeID').val();
		$.ajaxSetup({async: false});
		$.post('process/get_process.php',{proc:'chk_productTypeNameShort',productTypeNameShort:productTypeNameShort,productTypeID:productTypeID},function(data){
			if(data==1){
				$('#productTypeNameShort2-error').show();
				$('#chk3').val(1);
			}else{
				$('#productTypeNameShort2-error').hide();
				$('#chk3').val(0);

			}

		},'json');
	}
//username2
</script>
