<?php

include 'SOAP/Client.php';

class SnippetServiceClient {

    const WSDL_URL = 'http://localhost:8080/axis2/services/CodesnippetService?wsdl';
    private $soap_client = null;

    public function __construct() {
        $wsdl = new SOAP_WSDL(self::WSDL_URL);
        $this->soap_client = $wsdl->getProxy();
    }

    public function highlight($lang, $snippet) {
    	$param = array(
            'ns4:snippet' => array(
                'ns4:code' => $snippet,
                'ns4:language' => $lang
            )
        );
        $rtn = $this->soap_client->call('ns4:highlight', $param, 'http://www.hoydaa.org/codesnippet/xsd'
        );
        return array(
    	    'language' => $rtn->language,
    	    'snippet' => $rtn->snippet
        );
    }

}