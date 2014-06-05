
<?php
if($page['trends']) {
  ?>

<div class="row">
  <div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 ">
    <div class="panel panel-default" id="pagination-activity">
      <div class="panel-heading">
        <h3 class="panel-title"><i class="glyphicon glyphicon-stats"></i> <?php echo $lang['Trends'] ?></h3>
      </div>
      <div class="panel-body"></div>
      <table id="trends" ng-controller="trendCtrl" ng-table="tableParams" class="display" cellspacing="0" width="100%">

        <tbody>
          <tr ng-repeat="paste in $data">
            <td data-title="'#'"  sortable="'pid'">
            {{paste.pid}} 
            </td>
            <td data-title="'Name'" sortable="'title'">
              {{paste.title}} <div class="label label-info">{{paste.format}}</div>
            </td>
            <td data-title="'Hits'" sortable="'hits'">
              {{paste.hits}}
            </td>
            <td data-title="'Date'" sortable="'age'">
              {{paste.agefmt}}
            </td>
          </tr>
          <?php 
              //   foreach($page['trends'] as $idx=>$entry) {
            		// $expires = ((is_null($entry['expires'])) ? " (".$lang['Never Expires'].") " : (" - ".$lang['Expires on']." " . date("D, F jS @ g:ia", strtotime($entry['expires']))));
            		// echo '<tr>';
            		// 	echo '<td>'.$entry['agefmt'].'</td>';
            		// 	if ( $mod_rewrite == true ) { 
            		// 		echo '<td><a href="'. $CONF['url'] . $entry['pid'] . '">' . $entry['title'] . '</a></td>'; } else { 
            		// 		echo '<td><a href="'. $CONF['url'] .'paste.php?paste='. $entry['pid'].'">' . $entry['title'] . '</a></td>'; }
            		// 	echo '<td>'.$expires.'</td>';
            		// 	echo '<td>'.$entry['format'].'</td>';
            		// 	echo '<td>'.round($entry['hits']/2).'</td>';
            		// 	echo '<td>'.$entry['agefmt'].'</td>';
            		// echo '</tr>';
              //   }
          ?>

        </tbody>
      </table>
    </div>
  </div>
</div>
  <?php
} else {
  echo "no";
}
?>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('#trends').dataTable( {
            "language": {
                "url": "includes/lang/<?php echo $CONF['language'] ?>_datatables.lang"
            }
        } );
    } );
</script> -->