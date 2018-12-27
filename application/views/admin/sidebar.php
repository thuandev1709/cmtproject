<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <img src="<?php echo base_url(); ?>assets/admin/images/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?=$cmt01_firstname.' '.$cmt01_lastname?></div>
                <div class="email"><?=$cmt01_email?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <!-- <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                        <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>
                        <li role="separator" class="divider"></li> -->
                        <li><a href="<?php echo base_url('admin/account/signout'); ?>"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MENU</li>
                <li class="<?php if($page_name =='home') echo 'active';?>">
                    <a href="<?=base_url('admin')?>">
                        <i class="material-icons">home</i>
                        <span>Trang Chủ</span>
                    </a>
                </li>
                <li class="<?php if($page_name =='category' || $page_name =='category_add' || $page_name =='category_edit') echo 'active';?>">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">assignment</i>
                        <span>Loại Sản Phẩm</span>
                    </a>
                    <ul class="ml-menu" style="display: none;">
                        <li class="<?php if($page_name =='category') echo 'active';?>">
                            <a href="<?=base_url('admin/category')?>" class="waves-effect waves-block">Danh Sách Loại</a>
                        </li>
                        <li class="<?php if($page_name =='category_add' || $page_name =='category_edit') echo 'active';?>">
                            <a href="<?=base_url('admin/category/add')?>" class="waves-effect waves-block">Thêm/Chỉnh Sửa Loại</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if($page_name =='product' || $page_name =='product_add' || $page_name =='product_edit') echo 'active';?>">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">assignment</i>
                        <span>Sản Phẩm</span>
                    </a>
                    <ul class="ml-menu" style="display: none;">
                        <li class="<?php if($page_name =='product') echo 'active';?>">
                            <a href="<?=base_url('admin/product')?>" class="waves-effect waves-block">Danh Sách Sản Phẩm</a>
                        </li>
                        <li class="<?php if($page_name =='product_add' || $page_name =='product_edit') echo 'active';?>">
                            <a href="<?=base_url('admin/product/add')?>" class="waves-effect waves-block">Thêm/Chỉnh Sửa Sản Phẩm</a>
                        </li>
                    </ul>
                </li>
                <li class="<?php if($page_name =='news' || $page_name =='news_add' || $page_name =='news_edit') echo 'active';?>">
                    <a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
                        <i class="material-icons">comment</i>
                        <span>Tin Tức</span>
                    </a>
                    <ul class="ml-menu" style="display: none;">
                        <li class="<?php if($page_name =='news') echo 'active';?>">
                            <a href="<?=base_url('admin/news')?>" class="waves-effect waves-block">Danh Sách Tin Tức</a>
                        </li>
                        <li class="<?php if($page_name =='news_add' || $page_name =='news_edit') echo 'active';?>">
                            <a href="<?=base_url('admin/news/add')?>" class="waves-effect waves-block">Thêm/Chỉnh Sửa Tin Tức</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                &copy; 2018-2019 <a href="#">Store Cosmetic</a>
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0 <br>
                <p>Contact: lethanhthuan.dev@gmail.com</p>
            </div>
        </div>
        <!-- #Footer -->
    </aside>
    <!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
    <aside id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs tab-nav-right" role="tablist">
            <li role="presentation" class="active"><a href="#skins" data-toggle="tab">SKINS</a></li>
            <li role="presentation"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade in active in active" id="skins">
                <ul class="demo-choose-skin">
                    <li data-theme="red">
                        <div class="red"></div>
                        <span>Red</span>
                    </li>
                    <li data-theme="pink" class="active">
                        <div class="pink"></div>
                        <span>Pink</span>
                    </li>
                    <li data-theme="purple">
                        <div class="purple"></div>
                        <span>Purple</span>
                    </li>
                    <li data-theme="deep-purple">
                        <div class="deep-purple"></div>
                        <span>Deep Purple</span>
                    </li>
                    <li data-theme="indigo">
                        <div class="indigo"></div>
                        <span>Indigo</span>
                    </li>
                    <li data-theme="blue">
                        <div class="blue"></div>
                        <span>Blue</span>
                    </li>
                    <li data-theme="light-blue">
                        <div class="light-blue"></div>
                        <span>Light Blue</span>
                    </li>
                    <li data-theme="cyan">
                        <div class="cyan"></div>
                        <span>Cyan</span>
                    </li>
                    <li data-theme="teal">
                        <div class="teal"></div>
                        <span>Teal</span>
                    </li>
                    <li data-theme="green">
                        <div class="green"></div>
                        <span>Green</span>
                    </li>
                    <li data-theme="light-green">
                        <div class="light-green"></div>
                        <span>Light Green</span>
                    </li>
                    <li data-theme="lime">
                        <div class="lime"></div>
                        <span>Lime</span>
                    </li>
                    <li data-theme="yellow">
                        <div class="yellow"></div>
                        <span>Yellow</span>
                    </li>
                    <li data-theme="amber">
                        <div class="amber"></div>
                        <span>Amber</span>
                    </li>
                    <li data-theme="orange">
                        <div class="orange"></div>
                        <span>Orange</span>
                    </li>
                    <li data-theme="deep-orange">
                        <div class="deep-orange"></div>
                        <span>Deep Orange</span>
                    </li>
                    <li data-theme="brown">
                        <div class="brown"></div>
                        <span>Brown</span>
                    </li>
                    <li data-theme="grey">
                        <div class="grey"></div>
                        <span>Grey</span>
                    </li>
                    <li data-theme="blue-grey">
                        <div class="blue-grey"></div>
                        <span>Blue Grey</span>
                    </li>
                    <li data-theme="black">
                        <div class="black"></div>
                        <span>Black</span>
                    </li>
                </ul>
            </div>
            <div role="tabpanel" class="tab-pane fade" id="settings">
                <div class="demo-settings">
                    <p>GENERAL SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Report Panel Usage</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Email Redirect</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>SYSTEM SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Notifications</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Auto Updates</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                    <p>ACCOUNT SETTINGS</p>
                    <ul class="setting-list">
                        <li>
                            <span>Offline</span>
                            <div class="switch">
                                <label><input type="checkbox"><span class="lever"></span></label>
                            </div>
                        </li>
                        <li>
                            <span>Location Permission</span>
                            <div class="switch">
                                <label><input type="checkbox" checked><span class="lever"></span></label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </aside>
    <!-- #END# Right Sidebar -->
</section>

<section class="content">
    <div class="container-fluid">