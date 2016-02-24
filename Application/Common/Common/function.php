<?php
function checkPermission($uid) {
	if ($uid != session('uid')) {
		redirect('../../../Index/index', 5, 'Permission denied!');
		return false;
	} else {
		return true;
	}
}
