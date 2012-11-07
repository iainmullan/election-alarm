<?php
//ini_set('display_errors', 1);
include('alarm.php');
$poll = new Alarm();
?>
<html>
<head>
	
	<title>Election Alarm - Go to bed, we'll wake you up with a tweet when it's over</title>
	
	<link rel="stylesheet" href="css/style.css" type="text/css" />
	
	<meta property="og:image" content="http://iainmullan.com/election-alarm/img/election-alarm.jpg" />
	<meta property="og:url" content="http://iainmullan.com/election-alarm/" />
	<meta property="og:title" content="Election Alarm - Go to bed, we'll wake you up with a tweet when it's over" />
	
	<meta property="fb:admins" content="714655333" />
	
</head>
<body>
	
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId=266192196816674";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	
	
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
		
		<div id="social">
			<div class="fb-like" data-href="http://iainmullan.com/election-alarm/" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
			
			<br/>
			
			<div class="tweet-button"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://iainmullan.com/election-alarm/" data-via="ElectionAlarm" data-related="iainmullan">Tweet</a>
				</div>
		</div>

	</div>
	<div id="footer">
		a bedtime-inspired hack by <a href="http://www.iainmullan.com">Iain Mullan</a>
	</div>

</body>
</html>
