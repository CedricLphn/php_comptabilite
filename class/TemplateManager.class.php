<?php

class TemplateManager {

    private $tpl = [
        "header" => "template/header.php",
        "content" => null,
        "footer" => "template/footer.php",
        "dirPages" => "pages/",
        "data" => []
    ];

    /**
     * Constructor
     *
     * @param string $dir directory page
     * @return bool
     */
    public function __construct(string $dir = null) {
        if($dir != null) {
            $this->tpl["dirPages"] = $dir;
        }

    }

    
    /**
     * Set the content page
     *
     * @param string $filename
     * @return boolean
     */
    public function setContent(string $filename) : bool {
        $this->tpl["content"] = $filename;
        return true;
    }

    /**
     * Change the header page
     *
     * @param string $filename
     * @return boolean
     */
    public function setHeader(string $filename) : bool{
        $this->tpl["header"] = $content;
        return true;
    }

    /**
     * Change the footer page
     *
     * @param string $filename
     * @return boolean
     */
    public function setFooter(string $filename) : bool{
        $this->tpl["Footer"] = $content;
        return true;
    }

    /**
     * Delete the header
     *
     * @return boolean
     */
    public function delHeader() : bool {
        $this->tpl["header"] = null;
        return true;
    }
    

    /**
     * Delete the footer
     *
     * @return boolean
     */
    public function delFooter() : bool {
        $this->tpl["footer"] = null;
        return true;
    }

    /**
     * Delete the header & footer page
     *
     * @return boolean
     */
    public function delAll() : bool {
        $this->delHeader();
        $this->delFooter();
        return true;
    }

    /**
     * Set data in template page (alpha)
     *
     * @param array $data
     * @return boolean
     */
    public function set(array $data) : bool {
        $this->tpl["data"] = $data;
        return true;
    }


    /**
     * Show the page
     *
     * @return boolean
     */
    public function show() : bool {
        $data = $this->tpl["data"];
        require_once($this->tpl["header"]);
        ($this->tpl["content"] == null) ? "please insert content file" : require_once($this->tpl["dirPages"].$this->tpl["content"]);
        require_once($this->tpl["footer"]);

        return true;

    }

}

?>