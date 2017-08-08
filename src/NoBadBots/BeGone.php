<?php 

namespace NoBadBots;

class BeGone {

	public static $uas = ['headlesschrome','gotnoheadeua','nikto','sqlmap','curl','planetwork','purebot','pycurl','skygrid','sucker','turnit','vikspid','zmeu','zune','dotbot','feedfinder','flicky','ia_archiver','kmccrew','libwww','nutch','binlar','casper','checkprivacy','cmsworldmap','comodo','curious','diavol','doco','ZmEu','python'];

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

        return self::$badness;
    }

    public static function bomb(){
    	/* dd if=/dev/zero bs=1M count=10240 | gzip > 10G.gzip */
        header("Content-Encoding: gzip");
        header("Content-Length: ".filesize('10G.gzip'));
        if (ob_get_level()) ob_end_clean();
        readfile('10G.gzip');
	}
}