<?php
function checkArrayIsNull($arr) {
	foreach ($arr as $key => $value) {
		if (empty($value)) {
			return 1;
		} else {
			continue;
		}
	}
	return 0;
}
function checkVerify($code, $id = "") {
	$verify = new \Think\Verify();
    return $verify->check($code, $id);
}
function checkEmail($email) {
	if (preg_match('/^[A-Za-z0-9-_.+%]+@[A-Za-z0-9-.]+\.[A-Za-z]{2,4}$/',$email)) {
	    return true;
	} else {
		return false;
	}
}
