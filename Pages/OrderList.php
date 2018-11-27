<!DOCTYPE html>
<html>

<?php include 'css.php';?>

<body class="theme-red">
    <?php include 'MasterPage.php';?>

    <section class="content">
        <div class="container-fluid">
            <!-- Basic Examples -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>รายการสั่งซื้อสินค้า</h2>
                        </div>
                        <div class="body">
                            <form action="UserInfo.php" method="POST">
                                <div class="icon-and-text-button-demo align-right">
                                    <button type="button" class="btn btn-primary waves-effect"><span>เพิ่มข้อมูล</span><i class="material-icons">add_box</i></button>
                                </div>
                                <div class="table-responsive">
                                    <table width="100%" class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                        <thead>
                                            <tr>
                                                <th>ลำดับ</th>
                                                <th>เลขที่เอกสาร</th>
                                                <th>ชื่อ/บริษัทคู่ค้า</th>
                                                <th>วันที่</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>PO-20180623113707</td>
                                                <td>บริษัท โยโกฮาม่า เอเชีย จำกัด</td>
                                                <td>2018-06-23 11:37:07</td>
                                                <td>
                                                 <span  data-toggle="modal" data-target="#largeModal">
                                                    <button id="btn_info" type="button" class="btn btn-info btn-xs waves-effect" data-toggle="tooltip" data-placement="top" title="ข้อมูล">
                                                        <i class="material-icons">info_outline</i>
                                                    </button>
                                                </span>
                                                <a class="btn bg-default btn-xs waves-effect">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <a class="btn bg-red btn-xs waves-effect">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>PO-20180222095107</td>
                                            <td>บริษัท สยามมิชลิน จำกัด</td>
                                            <td>2018-02-22 21:51:07</td>
                                                <td>
                                                 <span  data-toggle="modal" data-target="#largeModal">
                                                    <button id="btn_info" type="button" class="btn btn-info btn-xs waves-effect" data-toggle="tooltip" data-placement="top" title="ข้อมูล">
                                                        <i class="material-icons">info_outline</i>
                                                    </button>
                                                </span>
                                                <a class="btn bg-default btn-xs waves-effect">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <a class="btn bg-red btn-xs waves-effect">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>PO-20180222071725</td>
                                            <td>บริษัท บริดจสโตนเซลส์ (ประเทศไทย) จำกัด</td>
                                            <td>2018-02-22 19:17:25</td>
                                               <!--  <td>
                                                    <div class="switch">
                                                        <label><input type="checkbox" disabled><span class="lever"></span></label>
                                                    </div>
                                                </td> -->
                                                <td>
                                                   <span  data-toggle="modal" data-target="#largeModal">
                                                    <button id="btn_info" type="button" class="btn btn-info btn-xs waves-effect" data-toggle="tooltip" data-placement="top" title="ข้อมูล">
                                                        <i class="material-icons">info_outline</i>
                                                    </button>
                                                </span>
                                                <a class="btn bg-default btn-xs waves-effect">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <a class="btn bg-red btn-xs waves-effect">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>PO-20180222041317</td>
                                            <td>บริษัท ดันลอปไทร์ (ไทยแลนด์) จำกัด</td>
                                            <td>2018-02-22 16:13:17</td>
                                                <!-- <td>
                                                    <div class="switch">
                                                        <label><input type="checkbox" disabled checked><span class="lever"></span></label>
                                                    </div>
                                                </td> -->
                                                <td>
                                                   <span  data-toggle="modal" data-target="#largeModal">
                                                    <button id="btn_info" type="button" class="btn btn-info btn-xs waves-effect" data-toggle="tooltip" data-placement="top" title="ข้อมูล">
                                                        <i class="material-icons">info_outline</i>
                                                    </button>
                                                </span>
                                                <a class="btn bg-default btn-xs waves-effect">
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <a class="btn bg-red btn-xs waves-effect">
                                                    <i class="material-icons">delete_forever</i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>PO-20180222041046</td>
                                            <td>บริษัท ดีสโตน จำกัด</td>
                                            <td>2018-02-22 16:10:46</td>
                                               <!--  <td>
                                                    <div class="switch">
                                                        <label><input type="checkbox" disabled checked><span class="lever"></span></label>
                                                    </div>
                                                </td> -->
                                                <td>
                                                    <span  data-toggle="modal" data-target="#largeModal">
                                                        <button id="btn_info" type="button" class="btn btn-info btn-xs waves-effect" data-toggle="tooltip" data-placement="top" title="ข้อมูล">
                                                            <i class="material-icons">info_outline</i>
                                                        </button>
                                                    </span>
                                                    <a class="btn bg-default btn-xs waves-effect">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a class="btn bg-red btn-xs waves-effect">
                                                        <i class="material-icons">delete_forever</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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