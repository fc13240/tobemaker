
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<div class="page-sidebar navbar-collapse collapse">
			<!-- BEGIN SIDEBAR MENU -->
			<ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
				<li class="sidebar-toggler-wrapper">
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
					<div class="sidebar-toggler hidden-phone">
					</div>
					<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
				</li>
				<li class="sidebar-search-wrapper">
					<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
					<form class="sidebar-search" action="" method="POST">
						<div class="form-container">
							<div class="input-box">
								<a href="javascript:;" class="remove">
								</a>
								<input type="text" placeholder="Search..."/>
								<input type="button" class="submit" value=" "/>
							</div>
						</div>
					</form>
					<!-- END RESPONSIVE QUICK SEARCH FORM -->
				</li>
                                <li class="start <?= @$page_level[0] == 'dashboard' ? 'active' : '' ?> ">
					<a href="home.php">
						<i class="fa fa-home"></i>
						<span class="title">
							控制台
						</span>
					</a>
				</li>
                                <li class="<?= @$page_level[0] == 'idea' ? 'active' : '' ?>">
					<a href="javascript:;">
						<i class="fa fa-shopping-cart"></i>
						<span class="title">
							项目
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
                                                <li class="<?= @$page_level[1] == 'idea_list' ? 'active' : '' ?>">
							<a href="idea_list.php">
								项目列表
							</a>
						</li>
                                                <li class="<?= @$page_level[1] == '11' ? 'active' : '' ?>">
							<a href="#">
								审核项目
							</a>
						</li>
						<li>
							<a href="#">
								推荐项目
							</a>
						</li>
						<li>
							<a href="#">
								待产项目
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
						<i class="fa fa-shopping-cart"></i>
						<span class="title">
							商品
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="#">
								商品列表
							</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="javascript:;">
						<i class="fa fa-user"></i>
						<span class="title">
							用户
						</span>
						<span class="arrow ">
						</span>
					</a>
					<ul class="sub-menu">
						<li>
							<a href="#">
								用户列表
							</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- END SIDEBAR MENU -->
		</div>
	</div>
	<!-- END SIDEBAR -->