<!DOCTYPE html>
<!-- 
Description: Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.1.3
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="cn">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>呆萌科技</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>

    <?php include 'inc_global_css.php'; ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="./assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="<?=BASE_URL?>css/simditor.css"/>
    <!-- END PAGE LEVEL STYLES -->

    <?php include 'inc_theme_css.php'; ?>

    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->

<!-- BEGIN BODY -->
<body class="page-header-fixed page-quick-sidebar-over-content page-header-fixed-mobile page-footer-fixed1">
    
    <?php include "inc_header.php"; ?>
    <div class="clearfix"></div>
    
    <!-- BEGIN CONTAINER -->
    <div class="page-container">
        <?php include 'leftnav.php'; ?>
        <!-- BEGIN CONTENT -->
        <div class="page-content-wrapper">
            <div class="page-content">

                <?php include "inc_page_header.php"; ?>

                <!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                            <i class="icon-equalizer font-red-sunglo"></i>
                            <span class="caption-subject font-red-sunglo bold uppercase">Form Sample</span>
                            <span class="caption-helper">form actions without bg color</span>
                            </div>
                            <div class="actions">
                            	<div class="portlet-input input-inline input-small">
                                    <div class="input-icon right">
                                    	<i class="icon-magnifier"></i>
                                    	<input type="text" class="form-control input-circle" placeholder="search...">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                            <form action="idea_detail_all.php" method="post" class="form-horizontal">
                            	<div class="form-body">
                                    <!--自定义项目 开始-->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">标题</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="name" value=<?php echo "\"".$idea_list[0]["name"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-3 control-label">简介</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="brief" value=<?php echo "\"".$idea_list[0]["brief"]."\"/>";
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">内容</label>
                                        <div class="col-md-6">
                                            <div class="input-group">
                                                <textarea id="editor" name="content" placeholder="这里输入内容" autofocus>
                                                    <?php echo  $idea_list[0]["content"];?>
                                                </textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">作者</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="user_name" value=<?php echo "\"".$idea_list[0]["user_name"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">标签</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="textarea" class="form-control" name="tags" value=<?php echo "\"".$idea_list[0]["tags"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    	<label class="col-md-3 control-label">相关信息</label>
                                        <div class="col-md-4">
                                        	<table border="1">
                                        	<tr style="color: red;width:100px">
                                        		<th>创建时间</th><th>评价数目</th><th>喜欢数目</th><th>分享数目</th>
                                        	</tr>
                                        	<tr>
                                        		<td><input type="datetime" name="create_time" value=<?php echo "\"".$idea_list[0]["create_time"]."\"/>";?></td>
                                        		<td><input type="text" name="sum_comment" value=<?php echo "\"".$idea_list[0]["sum_comment"]."\"/>";?></td>
                                        		<td>
                                        			<input type="text" name="sum_like" value=<?php echo "\"".$idea_list[0]["sum_like"]."\"/>";?>
                                        		</td>
                                        		
                                        		<td>
                                        			<input type="text" name="sum_share" value=<?php echo "\"".$idea_list[0]["sum_share"]."\"/>";?>
                                        		</td>
                                        	</tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">目前状态及修改</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="textarea" class="form-control" value=<?php echo "\"".$idea_list[0]["status_name"]."\"/>";?>
                                            <select name="idea_status">
                                            	<option value ="2" <?php 
                                                if($idea_list[0]["idea_status"]==2)
                                                {
                                                    echo 'selected="selected"';
                                                }

                                                ?>>待审核</option>
                                                
                                                <option value ="3" <?php 
                                                if($idea_list[0]["idea_status"]==3)
                                                {
                                                    echo 'selected="selected"';
                                                }

                                                ?>>拒绝</option>
                                                <option value ="4" <?php 
                                                if($idea_list[0]["idea_status"]==4)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>审核通过集赞中</option>
                                                <option value ="5" <?php 
                                                if($idea_list[0]["idea_status"]==5)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>待产</option>
                                                <option value ="6" <?php 
                                                if($idea_list[0]["idea_status"]==6)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>生产完成</option>

                                                <option value ="7" <?php 
                                                if($idea_list[0]["idea_status"]==7)
                                                {
                                                    echo 'selected="selected"';
                                                }
                                                ?>>下线</option>
                                            	
                                            </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">管理员评语</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="textarea" class="form-control" name="reason" placeholder="内容">
                                            </div>
                                        </div>
                                    </div>
                                  -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">是否首页推荐</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="is_recommend" value=<?php echo "\"".$idea_list[0]["is_recommend"]."\"/>";?>
                                            </div>

                                             说明：0表示不推荐，值越大，排名越靠前
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">筹赞开始时间</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="begin_time" value=<?php echo "\"".$idea_list[0]["begin_time"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">筹赞结束时间</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="end_time" value=<?php echo "\"".$idea_list[0]["end_time"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">筹赞目标</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="textarea" class="form-control" name="target" value=<?php echo "\"".$idea_list[0]["target"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">定价</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="textarea" class="form-control" name="price" value=<?php echo "\"".$idea_list[0]["price"]."\"/>";?>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="idea_id" value=<?php echo "\"".$idea_list[0]["idea_id"]."\"/>";?>
                                    <input type="hidden" name="user_id" value=<?php echo "\"".$idea_list[0]["user_id"]."\"/>";?>
                                    <!-- 自定义项目结束-->
                </div>
            </div>
            <div class="form-actions">
            	<div class="row">
            		<div class="col-md-offset-3 col-md-9">
            			<input type="submit" class="btn red"/>
            			<button type="submit" class="btn green">Submit</button>
            			<button type="button" class="btn default">Cancel</button>
            		</div>
            	</div>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
</div>
			</div>
			<!-- END PAGE CONTENT-->
            </div>
        </div>
        <!-- END CONTENT -->

    </div>
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    <?php include 'inc_footer_bar.php'; ?>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <!-- BEGIN CORE PLUGINS -->
    <?php include 'inc_core_plugin.php'; ?>
    <!-- END CORE PLUGINS -->
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="./assets/global/plugins/select2/select2.min.js"></script>

    <!-- END PAGE LEVEL PLUGINS -->
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="./assets/global/scripts/metronic.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="./assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
    <script src="./assets/admin/pages/scripts/form-samples.js"></script>
    <script type="text/javascript" src="<?=BASE_URL?>js/simditor-all.min.js"></script>
    <script>
    jQuery(document).ready(function() {    
       // initiate layout and plugins
       Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        Demo.init(); // init demo features
       FormSamples.init();
    });
    var editor = new Simditor({
        textarea: $('#editor'),
         toolbar:  ['title', 'bold', 'italic', 'underline', 'strikethrough', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table',  'link', 'image', 'hr', '|', 'indent', 'outdent'],
    });
    </script>
    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>