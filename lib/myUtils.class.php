<?php
class myUtils {
    
	public static function extractSummary($body, $min, $total) {
		$summaries = self::extractSummaryArray($body, $min, $total);
		$rtn = "";
		foreach($summaries as $summary) {
			$rtn .= "$summary... ";
		}
		return $rtn;
	}
	
    public static function extractSummaryArray($body, $min, $total) {
        
    	//replace whitespaces with space
        $body = preg_replace("/(\\r?\\n[ \\t]*)+/", " ", $body);
        
        //find paragraphs
        $matches = array();
        preg_match_all("/<p>(.+)<\/p>/isU", $body, $matches, PREG_SET_ORDER);
        
        //put paragraphs to a fresh array and calculate total length
        $total_length = 0;
        $paragraphs = array();
        foreach($matches as $match) {
        	$len = 0;
        	if(($len = strlen($match[1])) > $min) {
        		$paragraphs[] = $match[1];
        		$total_length += strlen($match[1]);
        	}
        }
		
        //chop paragraphs
        sfLoader::loadHelpers('Text');
        $final = array();
        for($i = 0; $i < sizeof($paragraphs); $i++) {
        	$share = (int)($total * strlen($paragraphs[$i]) / $total_length);
        	if($share < $min) {
        		$total_length -= strlen($paragraphs[$i]);
        		continue;
        	}
            $final[] = truncate_text($paragraphs[$i], $share, "", true);
        }

        return $final;
        
    }
    
    public static function isUserRecord($class_name, $record_id, $user_id) {
        $class = new ReflectionClass($class_name);
        $c = new Criteria();
        $c->add($class->getConstant('SF_GUARD_USER_ID'), $user_id);
        $c->add($class->getConstant('ID'), $record_id);
        $record = $class->getMethod('doSelectOne')->invoke(null, $c);
        return $record != null;
    }

  public static function item($array, $i)
  {
    return $array[$i];
  }
}
?>