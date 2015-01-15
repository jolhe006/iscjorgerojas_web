<?php
error_reporting(E_ALL); @ini_set('display_errors', true);
	$pages = array(
		'0'	=> array('id' => '1', 'alias' => 'home', 'file' => '1.php')
	);
	$forms = array(

	);
	$base_dir = dirname(__FILE__);
	$base_url = '/';
	$show_comments = false;
	include dirname(__FILE__).'/functions.inc.php';
	$home_page = '1';
	$page_id = parse_uri();
	$user_key = "hrqNJnsX4E6/b7Nk/N9k9w==";
	$user_hash = "301716f6c8497061";
	$comment_callback = "http://uk.zyro.com/es-ES/comment_callback/";
	$preview = false;
	$mod_rewrite = true;
	$page = isset($pages[$page_id]) ? $pages[$page_id] : null;
	if (!is_null($page)) {
		handleComments($page['id']);
		if (isset($_POST["wb_form_id"])) handleForms($page['id']);
	}
	ob_start();
	if (isset($_REQUEST['view']) && $_REQUEST['view'] == 'news')
		include dirname(__FILE__).'/news.php';
	else if (isset($_REQUEST['view']) && $_REQUEST['view'] == 'blog')
		include dirname(__FILE__).'/blog.php';
	else if ($page) {
		$fl = dirname(__FILE__).'/'.$page['file'];
		if (is_file($fl)) {
			ob_start();
			include $fl;
			$out = ob_get_clean();
			$ga_out = '';
			if (is_file($ga_file = dirname(__FILE__).'/ga_code') && $ga_code = file_get_contents($ga_file)) {
				$ga_out = str_replace('{{ga_code}}', $ga_code, file_get_contents(dirname(__FILE__).'/ga.php'));
			}
			$out = str_replace('{{ga_code}}', $ga_out, $out);
			$out = str_replace('{{base_url}}', 'http://'.$_SERVER['HTTP_HOST'].'/', $out);
			header('Content-type: text/html; charset=utf-8', true);
			echo $out;
		}
	} else {
		header("Content-type: text/html; charset=utf-8", true, 404);
		echo "<!DOCTYPE html>\n";
		echo "<html>\n";
		echo "<head>\n";
		echo "<title>404 Not found</title>\n";
		echo "</head>\n";
		echo "<body>\n";
		echo "404 Not found\n";
		echo "</body>\n";
		echo "</html>";
}
	ob_end_flush();

?>