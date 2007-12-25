<?php                                                                        
class videoDailyMotionProcessor extends videoProcessor {
  public function getID() {
    if (! $this->id) {
      $matches = array();
      $matchResult = preg_match("/\/video\/([^&]+)$/i", $this->getURL(), $matches);
      if ($matchResult == 0) return FALSE;
      $this->id = $matches[1];
    } 
    return $this->id;
  }

  public function getAuthor() {
    if ($this->init()) return $this->getValueFromXMLSource("/feed:feed/feed:entry/feed:author/feed:name");
    return false;
  }
  
  public function getTitle() {
    if ($this->init()) return $this->getValueFromXMLSource("/feed:feed/feed:entry/feed:title");
    return false;
  }
  
  public function getDescription() {
    if ($this->init()) return $this->getValueFromXMLSource("/feed:feed/feed:entry/feed:content"); 
    return false;
  }
  
  public function getPlayerCode() {
    if ($this->getID() !== FALSE)
      return '<object width="425" height="335"><param name="movie" value="http://www.dailymotion.com/swf/'.$this->getID().'"></param><param name="allowfullscreen" value="true"></param><embed src="http://www.dailymotion.com/swf/'.$this->getID().'" type="application/x-shockwave-flash" width="425" height="335" allowfullscreen="true"></embed></object>';
    else return FALSE;
  }
  
  public function init() {
    if (! $this->xml) {
      $id = $this->getID();
      if ($id) {
        $xmlurl = "http://www.dailymotion.com/atom/fr/cluster/extreme/featured/video/".$id;
        $content = file_get_contents($xmlurl);
        $this->xml = new DOMDocument();
        if (! $this->xml->loadXML($content)) {
          echo "XML ERROR\n";
          $this->xml = null;
          return false;
        }
      }
    }
    return TRUE;
  }
  
  public function getDomXPath() {
    /** @var DOMXPath **/
    $xpathdom = parent::getDomXPath();
    $xpathdom->registerNamespace("feed", "http://www.w3.org/2005/Atom");
    return $xpathdom;
  }
}