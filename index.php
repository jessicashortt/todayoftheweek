<?php
	require_once('functions.php');
	session_start();
	$date = $_SESSION['day'];
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
  		<title>Today of the Week</title>
  		<meta name="author" content="Jessica Shortt">
  		<meta name="description" content="This app will take the current day and show all search results with that word.">

  		<!-- stylesheets and fonts -->
  		<link rel="stylesheet" href="css/style.css" type="text/css">
  		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700' rel='stylesheet' type='text/css'>
  		<link href='http://fonts.googleapis.com/css?family=Source+Code+Pro:300,400,500,600' rel='stylesheet' type='text/css'>
  		
  		<!-- javascript -->
  		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
  		<script src="scripts.js" type="text/javascript"></script>
 	</head>
 	<body>
 	<header>
 		<h1>Today of the week</h1>
 		<h2>Hello, <?php echo date(l); ?>.</h2>
 	</header>
 	<section class="main">
 		
  		<?php 
  			$query = array(
  				"q" => $date,
  				"count" => "100",
  			);

  			$results = search($query);

			
	  			foreach($results->statuses as $result) {



	  				echo "<div class='tweet'>";
	  				echo "<div class='profile_img'><img src='" . $result->user->profile_image_url . "'></div>";
	  				echo "<h4>". $result->user->name . " <span>@" . $result->user->screen_name . "</span></h4>";

	  				$result->text = twitterify($result);

	  				echo "<p>" . $result->text;
	  				if (isset($result->entities->media[0])) {
	  					foreach ($result->entities->media as $key ) {
	  						echo "<img src='" . $key->media_url . "'>";
	  					}
	  				}
	  				echo "</p>";
	  				$date = strtotime($result->created_at);
	  				echo "<span class='date'>Tweeted at " . date('g:iA', $date);
	  				if ($result->user->location != "") 
	  					echo " from " . $result->user->location;
	  				echo "</span>";
	  				echo "</div>";

	  				if (isset($result->in_reply_to_status_id)) {
	  					echo "<span class='reply-msg'> In reply to: </span>";
	  					echo "<div class='tweet-reply'>";

	  					$query = array (
	  						"id" => $result->in_reply_to_status_id,
	  					);
	  					$reply = get_tweet_by_id($query);
	  					
	  					echo "<div class='profile_img'><img src='" . $reply->user->profile_image_url . "'></div>";
		  				echo "<h4>". $reply->user->name . " <span>@" . $reply->user->screen_name . "</span></h4>";

		  				$reply->text = twitterify($reply);

		  				echo "<p>" . $reply->text;
		  				if (isset($reply->entities->media[0])) {
		  					foreach ($reply->entities->media as $key ) {
		  						echo "<img src='" . $key->media_url . "'>";
		  					}
		  				}
		  				echo "</p>";
		  				$date = strtotime($result->created_at);
		  				echo "<span class='date'>Tweeted at " . date('g:iA', $date);
		  				if ($result->user->location != "") 
		  					echo " from " . $result->user->location;
		  				echo "</span>";
		  				echo "</div>";

	  				}



	  				
	  			}

  			?>
  	</section>
  	<footer>
  		<p>created by <a href="http://jessicashortt.com" title="">jessica shortt</a> \ <a href="http://twitter.com/_jessicashortt" title="">@_jessicashortt</a></p>	
  	</footer>


  
 	</body>
</html>