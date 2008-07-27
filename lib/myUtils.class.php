<?php
class myUtils {
    
    public static function highlight($raw_body)
    {
        $body = sfMarkdown::doConvert($raw_body);
        $matches = array();
        $langs = array();
        preg_match_all("/<pre><code>\[(\w*)\](\\r?\\n)+(.+)(\\r?\\n)+<\/code><\/pre>/isU", $body, $matches, PREG_SET_ORDER);
        if(sizeof($matches) > 0) {
            $service = new SnippetServiceClient();
            $cnt = 1;
            foreach($matches as $match)
            {
            	sfLogger::getInstance()->info("From myUtils: " . $match[3]);
                if(strtoupper($match[1]) == 'JAVA')
                {
                    $highlighted = $service->highlight('JAVA', htmlspecialchars_decode($match[3]));
                    $highlighted['snippet'] = "<div class=\"code-wrapper\">{$highlighted['snippet']}</div>";
                    $body = str_replace($match[0], $highlighted['snippet'], $body, $cnt);
                    $langs['java'] = $langs['java'] ? ($langs['java'] + 1) : 1;
                } else if(strtoupper($match[1]) == 'PHP')
                {
                    $highlighted = $service->highlight('PHP', htmlspecialchars_decode($match[3]));
                    $highlighted['snippet'] = "<div class=\"code-wrapper\">{$highlighted['snippet']}</div>";
                    $body = str_replace($match[0], $highlighted['snippet'], $body, $cnt);
                    $langs['php'] = $langs['php'] ? ($langs['php'] + 1) : 1;
                } else if(strtoupper($match[1]) == 'C')
                {
                    $highlighted = $service->highlight('C', htmlspecialchars_decode($match[3]));
                    $highlighted['snippet'] = "<div class=\"code-wrapper\">{$highlighted['snippet']}</div>";
                    $body = str_replace($match[0], $highlighted['snippet'], $body, $cnt);
                    $langs['c'] = $langs['c'] ? ($langs['c'] + 1) : 1;
                } else 
                {
                    $lang = strtolower($match[1]);
                    $langs[$lang] = $langs[$lang] ? ($langs[$lang] + 1) : 1;
                    $body = str_replace($match[0], "<div class=\"code-wrapper\"><pre><code>{$match[3]}</code></pre></div>", $body, $cnt);
                }
            }
        }
        return array('body' => $body, 'langs' => $langs);
    }

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
        $c->add($class->getConstant('USER_ID'), $user_id);
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