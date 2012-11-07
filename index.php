<?php
//ini_set('display_errors', 1);
include('alarm.php');
$poll = new Alarm();
?>
<html>
<head>
	
	<title>Election Alarm - Go to bed, we'll wake you up with a tweet when it's over</title>
	
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	
	<meta property="og:image" content="http://iainmullan.com/img/election-alarm.jpg" />
	
</head>
<body>
	<?php include('fork.php'); ?>
	
	
	<div id="content">
		<h1>Election Alarm</h1>
		<h2>Go to bed, we'll wake you up with a tweet when it's over</h2>
		
		<div class="mid">270</div>
		
		<div class="scores">
		<?php
		$sources = array('bbc');
	
		foreach($sources as $s) {
			$scores = $poll->get($s);

			$dem = $scores['dem'];
			$rep = $scores['rep'];

			$demPct = floor(($dem / 538) * 960) - 1;
			$repPct = floor(($rep / 538) * 960) - 1;
			?>
			<div class="source">
				
				<div class="score dem">
					<div class="bar" style="width: <?php echo $demPct; ?>px"><?php echo $dem; ?></div>
				</div>

				<div class="score rep">
					<div class="bar" style="width:<?php echo $repPct; ?>px"><?php echo $rep; ?></div>
				</div>

			</div>
			<?php
		}
		?>
		</div>
		
		<br class="clear" />

		<div id="signup">
			<h3>Follow @ElectionAlarm and we'll tweet you as soon as there's a winner</h3>

			<a href="https://twitter.com/ElectionAlarm" class="twitter-follow-button" data-show-count="false" data-size="large">Follow @ElectionAlarm</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
			
		</div>
		

	</div>
	<div id="footer">
		a bedtime-inspired hack by <a href="http://www.iainmullan.com">Iain Mullan</a>
	</div>

</body>
</html>
