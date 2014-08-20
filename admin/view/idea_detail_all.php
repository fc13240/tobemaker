
        <!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn blue">Save changes</button>
							<button type="button" class="btn default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
						THEME COLOR </span>
						<ul>
							<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
							</li>
							<li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue">
							</li>
							<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
							</li>
							<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
							</li>
							<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
							</li>
							<li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
						Layout </span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Header </span>
						<select class="page-header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Mode</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Menu </span>
						<select class="sidebar-menu-option form-control input-small">
							<option value="accordion" selected="selected">Accordion</option>
							<option value="hover">Hover</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Style </span>
						<select class="sidebar-style-option form-control input-small">
							<option value="default" selected="selected">Default</option>
							<option value="light">Light</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Position </span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Footer </span>
						<select class="page-footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			项目详情
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="index.php">首页</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">项目</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">项目详情</a>
					</li>
				</ul>
				<div class="page-toolbar">
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<a href="#">Action</a>
							</li>
							<li>
								<a href="#">Another action</a>
							</li>
							<li>
								<a href="#">Something else here</a>
							</li>
							<li class="divider">
							</li>
							<li>
								<a href="#">Separated link</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER-->
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
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <input type="textarea" class="form-control" name="content" value=<?php echo "\"".$idea_list[0]["content"]."\"/>";?>
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