<!DOCTYPE html>
<html>

<?php
$path = "../";
include($path."include/config_header_top.php");
include 'css.php';
$page_key ='1_1';
$path_image = $path."file_img/";

/*$sql     = " SELECT *
            FROM tb_user
            ";

$query = $db->query($sql);
$nums = $db->db_num_rows($query); */
 $filter = '';
if($s_firstname){
    $filter .= " and firstname  like '%".$s_firstname."%'";
}
if($s_lastname){
    $filter .= " and lastname like '%".$s_lastname."%'";
}
$field = "* ";
$table = "tb_user";
$pk_id = "userID";
$wh = "1=1  and userType =2 {$filter}";
$orderby = "order by userID DESC";
$limit =" LIMIT ".$goto ." , ".$page_size ;
$sql = "select ".$field." from ".$table." where ".$wh ." ".$orderby .$limit;

$query = $db->query($sql);
$nums = $db->db_num_rows($query);
$total_record = $db->db_num_rows($db->query("select ".$field." from ".$table." where ".$wh));

chk_role($page_key,'isSearch',1) ;

?>

<body class="theme-red">
    <?php include 'MasterPage.php';?>
    <section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>รายการพนักงาน</h2>
                        </div>
                        <div class="body">
                            <form id="frm-search" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                                <input type="hidden" id="proc" name="proc" value="">
                                <input type="hidden" id="form_page" name="form_page" value="UserList.php">
                                <input type="hidden" id="userID" name="userID" value="">
                                <input type="hidden" id="page_size" name="page_size" value="<?php echo $page_size;?>">
                                <input type="hidden" id="page" name="page" value="<?php echo $page;?>">


                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                          <b>ชื่อ </b>
                                            <div class="form-line">
                                                <input type="text " name="s_firstname" id="s_firstname" class="form-control" placeholder="ชื่อ" value="<?php echo $s_firstname;?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                         <div class="form-group">
                                          <b>นามสกุล </b>
                                            <div class="form-line">
                                                <input type="text " name="s_lastname" id="s_lastname" class="form-control" placeholder="นามสกุล" value="<?php echo $s_lastname;?>">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                 <div class="icon-and-text-button-demo align-center">
                                    <button  class="btn btn-success waves-effect" onClick="searchData();"><span>ค้นหา</span><?php echo $img_view;?></button>
                                </div>
                                <div class="icon-and-text-button-demo align-right">
                                    <button  class="btn btn-primary waves-effect" onClick="addData();" style="<?php echo chk_role($page_key,'isadd');?>"><span>เพิ่มข้อมูล</span><?php echo $img_add;?></button>
                                </div>
                                <div>
                                    <table class="table table-bordered table-striped table-hover  dataTable "> <!--js-basic-example-->
                                        <thead>
                                            <tr>
                                                <th width="5%">ลำดับ</th>
                                                <th width="25%">ชื่อพนักงาน</th>
                                                <th width="25%">เบอร์โทรศัพท์</th>
                                                <th width="20%">E-mail</th>
                                                <th width="10%">ประเภท</th>
                                                <th width="15%">จัดการ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if($nums>0){ 
                                                $i=0;
                                               while ($rec = $db->db_fetch_array($query)) {
                                                $i++;
                                                $edit = ' <a style="'.chk_role($page_key,'isEdit').'" class="btn bg-orange btn-xs waves-effect"  onClick="editData('.$rec['userID'].');">'.$img_edit.'</a>';
                                                $del = ' <a style="'.chk_role($page_key,'isDel').'" class="btn bg-red btn-xs waves-effect"  onClick="delData('.$rec['userID'].');">'.$img_del.'</a>';
                                                $info = ' <a style="'.chk_role($page_key,'isSearch').'" class="btn btn-info btn-xs waves-effect" onClick="infoData('.$rec['userID'].');">'.$img_info.'</a>';  //  data-toggle="modal" data-target="#largeModal" id="btn_info" data-toggle="tooltip" data-placement="top" title="ข้อมูล"
                                            ?>
                                                <tr>
                                                    <td style="text-align: center;"><?php echo $i+$goto;?></td>
                                                    <td><?php echo $rec['firstname']." ".$rec['lastname'];?></td>
                                                    <td><?php echo $rec['mobile'];?></td>
                                                    <td><?php echo $rec['email'];?></td>
                                                    <td><?php echo $arr_userType[$rec['userType']];?></td>
                                                    <td style="text-align: center;"><?php echo $info.$edit.$del;?>
                                                      <input type="hidden" id="show_name_<?php echo $rec['userID'];?>" value="<?php echo $rec['firstname']." ".$rec['lastname'];?>" >
                                                      <input type="hidden" id="show_idcard_<?php echo $rec['userID'];?>" value="<?php echo $rec['idcard'];?>" >
                                                      <input type="hidden" id="show_email_<?php echo $rec['userID'];?>" value="<?php echo $rec['email'];?>" >
                                                      <input type="hidden" id="show_mobile_<?php echo $rec['userID'];?>" value="<?php echo $rec['mobile'];?>" >
                                                      <input type="hidden" id="show_birthday_<?php echo $rec['userID'];?>" value="<?php echo conv_date($rec['birthday'],'long');?>" >
                                                      <input type="hidden" id="show_address_<?php echo $rec['userID'];?>" value="<?php echo $rec['address'].' '.' ตำบล/แขวง '.get_subDistrictID_name($rec['subDistrictID']).' อำเภอ/เขต '.get_district_name($rec['districtID']).' จังหวัด '.get_prov_name($rec['provinceID']).' '.$rec['zipcode'];?>" >
                                                      <input type="hidden" id="show_Img_<?php echo $rec['userID'];?>" value="<?php echo $rec['img'];?>" >
                                                    </td>
                                                </tr>
                                            <?php }
                                            }else{
                                                echo '<tr><td colspan="5">ไม่พบข้อมูล</td></tr>';
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                       <?php echo ($nums > 0) ? endPaging("frm-search", $total_record) : ""; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Basic Examples -->
        </div>
    </section>

    <?php include 'js.php';?>
</body>

</html>



 <!-- Large Size -->
    <div class="modal fade" id="ModalDetail" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="largeModalLabel">ข้อมูลพนักงาน</h4>
                </div>
                <div class="modal-body">
                  <div class="align-center">
                      <div class="col-sm-12">
                           <div class="form-group" id="txt_img"></div>
                      </div>

                  </div>
                  <div class="row clearfix">
                      <div class="col-sm-12">
                            <b>ชื่อ</b>
                           <div class="form-group" id="txt_name"></div>
                      </div>

                  </div>
                  <div class="row clearfix">
                      <div class="col-sm-12">
                            <b>หมายเลขบัตรประชาชน</b>
                           <div class="form-group" id="txt_id"></div>
                      </div>
                  </div>
                  <div class="row clearfix">
                      <div class="col-sm-12">
                            <b>วันเดือนปี เกิด</b>
                           <div class="form-group" id="txt_birthday"></div>
                      </div>

                  </div>
                  <div class="row clearfix">
                      <div class="col-sm-12">
                            <b>ที่อยู่</b>
                           <div class="form-group" id="txt_address"></div>
                      </div>

                  </div>
                  <div class="row clearfix">
                      <div class="col-sm-12">
                            <b>เบอร์โทรศัพท์</b>
                           <div class="form-group" id="txt_mobile"></div>
                      </div>

                  </div>
                  <div class="row clearfix">
                      <div class="col-sm-12">
                            <b>เบอร์โทรศัพท์</b>
                           <div class="form-group" id="txt_email"></div>
                      </div>

                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">ปิด</button>
                </div>
                     <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                    </div> -->
                </div>
            </div>
        </div>
<script>

function searchData(){
  $("#frm-search").submit();
}
function infoData(id){

var img = '<img width="50%" height="50%" src="<?php echo $path_image;?>'+$('#show_Img_'+id).val()+'">';
   $('#txt_img').html(img);
   $('#txt_name').html($('#show_name_'+id).val());
   $('#txt_id').html($('#show_idcard_'+id).val());
   $('#txt_birthday').html($('#show_birthday_'+id).val());
   $('#txt_address').html($('#show_address_'+id).val());
   $('#txt_mobile').html($('#show_mobile_'+id).val());
   $('#txt_email').html($('#show_email_'+id).val());

  $('#ModalDetail').modal('show');
}
function addData(){
  $("#proc").val("add");
  $("#frm-search").attr("action","UserInfo.php").submit();
}
function editData(id){
  $("#proc").val("edit");
  $("#userID").val(id);
  $("#frm-search").attr("action","UserInfo.php").submit();
}
function delData(id){
  if(confirm("ต้องการลบข้อมูลใช่หรือไม่ ?")){
    $("#proc").val("delete");
    $("#userID").val(id);
    $("#frm-search").attr("action","process/profile_process.php").submit();
  }
}

</script>
