<?php
class HtmlElement
{
    private $Attributes = [];
    private $tag;

    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public function __set($name, $value)
    {
        $this->Attributes[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->Attributes))
        {
            return $this->Attributes[$name];
        }
    }

    public function html($innerHtml = '')
    {
        $html = "<{$this->tag}";
        foreach ($this->Attributes as $key => $value) {
            $html .= ' ' . $key . '="' . $value . '"';
        }
        $html .= '>';
        $html .= $innerHtml;
        $html .= "</{$this->tag}>";

        return $html;
    }
}

$article = new HtmlElement('article');
$article->id = 'main';
$article->class = 'light';

// show the attributes
echo $article->class . "<br />"; // light
echo $article->id; // main
?>