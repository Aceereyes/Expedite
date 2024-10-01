<?php
    if(isset($base_url)) {
        function base_url($url = '') {
            global $base_url;
            return $base_url.$url;
        }
        function assets($url = '') {
            return base_url('assets/'.$url);
        }
        function images($url) {
            return assets().'images/'.$url;
        }
        function css($url) {
            return assets().'css/'.$url;
        }
        function js($url) {
            return assets().'js/'.$url;
        }
        function plugins($url) {
            return assets().'plugins/'.$url;
        }
        function uploads($url) {
            return base_url('uploads/'.$url);
        }
    }
	if(isset($device)) {
		function device() {
			global $device;
			return $device;
		}
		function userAgent() {
			return device()->getUserAgent();
		}
		function ipAddress() {
			return isset($_SERVER['HTTP_CLIENT_IP']) 
				? $_SERVER['HTTP_CLIENT_IP'] 
				: (isset($_SERVER['HTTP_X_FORWARDED_FOR']) 
				? $_SERVER['HTTP_X_FORWARDED_FOR'] 
				: $_SERVER['REMOTE_ADDR']);
		}
	}
    function refresh($time = 0) {
		echo '<meta http-equiv="refresh" content="'.$time.';">';
	}
	function redirect($location = '', $time = 0) {
		if(!empty($location))
			echo '<meta http-equiv="refresh" content="'.$time.';url='.$location.'">';
		else
			alert('Error! Use refresh function!');
	}
	function redirectNewTab($url, $time = 0) {
		$time = $time * 1000;
		echo '<script>
			setTimeout(function() {
				window.open("'.$url.'", "_blank");
			}, '.$time.');
	  </script>';
	}
	function alert($msg, $refresh = false) {
		echo '<script>alert("'.$msg.'");</script>';
		if($refresh) {
			refresh();
		}
	}
	function alertSwal($msg, $title = 'Success', $html = false, $icon = 'success', $script = true) {
		$msgIsHTML = ($html) ? 'html: \''.$msg.'\'' : 'text: \''.$msg.'\'';
		if($script) {
			echo '<script>$(document).ready(function() {';
		}
		echo '
			Swal.fire({
				icon: \''.$icon.'\',
				title: \''.$title.'\',
				'.$msgIsHTML.',
				showCancelButton: false, 
				showConfirmButton: false,
				customClass: {
					container: \'alert-swal\'
				}
			});';
		if($script) {
			echo '});</script>';
		}
	}
	function encrypt_decrypt($string, $action = 'encrypt')
	{
		$encrypt_method = "AES-256-CBC";
		$secret_key = config('app.private_key');
		$secret_iv = config('app.public_key');
		
		$key = hash('sha256', $secret_key);
		$iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
		if ($action == 'encrypt') {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if ($action == 'decrypt') {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
	function encrypt($string) {
		return encrypt_decrypt($string);
	}
	function decrypt($string) {
		return encrypt_decrypt($string, 'decrypt');
	}

	function setFlashMessage($icon, $title, array $other = [], $mixin = []) {
        $_SESSION['flash_message'] = ['icon' => sprintf("'%s'", $icon), 'title' => sprintf("'%s'", $title)];
        $_SESSION['flash_message'] = array_merge($_SESSION['flash_message'], $other);
		$_SESSION['flash_message']['mixin'] = array_merge([
			'toast' => "false",
			'position' => "'center'",
			'showConfirmButton' => 'false',
			'timerProgressBar' => 'true',
			'timer' => '3000'
		], $mixin);
		return $_SESSION['flash_message'];
	}
	function getFlashMessage() {
		$message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
		return $message;
	}
	function freelancer() {
		return $_SESSION['freelancer'];
	}
	function admin() {
		return $_SESSION['admin'];
	}
	function partner() {
		return $_SESSION['partner'];
	}
    function createUrl($url, array $parameters) {
        return $url.createUrlParameters($parameters);
    }
    function createUrlParameters(array $parameters) {
		return '?'.http_build_query($parameters);
    }
	function modal($fileName, $root = '') {
		include($root.'modals/'.$fileName.'.php');
	}
?>