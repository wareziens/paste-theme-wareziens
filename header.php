<?php
//replacing some variables 
if($CONF['language'] == 'french')
	//the dude that has developped that didn't knew about <meta charset="utf-8">...
	$lang['Info text selected'] = 'Le texte a &eacute;t&eacute; copi&eacute; !';
else
	$lang['Info text selected'] = 'Text copied to clipboard!';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $page['title'];?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
  	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,600,300' rel='stylesheet' type='text/css'> 
  	<link href='<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/dist/css/main.css' rel='stylesheet' type="text/css">	
  	<link href='<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/dist/css/highlight/tomorrow-night-eighties.css' rel='stylesheet' type="text/css">	
  	<?php
	if (isset($page['post']['codecss'])) { 
		echo '<style type="text/css">'."\n";
		echo $page['post']['codecss'];
		echo '</style>'."\n";}
	?>

	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/dist/js/vendor.js"></script>
	<script src="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/dist/js/main.js"></script>

	<!-- IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $CONF['url'] . 'templates/' . $CONF['template']?>/img/favicon.ico">
</head>
<body ng-app="paste">

<!-- modal.php_ a intégrer --> 
<div class="container">

	<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="nav">
		<div class="container-fluid">
	    <div class="navbar-header">
	      <button ng-click="hasNavbar = !hasNavbar" type="button" class="navbar-toggle">
	        <span class="sr-only">Toggle navigation</span>
	        <!-- This markup really sucks! -->
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="">Paste</a>
	    </div>
	    <div class="navbar-collapse collapse" collapse="hasNavbar">
	      <ul class="nav navbar-nav">
					<li><a href="<?php echo $CONF['url'];?>"><i class="glyphicon glyphicon-file"></i> <?php echo $lang['Submit'] ?></a></li>
					<li><?php if ( $mod_rewrite == true ) { echo '<a href="'. $CONF['url'] .'trending">'; } else { echo '<a href="'. $CONF['url'] .'trends.php">'; } ?><i class="glyphicon glyphicon-stats"></i> <?php echo $lang['Trending'] ?></a></li>
				</ul>
				
				<ul class="nav navbar-nav navbar-right">
					<li>
							<form class="navbar-form" role="form" action="search.php" method="get" ng-controller="searchCtrl">
								<input typeahead="state for state in states | limitTo:10" type="text" class="form-control" name="search" ng-model="search" placeholder="<?php echo $lang['Search'] ?>">
							</form>
						</li>
			      <li>
			     	 <a href="#login">Sign In</a>
					  </li>
			     <li class="dropdown">
			      <!-- Single button -->
				      <a class="dropdown-toggle">
				        Soyuka <span class="caret"></span>
				      </a>
				      <ul class="dropdown-menu" role="menu">

								<li><a href="#"><i class="glyphicon glyphicon-user"></i> <?php echo $lang['Profile'] ?></a></li>
								<li><a href="#settings" data-toggle="modal"><i class="glyphicon glyphicon-cog"></i> <?php echo $lang['Settings'] ?></a></li>
								<li><a href="#mypastes" data-toggle="modal"><i class="glyphicon glyphicon-envelope"></i> <?php echo $lang['My Pastes'] ?></a></li>
								<li class="divider"></li>
								<li><a href="#"><i class="glyphicon glyphicon-off"></i> <?php echo $lang['Logout'] ?></a></li>

				      </ul>
					</li>
				</ul>
	    </div><!--/.nav-collapse -->
	  </div>
	</div>
</div>