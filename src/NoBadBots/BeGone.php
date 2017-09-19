<?php 

namespace NoBadBots;

class BeGone {

	public static $uas = ['headlesschrome','gotnoheadeua','nikto','sqlmap','curl','planetwork','purebot','pycurl','skygrid','sucker','turnit','vikspid','zmeu','zune','dotbot','feedfinder','flicky','ia_archiver','kmccrew','libwww','nutch','binlar','casper','checkprivacy','cmsworldmap','comodo','curious','diavol','doco','ZmEu','python'];
	public static $bips = ['178.79.138.22'];

	public static $badness = 0;

    public static function shoo() {

    	if(empty($_SERVER['HTTP_USER_AGENT'])) {
    		$_SERVER['HTTP_USER_AGENT'] = "gotnoheadeua";
    	}

    	if(empty($_SERVER['HTTP_USER_AGENT']) || strlen($_SERVER['HTTP_USER_AGENT']) <= 20){
    		self::$badness++;
    	}

    	foreach(self::$uas as $ua){
    		if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), $ua) !== false) {
    			self::$badness++;
    		}
    	}

    	if(!empty($_SERVER['REMOTE_ADDR'])){
    		foreach(self::$bips as $ip){
	    		if(self::getUserIP() == $ua) {
    				self::$badness = self::$badness + 2;
    			}
    		}
    	} else {
    		self::$badness++;
    	}

        if(http_response_code() == 404){
            self::$badness++;
        }

        return self::$badness;
    }

    public static function bomb(){
    	/* dd if=/dev/zero bs=1M count=10240 | gzip > 10G.gzip */
        header("Content-Encoding: gzip");
        header("Content-Length: ".filesize('10G.gzip'));
        if (ob_get_level()) ob_end_clean();
        readfile('10G.gzip');
	}

	public static function getUserIP() {
    	if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
	        if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
            	$addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
            	return trim($addr[0]);
        	} else {
	            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        	}
    	}
    	else {
	        return $_SERVER['REMOTE_ADDR'];
	    }
	}

    public static function get_http_response_code($theURL) {
        $headers = get_headers($theURL);
        return substr($headers[0], 9, 3);
    }

}
