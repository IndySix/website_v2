<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Ramped</title>
    
    <script src="<?PHP echo baseUrl('data/js/jquery-1.10.2.min.js') ?>"> jQuery.noConflict(); </script>
	<script src="<?PHP echo baseUrl('data/js/jquery-ui-1.10.3.custom.min.js') ?>"></script>
	<script src="<?PHP echo baseUrl('data/js/main.js') ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?PHP echo baseUrl('data/css/reset.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?PHP echo baseUrl('data/css/jquery-ui-1.10.3.custom.min.css') ?>">
	<link rel="stylesheet" type="text/css" href="<?PHP echo baseUrl('data/css/style.css') ?>">
</head>
<body>
    <div id="container">
        <div id="header">
            <div id="inner-header">
            	<?PHP if ($this->ModelLogin->isLoggedin()): ?>
                <a id="logo" href="#"><img src="<?PHP echo baseUrl('data/img/logo.png') ?>"></a>
                <ul id="menu">
                    <li><a href="<?PHP echo baseUrl('user') ?>">Profile</a></li>
                    <li><a href="<?PHP echo baseUrl('level') ?>">Career</a></li>
                    <li><a href="<?PHP echo baseUrl('user/battles') ?>">Battles</a></li>
                    <li><a href="<?PHP echo baseUrl('user/friends') ?>">Friends</a></li>
                    <li><a href="<?PHP echo baseUrl('videos') ?>">Video</a></li>
                    <li><a href="<?PHP echo baseUrl('ranking') ?>">Ranking</a></li>
                </ul>
                <ul id="header-items">
                    <li class="search">
                        <img id="searchBarButton" src="<?PHP echo baseUrl('data/img/search-icon.png'); ?>" width="16px" />
                        <form class="searchform" method="GET" action="<?PHP echo baseUrl('user/search') ?>">
                            <input id="searchBar" class="hide" name="search" type="text" placeholder="Search.."  autocomplete="off">
                        </form> 
                    </li>
                    <li class="profile">
                        <img class="avatar" src="<?PHP echo baseUrl('data/avatars/'.$this->LibSession->get('user_avatar')) ?>" height="24px" />
                        <p><a href="<?PHP echo baseUrl('user') ?>"><?PHP echo ucfirst( $this->LibSession->get('user_username') ) ?></a></p>
                        <a class="settings" id="settings-menu-button" href="javascript:void(0);"><img src="<?PHP echo baseUrl('data/img/settings.png'); ?>" width="20px"></a>
                        <div id="settings-menu" class="hide">
                            <a href="<?PHP echo baseUrl('user/edit') ?>">Edit profile</a>
                            <a href="#">Message</a>
                            <a href="<?PHP echo baseUrl('user/logout') ?>">Logout</a>
                        </div>
                        <a class="friends" id="friend-requests-button" href="javascript:void(0);">
                            <img src="<?PHP echo baseUrl('data/img/friends.png'); ?>" width="20px">
                            <span id="friend-requests-count">0</span>
                        </a>
                        <div id="friend-requests">
                            <p>No friend request</p>
                        </div>
                    </li>
                </ul>
                <?PHP elseif($this->controllerName.$this->controllerAction != "Userlogin"): ?>
                <a id="logo-login" href="#"><img src="<?PHP echo baseUrl('data/img/logo.png') ?>"></a>
                <form class="login" method="post" action="<?PHP echo baseUrl('user/login') ?>">
					<!-- <li><a href="<?PHP echo baseUrl('user/login') ?>">Login</a></li>
					<li><a href="<?PHP echo baseUrl('user/register') ?>">Register</a></li> -->
					<input type="text" name="username" placeholder="username">
					<input type="password" name="password" placeholder="password">
					<input class="submit" type="submit" name="login" value="login">
				</form>
				<?PHP else: ?>
                <a id="logo-login" href="#"><img src="<?PHP echo baseUrl('data/img/logo.png') ?>"></a>
				<div class="register" >
					<a href="<?PHP echo baseUrl('user/register') ?>">Register</a>
				</div>
				<?PHP endif; ?>
                <br style="clear:both"/>
            </div>
        </div>
            <a id="playButton" href="<?PHP echo baseUrl('?front=game') ?>">
                Play
            </a>
        <div id="content">
            <div id="content-title"><?PHP echo isset($this->contentTitle) ? $this->contentTitle : '';  ?></div>
            <div id="inner-content">