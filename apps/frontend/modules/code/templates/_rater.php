<?php use_helper('jQuery', 'Number') ?>

<?php 
    $r_width = isset($rater_width) ? $rater_width : 100;
    $rater_update = isset($rater_update) ? $rater_update : 'update';
    $rater_url = isset($rater_url) ? $rater_url : 'rater/url';
?>

<style>
	.rater-part-highlighted {
		background-color: blue;
	}
	.rater-part {
		background-color: transparent;
	}
</style>

<script language="javascript">
	function highlightRater(order) {
		for(var i = 0; i < order + 1; i++)
			$('rater-part-' + i).className = 'rater-part-highlighted';
		for(var i = order + 1; i < <?php echo $rate_max ?>; i++)
			$('rater-part-' + i).className = 'rater-part';
		$('rater-rate-ind').innerHTML = order + 1;
	}
	function resetRater() {
		for(var i = 0; i < <?php echo $rate_max ?>; i++) {
			if(i < <?php echo round($rate_avg) ?>)
				$('rater-part-' + i).className = 'rater-part-highlighted';
			else
				$('rater-part-' + i).className = 'rater-part';
		}
		$('rater-rate-ind').innerHTML = '<?php echo round($rate_avg) ?>';
	}
</script>

<div class="rater-container" style="width: <?php echo $r_width ?>px;" id="rater-container">
	<div class="rater-info" style="width: 100%; height: 20px;">
		<div class="rater-rate" style="width:80%; float: left; text-align: left;">
		    <?php echo format_number($rate_avg) . ' out of #' . $rating_count . ' votes.' ?>
		</div>
		<div class="rater-rate-ind" id="rater-rate-ind" style="width:20%; float: right; text-align: right;">
		    <?php echo round($rate_avg) ?>
		</div>
	</div>
	<div class="rater-self"
		onmouseout="resetRater()" 
		style="width: 100%; height: 15px; border: solid 2px #CCCCCC;">
		<?php for($i = 0; $i < $rate_max; $i++): ?>
			<div id="rater-part-<?php echo $i ?>" class="rater-part<?php  echo $i < round($rate_avg) ? "-highlighted" : ""?>" 
				onmouseover="highlightRater(<?php echo $i ?>);"
				style="width: <?php echo round($r_width/$rate_max) ?>px; height: 15px; float: left;"
				onclick="<?php echo jq_remote_function(
				    array(
				        'update' => $rater_update,
				        'url' => $rater_url,
				        'with' => "'rate='+" . ($i+1)
				        //,'complete' => "window.alert($('rater-update').innerHTML);"
				    )
				) ?>"></div>
		<?php endfor; ?>
	</div>
</div>