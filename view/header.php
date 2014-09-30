<div class="top">
    <div class="middle">
        <a href="index.php" target="_top" class="logo"><img src="asset/6.png" alt=""><span class="beta">beta</span></a>
        
        <div class="nav">
            <ul>
                <li><a class=" <?= @$page_level[0] == 'share' ? 'active' : '' ?> " href="share.php" target="_top">分享</a></li>
                <li><a class=" <?= @$page_level[0] == 'project_list' ? 'active' : '' ?> " href="project_list.php" target="_top">项目</a></li>
                <li><a class=" <?= @$page_level[0] == 'comming' ? 'active' : '' ?> " href="comming.php" target="_top">待产</a></li>
                <li><a class=" <?= @$page_level[0] == 'shop' ? 'active' : '' ?> " href="shop.php" target="_top">商店</a></li>
                <li><a class=" <?= @$page_level[0] == 'activity' ? 'active' : '' ?> " href="activity.php" target="_top">活动</a></li>
                <br class="clear"/>
            </ul>

        </div>
        <div class="lgn">
            <a href="person.php" target="_top" id="minebtn"><img class="circle" src="<?php echo $current_user['head_url'] == '' ? 'asset/12.png' : $current_user['head_url']; ?>?imageMogr/v2/thumbnail/22x22!" alt="<?=$current_user['user_name']?>"></a>
            <!--<div id="sb-search" class="sb-search">
                <form action="project_list.php">
                    <input class="sb-search-input" placeholder="搜索项目" type="search" name="search" id="search">
                    <input class="sb-search-submit" type="submit" value="">
                    <span class="sb-icon-search"></span>
                </form>
            </div>-->
            <a href="" style="margin-top: 21px;margin-right: 20px;"><i class="fa fa-search" style="z-index: 100;position: relative;"></i></a>	
            <input class="search--input" type="search" name="" id="" value="" />
        	
        </div>
        <div class="lgnhover">
            <a href="<?=BASE_URL.'attention.php?type=from_me'?>">关注</a>
            <span>|</span>
            <a href="<?=BASE_URL.'attention.php?type=to_me'?>">粉丝</a>
            <span>|</span>
            <a href="<?=BASE_URL.'msg.php'?>">私信</a>
            <span>|</span>
            <a href="<?=BASE_URL.'logout.php'?>">注销</a>
        </div>
    </div>
</div>