<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
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
                        <img id="searchBarButton" src="<?PHP echo baseUrl('data/css/images/search-icon.png'); ?>" width="16px" />
                        <form class="searchform" method="GET" action="<?PHP echo baseUrl('user/search') ?>">
                            <input id="searchBar" class="hide" name="search" type="text" placeholder="Search.."  autocomplete="off">
                        </form> 
                    </li>
                    <li class="profile">
                        <img class="avatar" src="<?PHP echo baseUrl('data/avatars/'.$this->LibSession->get('user_avatar')) ?>" height="24px" />
                        <p><?PHP echo ucfirst( $this->LibSession->get('user_username') ) ?></p>
                        <a class="settings" id="settings-menu-button" href="javascript:void(0);"><img src="<?PHP echo baseUrl('data/css/images/settings.png'); ?>" width="20px"></a>
                        <div id="settings-menu" class="hide">
                            <a href="#">Settings</a>
                            <a href="#">Message</a>
                            <a href="<?PHP echo baseUrl('user/logout') ?>">Logout</a>
                        </div>
                        <a class="friends" id="friend-requests-button" href="javascript:void(0);"><img src="<?PHP echo baseUrl('data/css/images/friends.png'); ?>" width="20px"></a>
                        <div id="friend-requests">
                            <p>No friend request</p>
                            <!-- <table cellsapcing="0" cellpadding="0">
                                <tr>
                                    <td><img src="img/avatar.png" width="20px"></td>
                                    <td>Krukas</td>
                                    <td><a class="accept" href="#">Accept</a></td>
                                    <td><a class="refuse" href="#">Refuse</a></td>
                                </tr>
                            </table> -->
                        </div>
                    </li>
                </ul>
                <?PHP else: ?>
				<ul id="menu">
					<li><a href="<?PHP echo baseUrl('user/login') ?>">Login</a></li>
					<li><a href="<?PHP echo baseUrl('user/register') ?>">Register</a></li>
				</ul>
				<?PHP endif; ?>
            </div>
        </div>
        <div id="content">
            <div id="content-title">Home</div>
            <div id="inner-content">