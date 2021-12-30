<!doctype html>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Twitter search demo</title>

<?php
use DG\Twitter\Twitter;

require_once './twitter-php-master/src/twitter.class.php';
require_once './config.php';

// ENTER HERE YOUR CREDENTIALS (see readme.txt)
$twitter = new Twitter(__CONSUMER_KEY__, __CONSUMER_SECRET__, __ACCESS_TOKEN__, __ACCESS_SECRET__);

$lines = file("tosearch", FILE_IGNORE_NEW_LINES);

foreach ($lines as $line) {
	
	echo "<br>#$line";
	if (trim($line) != "") {
		$results = $twitter->search("#". trim($line));
		// or use hashmap: $results = $twitter->search(['q' => '#nette', 'geocode' => '50.088224,15.975611,20km']);

		?>

		<ul>
		<?php foreach ($results as $status) { ?>
			<li><a href="https://twitter.com/<?php echo $status->user->screen_name ?>"><img height="48px" width="48x" src="<?php echo htmlspecialchars($status->user->profile_image_url_https) ?>">
				<?php echo htmlspecialchars($status->user->name) ?></a>:
				<?php echo Twitter::clickable($status) ?>
				<small>at <?php echo date('j.n.Y H:i', strtotime($status->created_at)) ?></small>
			</li>
		<?php } ?>
		</ul>
	<?php

	}
}
