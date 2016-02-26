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
