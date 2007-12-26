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
  
  public function getPreviewImages() {
    if ($this->init()) { 
      $images[0] = $this->getValueFromXMLSource("/ut_response/video_details/thumbnail_url"); 
      return $images;
    }
    return FALSE;
  }
  
  public function getPlayerCode() {
    if ($this->getID() !== FALSE)
      return '<object width="425" height="350"><param name="wmode" value="transparent"></param><embed src="http://www.youtube.com/v/'.$this->getID().'&autoplay=1" type="application/x-shockwave-flash" wmode="transparent" width="425" height="350"></embed></object>';
    else return FALSE;
  }
  
  protected function getXMLDescriptionURL() {
     return "http://www.youtube.com/api2_rest?method=youtube.videos.get_details&dev_id=".sfConfig::get("app_youtube_dev_id")."&video_id=".$this->getID();
   } 
}