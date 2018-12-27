<div class="block-header">
    <center><h1 class="margin-top-0">Loại Sản Phẩm</h1></center>
</div>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>Chỉnh Sửa Loại Sản Phẩm</h2>
            </div>
            <div class="body">
                <form id="form_add_cate" method="POST">
                    <div class="form-group">
                        <label for="cmt03_parents">Danh Mục Loại</label>
                        <select name="cmt03_parents" class="form-control">
                            <option value="0_0">(Menu cấp parent)</option>
                            <?php foreach ($list_cate_parent_max as $cate_parent) { ?>
                                <option <?php if($getCategoryByID['cmt03_parents'] == $cate_parent['cmt03_id_cate']) echo 'selected="selected"'?> value="<?php echo $cate_parent['cmt03_id_cate'].'_'.$cate_parent['cmt03_level'] ?>"><?php echo $cate_parent['cmt03_name'].' - (Menu cấp '.$cate_parent['cmt03_level'].')' ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="cmt03_name">Tên Loại</label>
                        <input type="text" id="cmt03_name" name="cmt03_name" class="form-control" value="<?= $getCategoryByID['cmt03_name'] ?>">
                    </div>
                    <div class="form-group">
                        <input type="radio" id="cmt03_active1" name="cmt03_active" value="1" class="with-gap" <?php if($getCategoryByID['cmt03_active'] == 1) echo 'checked="checked"'?>>
                        <label for="cmt03_active1">Active</label>

                        <input type="radio" id="cmt03_active2" name="cmt03_active" value="0" class="with-gap" <?php if($getCategoryByID['cmt03_active'] == 0) echo 'checked="checked"'?>>
                        <label for="cmt03_active2" class="m-l-20">Not Active</label>
                    </div>
                    <input type="submit" name="btnEditCategory" id="btnEditCategory" class="btn bg-orange btn-lg waves-effect" value="Save">
                    <button type="button" class="btn btn-danger waves-effect" onclick="location.href='<?=base_url('admin/category')?>'">
                        <i class="material-icons">close</i>
                        <span>Cancel</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>