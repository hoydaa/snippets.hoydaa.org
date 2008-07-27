<?php

sfLoader::loadHelpers(array('Text'));

class Summarizer
{
  private $max;
  private $threshold;

  function __construct($max, $threshold = 10)
  {
    $this->max = $max;
    $this->threshold = $threshold;
  }

  public function summarize($body)
  {
    $matches = array();
    preg_match_all("/<p>(.+)<\/p>/isU", $body, $matches, PREG_SET_ORDER);

    $paragraphs = array();

    foreach ($matches as $match)
    {
      $paragraphs[] = preg_replace("/(\\r?\\n[ \\t]*)+/", " ", strip_tags($match[1]));
    }

    $total = $this->total($paragraphs);

    foreach ($paragraphs as $i => $paragraph)
    {
      if (strlen($paragraph) / $total * 100 < $this->threshold)
      {
        unset($paragraphs[$i]);
      }
    }

    $total = $this->total($paragraphs);
    $spaces = count($paragraphs) - 1;

    foreach ($paragraphs as $i => $paragraph)
    {
      $paragraphs[$i] = truncate_text($paragraph, strlen($paragraph) / $total * ($this->max - $spaces), '...', true);
    }

    return implode(' ', $paragraphs);
  }

  protected function total($paragraphs)
  {
    $total = 0;

    foreach ($paragraphs as $paragraph)
    {
      $total += strlen($paragraph);
    }

    return $total;
  }
}

?>