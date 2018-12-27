<div class="block-header">
    <center><h1 class="margin-top-0">Loại Sản Phẩm</h1></center>
</div>
<?php if ($this->session->flashdata('category_success')) { ?>
    <div class="alert alert-success">
        <strong><?= $this->session->flashdata('category_success') ?></strong>
    </div>
<?php } ?>

<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Danh Sách Loại Sản Phẩm</h2>
            </div>
            <div class="body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="25%" class="align-center">Mã</th>
                            <th width="25%" class="align-center">Tên Loại</th>
                            <th width="25%" class="align-center">Hiện Hành</th>
                            <th class="align-center">Thao Tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($list_category)) { ?>
                            <?php foreach ($list_category as $cate) { ?>
                                <tr>
                                    <td class="align-center"><?php echo $cate['cmt03_id_cate']; ?></td>
                                    <td><?php echo $cate['cmt03_name']; ?></td>
                                    <td class="align-center">
                                        <?php if ($cate['cmt03_active'] == 1) { ?>
                                            <input type="checkbox" id="cmt03_active" class="chk-col-green" checked disabled>
                                            <label for="cmt03_active"></label>
                                        <?php } ?>
                                    </td>
                                    <td class="align-center js-sweetalert">
                                        <button class="btn bg-green waves-effect" onclick="location.href='<?=base_url('admin/category/edit/').$cate["cmt03_id_cate"]?>'">Sửa</button>
                                        <button id="btn_delete_cate" class="btn bg-red waves-effect" data-type="delete_cate" data-link="<?=base_url('admin/category/delete/').$cate["cmt03_id_cate"]?>">Xóa</button>
                                    </td>
                                </tr>
                            <?php } ?>
                        <?php }else { ?>
                            <tr>
                                <td colspan="4" class="align-center"><?='Không có dữ liệu !'?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <?php if($total_rows != 0 && $total_rows > 1) { ?>
                <div class="body align-center padding-top-0">
                    <nav>
                        <ul class="pagination">
                            <?= $pagination ?>
                        </ul>
                    </nav>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.js-sweetalert #btn_delete_cate').on('click', function () {
            var type = $(this).data('type');
            var link_del = $(this).data('link');
            if (type === 'delete_cate') {
                confirmDeleteCate(link_del);
            }
        });
    });

    function confirmDeleteCate(link_del) {
        swal({
            title: "Bạn có chắc chắn muốn xóa?",
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#f44336",
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            closeOnCancel: false
        }, function (isConfirm) {
            if (isConfirm) {
                swal("Deleted!", "This category has been deleted!", "success");
                location.href = link_del;
            } else {
                swal("Cancelled", "This category is safe!", "error");
            }
        });
    }

    $(".alert-success").delay(2000).fadeOut("fast");
</script>