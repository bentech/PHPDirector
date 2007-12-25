<?php
class videoYouTubeProcessor extends videoProcessor {
  
  public function getID() {
    if (! $this->id) {
      $matches = array();
      $matchResult = preg_match("/[?|&]v=([^&]+)/i", $this->getURL(), $matches);
      if ($matchResult == 0) return FALSE;
      $this->id = $matches[1];
    } 
    return $this->id;
  }

  public function getAuthor() {
    if ($this->init()) return $this->getValueFromXMLSource("/ut_response/video_details/author");
    return false;
  }
  
  public function getTitle() {
    if ($this->init()) return $this->getValueFromXMLSource("/ut_response/video_details/title");
    return false;
  }
  
  public function getDescription() {
    if ($this->init()) return $this->getValueFromXMLSource("/ut_response/video_details/description"); 
    return false;
  }
  
  public function getPlayerCode() {
    if ($this->getID() !== FALSE)
      return '<object width="425" height="350"><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$this->getID().'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>';
    else return FALSE;
  }
  
  public function init() {
    if (! $this->xml) {
      $id = $this->getID();
      if ($id) {
        $xmlurl = "http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=".sfConfig::get("app_youtube_dev_id")."&video_id=".$id;
        $content = file_get_contents($xmlurl);
        $this->xml = new DOMDocument();
        if (! $this->xml->loadXML($content)) {
          $this->xml = null;
          return false;
        }
      }
    }
    return TRUE;
  }
}