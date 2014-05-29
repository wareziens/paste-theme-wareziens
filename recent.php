	<!-- Recent Pastes -->
<?php if(isset($page['recent']) && $page['recent'] !== false) { ?>
	<div class="col-md-4">
		<div class="panel panel-default" id="pagination-activity">
		  <div class="panel-heading">
	 	    <h3 class="panel-title"><i class="glyphicon glyphicon-time"></i> <?php echo $lang['Recent Pastes'] ?></h3>
		  </div>
		  <div class="list-group">
					<?php foreach($page['recent'] as $idx=>$entry) {
						//if this is the current watched paste
						if (isset($pid) && $entry['pid']==$pid) $cls="active";
						else $cls="";

						if ( $mod_rewrite == true )
							echo '<a href="'. $CONF['url'] . $entry['pid'] . '" class="list-group-item '.$cls.'">';
						else
							echo '<a href="'. $CONF['url'] .'paste.php?paste='. $entry['pid'].'" class="list-group-item '.$cls.'">'; 
						?>
							<small class="text-muted">&lt; &gt;</small> 
							<?php echo $entry['title']; ?> 

							<span class="badge"><?php echo $entry['agefmt'];?></span>
						</a>
					<?php } ?>
		  </div>
		</div>
	</div>

<?php } else { ?>

<div class="span4">
	<p>You'll paste the first paste! \o/ Lucky you!</p>
</div>

<?php } ?>
