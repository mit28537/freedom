<?php
mb_language("ja");
mb_internal_encoding("UTF-8");

$config = [
		"app"       => [
						"app_title"		=> "フリーえんじにゃ～",
						"session_key"	=> "mit",
						],
		"database"  => [
						"dsn" 			=> 'mysql:dbname=employment;host=localhost',
						"user"			=> 'root',
						"password"		=> '',
						],
		"mail"       => [
						"mail_from"		=> "k-tamaki@k-mit.jp",
						"mail_cc"		=> "k-tamaki@k-mit.jp",
						"mail_bcc"		=> "k-tamaki@k-mit.jp",
						"mail_subject"	=> "てすとメール",
						],

];
