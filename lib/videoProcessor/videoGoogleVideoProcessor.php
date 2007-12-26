<?php
class videoGoogleVideoProcessor extends videoProcessor {
   public function getID() {
    if (! $this->id) {
      $matches = array();
      $matchResult = preg_match("/[?|&]?docid=([^&]+)/i", $this->getURL(), $matches);
      if ($matchResult == 0) return FALSE;
      $this->id = $matches[1];
    } 
    return $this->id;
  }

  public function getAuthor() {
    if ($this->init()) return $this->getValueFromXMLSource("/rss/channel/item/author");
    return false;
  }
  
  public function getTitle() {
    if ($this->init()) return $this->getValueFromXMLSource("/rss/channel/item/media:group/media:title");
    return false;
  }
  
  public function getDescription() {
    if ($this->init()) return $this->getValueFromXMLSource("/rss/channel/item/media:group/media:description"); 
    return false;
  }
  
  public function getPreviewImages() {
    if ($this->init()) {
      $result = array();
      $node = $this->getValueFromXMLSource("/rss/channel/item/media:group/media:thumbnail", TRUE); 
      if ($node) {
        for ($i = 0; $i < $node->length; $i++) {
          $result[] = $node->item($i)->getAttribute('url');
        }
      }
      return $result;
    }
    return FALSE;
  }
  
  public function getPlayerCode() {
    if ($this->getID() !== FALSE)
      return '<embed style="width:400px; height:326px;" id="VideoPlayback" type="application/x-shockwave-flash" src="http://video.google.com/googleplayer.swf?docId='.$this->getID().'&hl=en-US" flashvars=""></embed>';
    else return FALSE;
  }
  
  protected function getXMLDescriptionURL() {
    return "http://video.google.com/videofeed?docid=".$this->getID();
  }
  
  public function getDomXPath() {
    /** @var DOMXPath **/
    $xpathdom = parent::getDomXPath();
    $xpathdom->registerNamespace("openSearch", "http://a9.com/-/spec/opensearchrss/1.0/");
    $xpathdom->registerNamespace("media", "http://search.yahoo.com/mrss/");
    return $xpathdom;
  }
}