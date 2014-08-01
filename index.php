<?php

require_once 'config.php';

require_once ROOT_PATH.'class/class_ad.php';

$ad = new class_ad();

$ad_show_list = $ad->get_show_list(3);

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title></title>
		<link rel="stylesheet" type="text/css" href="css/res.css"/>
		<link rel="stylesheet" type="text/css" href="css/layout.css"/>
		<link rel="stylesheet" type="text/css" href="css/skin.css"/>
		<script src="js/fs.js" type="text/javascript" charset="utf-8"></script>
	</head>
	<body>
		<header>
			
		</header>
		<div class="nav">
			<ul class="nav">
				<li>
					<a href="">
						首页
					</a>
				</li>
				<li>
					<a href="">
						关于设计
					</a>
				</li>
				<li>
					<a href="">
						设计视界
					</a>
				</li>
				<li>
					<a href="">
						理论学术
					</a>
				</li>
				<li>
					<a href="">
						设计咨询
					</a>
				</li>
				<li>
					<a href="">
						活动专区
					</a>
				</li>
				<li>
					<a href="">
						学术构建
					</a>
				</li>
			</ul>
		</div>
		<div class="content">
			<div class="block nonebg">
				<div class="bookleft">
					<h2>本期书刊</h2>
					<!--书刊封面-->
					<img src="images/book.jpg"/>
				</div>
				<div class="bookright">
					<!--轮播图-->
					<div class="gallery">
						<div id="slideshow">
							<div id="preview">
								<!--示例图片-->
                                                                <?php
                                                                foreach ($ad_show_list as $item) {
                                                                    if (eregi("^http", $item['img_url'])){
                                                                        $img_url = $item['img_url'];
                                                                    }else{
                                                                        $img_url = BASE_URL.$item['img_url'];
                                                                    }
                                                                    echo '<a href="'.$item['link'].'"><img src="'.$img_url.'"/></a>';
                                                                }
                                                                ?>
							</div>
						</div>
						<div class="click">
							<ul id="linklist">
							<li>
								<a href="#"></a>
							</li>
							<li>
								<a href="#"></a>
							</li>
							<li>
								<a href="#"></a>
							</li>
						</ul>
						</div>
					</div>
				</div>
			</div>
			<div class="block design">
				<h2>设计视界</h2>
				<div>
					<img src="images/2_1.jpg"/>
				</div>
				<div></div>
				<div></div>
					
				</div>
				<img src="images/2_2.jpg"/>
				<img src="images/2_3.jpg"/>
			</div>
			<div class="block">
				<h2>理论学术</h2>
			</div>
			<div class="block">
				<h2>活动专区</h2>
			</div>
			<div class="smallblock">
				<h2>学术研究构建单位</h2>
			</div>
			<div class="smallblock">
				<h2>全国理事会</h2>
			</div>
		</div>
		<div class="miniblock">
			<p>
				《设计》杂志（C） Copyright 2014 版权所有 京ICP备12003697号
			</p>
			<p>
				所有资料未经许可 不可复制转载
			</p>
		</div>
		<footer>
			<h2>
				友情链接
			</h2>
			<hr />

		</footer>
		<script>
			var preview = document.getElementById("preview");
			positionElement("preview", "relative", 0, 0);
			var list = document.getElementById("linklist");
			var links = list.getElementsByTagName("a");
			links[0].onmouseover = function() {
				moveElement("preview", 0, 0, 8);
			}
			links[1].onmouseover = function() {
				moveElement("preview", 0, -294, 8);
			}
			links[2].onmouseover = function() {
				moveElement("preview", 0, -591, 8);
			}

		</script>
	</body>
</html>
