<?php
class unlin {
	function del_img($file) {
		$yes = unlink($file);
		if($yes == true)
		{
			return true; 
		}
	}
}