<?php
	function modsecSdbmUtilJson($cmdline) {
		foreach(array_filter(array_map('trim', explode("\n",shell_exec($cmdline)))) as $line){
			preg_match('/Key: "([^"]+)", Value len: [0-9]+/',$line,$matches);
			if(sizeof($matches) == 2){
				$key = $matches[1];
			} else {
				preg_match('/(.*): (.*)/',$line,$matches);
				if(sizeof($matches) == 3)
					$ret[$key][$matches[1]] = $matches[2];
			}
		}
		return json_encode($ret,JSON_PRETTY_PRINT);
	}

	print_r(modsecSdbmUtilJson("modsec-sdbm-util.exe -q -D . -d -u httpd-ip"));
?>