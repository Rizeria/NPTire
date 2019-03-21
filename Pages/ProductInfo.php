<!DOCTYPE html>
<html>
<?php
$path = "../";
include($path."include/config_header_top.php");
 include 'css.php';
 $page_key ='2_3_2';
 $form_page = $form_page;

 $sql     = " SELECT *
            FROM tb_product
            where productID ='".$productID."' ";

$query = $db->query($sql);
$nums = $db->db_num_rows($query);
$rec = $db->db_fetch_array($query);
$proc = ($proc=='')?"add":$proc;
$txt =  ($proc=='add')?"เพิ่ม":"แก้ไข";
$s_location = "SELECT * from tb_location order by locationName ";
 ?>

<body class="theme-red">
    <?php include 'MasterPage.php';?>
    <section class="content">
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2><?php echo $txt;?>ข้อมูลสินค้าอื่นๆ</h2>
                        </div>
                         <form id="frm-input" method="post" enctype="multipart/form-data" action="process/Product_process.php" >
                                <input type="hidden" id="proc" name="proc" value="<?php echo $proc;?>">
                                <input type="hidden" id="productID" name="productID" value="<?php echo $productID;?>">
                                <input type="hidden" id="form_page" name="form_page" value="<?php echo  $form_page?>">
                                <input type="hidden" id="chk" name="chk" value="0">
                            <div class="body">

                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                          <b>รหัสสินค้า </b>
                                         <div class="input-group">
                                            <div class="form-line">
                                                <input type="text " readonly name="productCode" id="productCode" class="form-control" placeholder="รหัสสินค้า" value="<?php echo $rec['productCode'];?>">
                                            </div>
                                            <label id="productCode-error" class="error" for="productName">มีรหัสสินค้านี้แล้ว</label>
                                        </div>
									                  </div>
                                    <div class="col-sm-8">
                                         <b>ชื่อสินค้า <span style="color:red"> *</span></b>
                                        <div class="input-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control " placeholder="ชื่อสินค้า"  name="productName" id="productName"  value="<?php echo $rec['productName'];?>">
                                            </div>
                                            <label id="productName-error" class="error" for="productName">กรุณาระบุ</label>
                                        </div>
                                    </div>
                                </div>
								               <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <b>ยี่ห้อ <span style="color:red"> *</span></b>

                                        <div class="form-group form-float">
                                            <select name="brandID" id="brandID" class="form-control show-tick" data-live-search="true" >
                                                <option value="">เลือก</option>
                                            <?php
                                                $s_brand=" SELECT * from tb_brand order by brandName asc";
                                                $q_brand = $db->query($s_brand);
                                                $n_brand = $db->db_num_rows($q_brand);
                                               while($r_brand = $db->db_fetch_array($q_brand)){
                                            ?>
                                                <option value="<?php echo $r_brand['brandID'];?>"  <?php echo ($rec['brandID']==$r_brand['brandID'])?"selected":"";?>> <?php echo $r_brand['brandName'];?></option>

                                            <?php }  ?>
                                            </select>
                                          <label id="brandID-error" class="error" for="brandID">กรุณาระบุ</label>
                                        </div>
                                    </div>
																		<div class="col-sm-4">
																			<b>ประเภทสินค้า <span style="color:red"> *</span></b>

																			<div class="form-group form-float">
																				<select name="productTypeID" id="productTypeID" class="form-control show-tick" data-live-search="true"  onchange="get_code();">
																					<option value="">เลือก</option>
																					<?php
																					$s_pdtype=" SELECT * from tb_producttype where productTypeID not in (1,2) order by productTypeName asc";
																					$q_pdtype = $db->query($s_pdtype);
																					$n_pdtype = $db->db_num_rows($q_pdtype);
																					while($r_pdtype = $db->db_fetch_array($q_pdtype)){

																						?>
																						<option value="<?php echo $r_pdtype['productTypeID'];?>"  <?php echo ($rec['productTypeID']==$r_pdtype['productTypeID'])?"selected":"";?>> <?php echo $r_pdtype['productTypeName'];?></option>

																					<?php }  ?>
																				</select>
																				<label id="productTypeID-error" class="error" for="productTypeID">กรุณาระบุ</label>
																			</div>
																		</div>
																		<div class="col-md-4">
																			<b>รูปภาพ</b>
																			<div class="form-group">
																				<div class="form-line">
																					<input type="file" class="form-control " placeholder=""  name="productImg" id="productImg"  value="<?php //echo $rec['img'];?>">
																					<input type="hidden" name="old_file" id="old_file" value="<?php echo $rec['productImg'];?>" >
																				</div>
																			</div>
																		</div>
															</div>

                                <div class="row clearfix">
																	<div class="col-sm-4">
																		<b>จำนวนสินค้า </b>
																	 <div class="form-group">
																			<div class="form-line">
																					<input type="text " readonly name="productUnit" id="productUnit" class="form-control " placeholder="จำนวนสินค้า" value="<?php echo number_format($rec['productUnit']);?>">
																			</div>
																	</div>
																 </div>
                                    <div class="col-sm-4">
                                        <b>หน่วยนับ <span style="color:red"> *</span></b>

                                        <div class="form-group form-float">
                                            <select name="unitType" id="unitType" class="form-control show-tick" data-live-search="true" >
                                                <option value="">เลือก</option>
                                            <?php   foreach ($arr_unitType as $key => $value) {?>
                                                <option value="<?php echo $key;?>"  <?php echo ($rec['unitType']==$key)?"selected":"";?>> <?php echo $value;?></option>

                                            <?php }  ?>
                                            </select>
                                          <label id="unitType-error" class="error" for="unitType">กรุณาระบุ</label>
                                        </div>
                                    </div>

                                 </div>


                                 <div class="row clearfix">
             												<div class="col-sm-12">
             															<b>รายละเอียด </b>
             														 <div class="form-group">
             																<div class="form-line">
             																	<textarea  class="form-control" placeholder="รายละเอียด" id="productDetail" name="productDetail"> <?php echo $rec['productDetail'];?> </textarea>
             																</div>
             															</div>
             													</div>
             											</div>


                               <div class="row clearfix">

                                   <!--
                                   <div class="col-sm-4">
                                      <b>สถานะการใช้งาน</b>
                                       <div class="form-group">
                                            <input type="radio" value="1" name="activeStatus" id="activeStatus1" class="with-gap" <?php echo ($rec['activeStatus']==1)?"checked":"";?>>
                                            <label for="activeStatus1">ใช้งาน</label>
                                            <input type="radio" value="0" name="activeStatus" id="activeStatus0" class="with-gap"  <?php echo ($rec['activeStatus']==0)?"checked":"";?>>
                                            <label for="activeStatus0" class="m-l-20">ไม่ใช้งาน</label>
                                        </div>

                                    </div>-->
                                </div>
                               <!--  <div class="icon-and-text-button-demo align-right">
                                    <a  class="btn btn-primary waves-effect" onClick="addRow();"><span>เพิ่มสถานที่จัดเก็บ</span><?php echo $img_add;?></a>
                                </div> -->
                                <div class="input-group">
                                <table class="table table-bordered table-striped table-hover  dataTable " id="tb_data"> <!--js-basic-example-->
                                    <thead>
                                        <tr>

                                            <th width="70%">สถานที่จัดเก็บสินค้า</th>
                                            <th width="20%">จำนวน</th>
                                            <!-- <th width="10%">จัดการ</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=0; $total=0;
                                        $sql_sub  = " SELECT * FROM tb_productstore    where productID ='".$productID."' ";

                                       $query_sub = $db->query($sql_sub);
                                       $nums_sub = $db->db_num_rows($query_sub);
                                      if($nums_sub>0){
                                         while ($rec_sub = $db->db_fetch_array($query_sub)) {
                                            $i++;
                                    ?>
                                    <tr>
                                        <td>
                                          <select name="locationID[]" id="locationID_<?php echo $i;?>" class="form-control show-tick" data-live-search="true" >
                                            <option value="">เลือก</option>
                                              <?php
                                              $q_location = $db->query($s_location);
                                              while ($r_location = $db->db_fetch_array($q_location)) {?>
                                            <option value="<?php echo $r_location['locationID'];?>" <?php echo ($r_location['locationID']==$rec_sub['locationID'])?"selected":"";?>><?php echo $r_location['locationName'];?></option>
                                              <?php } ?>
                                          </select>
                                       </td>
                                        <td>
                                            <div class="form-line">
                                              <input type="text"  style="text-align: right;" class="form-control numb"   name="ps_unit[]" id="ps_unit_<?php echo $i;?>" onBlur="NumberFormat(this); get_total();" value="<?php echo $rec_sub['ps_unit'];?>" >
                                            </div>
                                          </td>
                                        <!--   <td style="text-align: center;">
                                            <a class="btn bg-red btn-xs waves-effect"  href="javascript:void(0);" onClick="delData(this);"><?php echo $img_del;?></a>
                                          </td> -->
                                        </tr>
                                      <?php   }
                                    }else{
                                      echo '<tr><td align="center" colspan="7">ไม่พบข้อมูล</td></tr>';
                                    }

                                       ?>



                                    </tbody>
                              </table>
                                <label id="tb_data-error" class="error" for="tb_data">จำนวนสินค้าในตำแหน่งจัดเก็บไม่เท่ากับจำนวนสินค้าทั้งหมด</label>
                              </div>
                              <input type="hidden" id="total_unit" value="<?php echo $total;?>">
                              <input type="hidden" id="rowid" value="<?php echo $i;?>">




                               <div class="align-center">
                                    <button type="button" class="btn btn-success waves-effect" onclick="chkinput();">บันทึก</button>
                                    <button type="button" class="btn btn-warning waves-effect" onclick="OnCancel();">ยกเลิก</button>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <!-- #END# Advanced Form Example With Validation -->
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


    if($('#productName').val()==''){
        $('#productName-error').show();
       $('#productName').focus();
        return false;
    }else{
		$('#productName-error').hide();
	}
    if($('#brandID').val()==''){
        $('#brandID-error').show();
      $('#brandID').focus();
        return false;
    }else{
		$('#brandID-error').hide();
	}
    if($('#productSize').val()==''){
        $('#productSize-error').show();
     $('#productSize').focus();
        return false;
    }else{
		$('#productSize-error').hide();
	}
    if($('#modelName').val()==''){
        $('#modelName-error').show();
     $('#modelName').focus();
        return false;
    }else{
		$('#modelName-error').hide();
	}
    if($('#productTypeID').val()==''){
        $('#productTypeID-error').show();
     $('#productTypeID').focus();
        return false;
    }else{
		$('#productTypeID-error').hide();
	}
    if($('#unitType').val()==''){
        $('#unitType-error').show();
      $('#unitType').focus();
        return false;
    }else{
		$('#unitType-error').hide();
	}
    debugger
    if(parseInt($('#total_unit').val())!=parseInt($('#productUnit').val().trim().replace(/,/g,''))){
      $('#tb_data-error').show();
      return false;
    }
    if($('#chk').val()==1){
        return false;
    }


    if(confirm("กรุณายืนยันการบันทึกอีกครั้ง ?")){
      $("#frm-input").submit();
    }
}

$(document).ready(function() {
     //   $('.idcard').inputmask('9-9999-99999-99-9', { placeholder: '_-____-_____-__-_' });
     //   $('.mobile').inputmask('999-999-9999', { placeholder: '___-___-____' });
        //$('.focused').removeClass('focused');
      $('.error').hide();

        // $('.datepickers').bootstrapMaterialDatePicker();
     //  $(".numb").keyup(function() {//Can Be {0-9,.}
    	// 		chkFormatNam($(this).val(), $(this).attr('id'));
    	// });
      $(".numb").inputFilter(function(value) {
        return /^\d*$/.test(value); });
      get_total();
});

function get_code(){

  if($('#proc').val()=='add'){
        var productTypeID = $('#productTypeID').val();

        var newcode ='';
        $.ajaxSetup({async: false});
        $.post('process/get_process.php',{proc:'get_productcoder_other',productTypeID:productTypeID},function(data){
             newcode =  data['name'];
        },'json');

        $('#productCode').val(newcode);

  //
  }
    // var html  = '';
    //  $.post('process/get_process.php',{proc:'get_zipcode',parent_id:parent_id},function(data){
    //
    //           $.each(data,function(index,value){
    //               html += value['zipcode'];
    //           });
    //
    //     $('#zipcode').val(html);
    //
    // },'json');
}
function chk(){
      var productCode = $('#productCode').val();
      $.ajaxSetup({async: false});
       $.post('process/get_process.php',{proc:'chk_productCode',productCode:productCode},function(data){
         if(data==1){
                $('#productCode-error').show();
                 $('#chk').val(1);
          }else{
                 $('#productCode-error').hide();
                  $('#chk').val(0);
          }
      },'json');
}
function addRow(){
    var html = '';
    var rowid = parseInt($('#rowid').val())+1;
    html += '<tr>';
      html += '<td>';
      html += '<select name="locationID[]" id="locationID_'+rowid+'" class="form-control show-tick" data-live-search="true" >';
      html += '<option value="">เลือก</option>';
      <?php
      $q_location = $db->query($s_location);
      while ($r_location = $db->db_fetch_array($q_location)) {?>
          html +='<option value="<?php echo $r_location['locationID'];?>"><?php echo $r_location['locationName'];?></option>';
      <?php } ?>
      html +='</select>';
      html +='</td>';
      html += '<td>';
      html += '    <div class="form-line">';
      html += '       <input type="text"  style="text-align: right;" class="form-control numb"   name="ps_unit[]" id="ps_unit_'+rowid+'" onBlur="NumberFormat(this); get_total();" value="0" >';
      html += '    </div>';
      html += '</td>';
      html += '<td style="text-align: center;">';
      html += '<a class=\"btn bg-red btn-xs waves-effect\"  href=\"javascript:void(0);\" onClick=\"delData(this);\"><?php echo $img_del;?> </a>';
      html += '</td>';
    html += '</tr>';
    $('#tb_data tbody').append(html);
    $('#rowid').val(rowid);
    $('#locationID_'+rowid).selectpicker('refresh');
    $(".numb").inputFilter(function(value) {
        return /^\d*$/.test(value); });
   //  $(".numb").keyup(function() {//Can Be {0-9,.}
  	// 		chkFormatNam($(this).val(), $(this).attr('id'));
  	// });
}
function delData(obj){
    if(confirm("ยืนยันการลบข้อมูล ?")){
     $(obj).parent().parent().remove();
     get_total();
    }
 }
 function  get_total(){
  debugger
   var arr = $('input[id^=ps_unit_]');
   var total = 0;
   for (var i = 0; i < arr.length; i++) {
       var num = parseInt($(arr[i]).val().trim().replace(/,/g,''));

       total = total+num;
   }
   $('#total_unit').val(total);
   //var arr = parseInt($('#rowid').val()replace(/,/g,''));
 }
</script>
