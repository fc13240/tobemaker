<div class="top">
    <div class="middle">
        <a href="index.php" target="_top" class="logo"><img src="asset/6.png" alt=""></a>
        <div class="nav">
            <ul>
                <li><a class=" <?= @$page_level[0] == 'share' ? 'active' : '' ?> " href="share.php" target="_top">分享</a></li>
                <li><a class=" <?= @$page_level[0] == 'project_list' ? 'active' : '' ?> " href="project_list.php" target="_top">项目</a></li>
                <li><a class=" <?= @$page_level[0] == 'comming' ? 'active' : '' ?> " href="comming.php" target="_top">待产</a></li>
                <li><a class=" <?= @$page_level[0] == 'shop' ? 'active' : '' ?> " href="shop.php" target="_top">商店</a></li>
                <br class="clear"/>
            </ul>

        </div>
        <div class="lgn">
            <a href="person.php" target="_top"><img src="asset/12.png" alt=""></a>
            <a href="#" target="_top"><img src="asset/1.png" alt=""></a>
        </div>
    </div>
</div>