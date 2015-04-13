<?php
	require_once("lib/twitteroauth/autoload.php");
	use Abraham\TwitterOAuth\TwitterOAuth;
	require_once('token-secret.php');


	 // retrieves tweets that contain a queried term
	function search(array $query)
	{
	  $toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
	  return $toa->get('search/tweets', $query);
	}


	// retrieves a tweet based on an inputted id
	function get_tweet_by_id(array $query)
	{
	 	$toa = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
		return $toa->get('statuses/show', $query);
	}



	// regex for hashtags, links, @'s etc.
	function twitterify($item) {
		$item->text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@','<a href="$1">$1</a>',$item->text);
		$item->text = preg_replace("/(?<!\w)#\w+/", "<a target=\"_blank\"href=\"http://twitter.com/$1\">$0</a>", $item->text);
		$item->text = preg_replace("/@(\w+)/i", "<a target=\"_blank\"href=\"http://twitter.com/$1\">$0</a>", $item->text);

		return $item->text;

	}
