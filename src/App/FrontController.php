<?php
namespace Hp\Phpexe\App;

class FrontController {
    public $templateDir =  '../../views/';
    public function renderView(string $templateFile){
        $requestUri = str_replace(UrlPrefix, '', $_SERVER['REQUEST_URI']);
        $parsedUrl  = parse_url($requestUri);
        $UrlPrefix  = UrlPrefix;
        // dd([_VIEW_DIR_ ,$parsedUrl]);
        require _VIEW_DIR_ . $templateFile;
    }
}
