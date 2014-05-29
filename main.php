<div class="container" ng-controller="pasteCtrl">
	<div class="row">

<?php
// Show errors
if (count($pastebin->errors)) { 
	echo '<div class="alert alert-error">';
	foreach($pastebin->errors as $err) { echo '<i class="icon-exclamation-sign"></i> ' . htmlspecialchars($err) . ' </div>'; }
$page['post']['editcode']=$_POST['code2'];
$page['current_format']=$_POST['format'];
$page['expiry']=$_POST['expiry'];
	if ($_POST['password'] != 'EMPTY') { $page['post']['password']=$_POST['password']; }
$page['title']="";
if(isset($_POST['title'])){ $page['title']=$_POST['title']; }

}

// Show a paste
function showMe() {
	global $sep;
	global $page;
	global $post;
	global $followups;
	global $CONF;
	global $lang;
	
	if (strlen($page['post']['posttitle'])) { 

?>

	<div class="col-md-12">
		<div class="alert alert-success" id="copied" ng-init="copied = false" ng-hide="!copied">
			<?php echo $lang['Info text selected'] ?>
		  <button type="button" class="close" ng-click="copied = !copied" aria-hidden="true">&times;</button>
		</div>

		<div class="panel panel-default">
			<div class="panel-heading">

			  <div class="btn-group">
					<a class="btn" href="<?php echo $CONF['url'] ?>"><i class="glyphicon glyphicon-file"></i> <?php echo $lang['New Paste'] ?></a>
					<a class="btn" href="<?php echo $page['post']['downloadurl'] ?>"><i class="glyphicon glyphicon-download-alt"></i> <?php echo $lang['Download'] ?></a>
					<!-- <a class="btn" href="javascript:togglev();" title="Show/Hide line numbers"><i class="icon-list-ul"></i></a> -->
					<a class="btn" href="#" clip-copy="getTextToCopy()" clip-click="copied = !copied" class="copyme" title="<?php echo $lang['Copy text'] ?>"><i class="glyphicon glyphicon-list-alt"></i> <?php echo $lang['Copy text'] ?></a>
			  </div>
			</div>
		  <div class="panel-body">

				<h1><?php echo $page['post']['posttitle'] ?> <small><?php echo $page['post']['postdate']; ?></small></h1>
				<?php 

					echo $lang['Views'].': ' . round($page['post']['hits']/2);

					if ($page['post']['parent_pid']>0) {
						echo ' - '.$lang['Modified'].' -  <a href="' . $page['post']['parent_url'] . '" title="'.$lang['View original post'].'">' . htmlspecialchars($page['post']['parent_title']) . '</a>".';
					}

					$followups=count($page['post']['followups']);
					if ($followups) { 
						echo ' - '.$lang['Newer'];
						$sep="";
						foreach($page['post']['followups'] as $idx=>$followup) {
							echo $sep . '<a title="'.$lang['Posted on'].' ' . htmlspecialchars($followup['postfmt']) . '" href="' . $followup['followup_url'] . '">"' . htmlspecialchars($followup['title']) . '"</a>';
							$sep=($idx<($followups-2))?", ":" ".$lang['and']." ";
						}
					}
				 ?> 

				<pre highlight="<?php echo strtolower(htmlspecialchars($page['post']['format'])); ?>"><!-- 
					 --><span class="code-header"><?php echo htmlspecialchars($page['post']['format']); ?></span><!-- 
					 --><code><?php echo $page['post']['code'];?></code>
				</pre>
<!--
				@Todo: ADD THIS
 				<div style="float:right; padding-bottom: 5px;">
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-5250e0924bc5b486"></script>
					<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
					<a class="addthis_button_tweet"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
					<a class="addthis_counter addthis_pill_style"></a>
				</div>
 -->		

 			</div>
		</div>
	</div>

		<?php }
		} // End showing of a paste

		// Check for a password
		$postPass = null;
		if(isset($_POST['password'])){ $postPass = $_POST['password']; }

		if (isset($pid) && $pid >0) {
			global $pid;
		    $result = $pastebin->getPaste($pid);
		    $pass = $result['password'];

		if (isset($pass) && ($pass != "EMPTY")) { if (!isset($postPass)) { ?>
					
		<div class="col-md-12">

			<div class="panel panel-default">
		
				<div class="panel-heading">
					<h4><?php echo $lang['Password protected'] ?></h4>
				</div>
			  <div class="panel-body">
					<form class="form-horizontal" method="post" action="./?paste=<?php echo $pid; ?>">
		
						<div class="form-group">
					    <label for="password" class="col-sm-2 control-label"><?php echo $lang['Password'] ?></label>
					    <div class="col-sm-10">
					      <input type="password" class="form-control" id="password" name="password" placeholder="<?php echo $lang['Password'] ?>">
					    </div>
					  </div>
						<div class="form-group">
					    <div class="col-sm-offset-2 col-sm-10">
					      <button type="submit" class="btn btn-primary"><?php echo $lang['Show'] ?></button>
					    </div>
					  </div>
					</form>
				</div>

			</div>
		</div>

		<?php } else if (sha1($postPass) == $pass) { showMe(); } else { ?>
		
			<div class="alert alert-danger">
				<i class="glyphicon glyphicon-warning-sign"></i> <?php echo $lang['Password incorrect'] ?> <a href="#tryagain" onClick="history.go(-1); return false;"><?php echo $lang['Try again'] ?></a></i>
			</div>

		<?php }
			} else { showMe(); }
		}; // End showing paste

?>
<?php
	if (isset($keywords)) {
		global $keywords;
?>
		<div class="col-md-4">
			<div class="panel panel-default">
			  <div class="panel-heading">
		 	    <h3 class="panel-title"><i class="glyphicon glyphicon-pencil"></i> <?php echo $lang['Recent Pastes'] ?></h3>
			  </div>
			  <ul class="list-group">


					<?php foreach($page['search'] as $idx=>$entry) {
						if (isset($pid) && $entry['pid']==$pid) $cls="selected";
						else $cls="";?>
						<li class="list-group-item <?php echo $cls;?>">
							<small class="text-muted">&lt; &gt;</small> 
								<?php 
								if ( $mod_rewrite == true ) { 
									echo '<a href="'. $CONF['url'] . $entry['pid'] . '">' . $entry['title'] . '</a>'; 
								} else { 
									echo '<a href="'. $CONF['url'] .'paste.php?paste='. $entry['pid'].'">' . $entry['title'] . '</a>'; 
								} ?>
							<span class="badge"><?php echo $entry['agefmt'];?></span>
						</li>
					<?php } ?>
				</ul>
			</div>
		</div>
<?php
} // End recent pastes

//Paste area
if (!isset($keywords) && !(isset($pass) && (sha1($postPass) !== $pass)) || (isset($pass) && $pass == "EMPTY")) {
?>
	<form name="editor" method="post" action="paste.php" class="paster">
		<input type="hidden" name="parent_pid" value="<?php if(isset($page['post']['pid'])){echo $page['post']['pid'];} ?>"/>

		<div class="col-md-8">
			<div class="panel panel-default">
			  <div class="panel-heading">
		 	    <h3 class="panel-title"><i class="glyphicon glyphicon-edit"></i>  <?php echo $lang['New Paste'] ?></h3>
			  </div>
			  <div class="panel-body">
				  <div class="form-group">
				 		<div class="row">
				 			<div class="col-md-8">
						 		<select class="form-control" name="format">		
						  <?php // Show popular GeSHi formats
								foreach ($CONF['geshiformats'] as $code=>$name)
								{
									if (in_array($code, $CONF['popular_formats']))
									{
										$sel=($code==$page['current_format'])?'selected="selected"':' ';
										echo '<option ' . $sel . 'value="' . $code . '">' . $name . '</option>';
									}
								}

								echo '<option value="text">------------------------------</option>';

								// Show all GeSHi formats.
								foreach ($CONF['geshiformats'] as $code=>$name)
								{
										$sel=($code==$page['current_format'])?'selected="selected"':' ';
									if (in_array($code, $CONF['popular_formats']))
										$sel="";
										echo '<option ' . $sel . 'value="' . $code . '">' . $name . '</option>';
								}
							?>
								</select>
							</div>
						</div>
			 		</div>
			 		<div class="form-group">
						<textarea class="form-control" rows="3" id="code_textarea" name="code2" ><?php //onkeydown="return catchTab(this,event)"
							if(isset($page['post']['editcode'])){echo htmlspecialchars($page['post']['editcode']);} 
						?></textarea>
			 		</div>
			  </div>
		  </div>
		</div>

				<?php include('recent.php'); ?>

		<div class="col-md-8">
			<div class="panel panel-default">
			  <div class="panel-heading">
		 	    <h3 class="panel-title"><i class="glyphicon glyphicon-cog"></i>   <?php echo $lang['Paste Options'] ?></h3>
			  </div>
			  <div class="panel-body form-horizontal">
					<div class="form-group">
						<label class="col-sm-3 control-label" for="title"><?php echo $lang['Paste Title'] ?></label>
				    <div class="col-sm-9">
				      <input type="text" maxlength="24" class="form-control" name="title" id="title" placeholder="<?php echo $lang['Paste Title'] ?>" value="<?php 
                $page['title']="";
                if(isset($_POST['title'])){ $page['title']=$_POST['title']; }
                echo $page['title'] ?>">    
				    </div>
				  </div>
				  <div class="form-group">
						<label class="col-sm-3 control-label" for="password"><?php echo $lang['Password'] ?></label>
				    <div class="col-sm-9">
							<input class="form-control" type="password" placeholder="<?php echo $lang['Password'] ?>" value="<?php if (isset($postPass) && strcmp($postPass,'EMPTY') != 0) { echo $postPass; } else { echo ''; } ?>" id="password" name="password">    
					  </div>
				  </div>
				  <div class="form-group">
						<label class="col-sm-3 control-label" for="expiration"><?php echo $lang['Paste Expiration'] ?></label>
				    <div class="col-sm-9">
							<select name="expiry" id="expiration" class="form-control" tabindex="1">
								<option id="expiry_forever" value="f" <?php if ($page['expiry']=='f') echo 'selected="selected"'; ?>><?php echo $lang['None'] ?></option>
								<option id="expiry_day" value="d" <?php if ($page['expiry']=='d') echo 'selected="selected"'; ?>><?php echo $lang['One Day'] ?></option>
								<option id="expiry_month" value="m" <?php if ($page['expiry']=='m') echo 'selected="selected"'; ?>><?php echo $lang['One Month'] ?></option>
							</select>
					  </div>
				  </div>
				  <div class="form-group">
				    <div class="col-sm-offset-3 col-sm-10">
				      <button type="submit" class="btn btn-default btn-primary" name="paste"><?php echo $lang['Submit'] ?></button>
				    </div>
				  </div>
			  </div>
			</div>
		</div>
		<!-- Options -->
				<?php 
				/**
				 * @todo include recaptcha
			*
			*		<div class="form-actions">
			*		<?php if ($CONF['useRecaptcha']) { require_once('includes/libraries/recaptchalib.php'); ?>
			*			<p><?php echo $lang['Info ReCaptcha'] ?>
			*			<!-- reCAPTCHA -->
			*			<!-- Quick hack to maintain responsiveness -->
			*			<script src="includes/recaptcha_mobile.min.js"></script>
			*			<script> var RecaptchaOptions = { theme : 'clean' }; </script>
			*			<?php echo recaptcha_get_html($CONF['pubkey'])."\n"; ?><br />
			*			<?php } ?>
			*			<button class="btn" type="submit" name="paste"><i class="icon-arrow-right"></i> <?php echo $lang['Submit'] ?></button></p>
			*		</div>
			**/
			?>

	</form>   

</div> 
<?php } ?>

	</div>
</div>