<?php
class videoProcessorFactory {
  
  /**
  * Get Video Processor for the supply url
  * @param String The url to the video.
  * @return videoProcessor The processor responsible for this video.
  */
  public static function getVideoProcessor($url) {
    $check = explode(".", $url);
    $source = strtolower($check[1]);
    $videoProcessor = videoProcessorFactory::getVideoProcessorByType($source);
    if ($videoProcessor == FALSE) return FALSE;
    $videoProcessor->setURL($url);
    return $videoProcessor;
  }
  
  /** 
  * Get Video Processor for the specify media type
  * @param MediaType or media type string
  * @return videoProcessor The processor responsible for this video. 
  */
  public static function getVideoProcessorByType($mediatype) {
    if ($mediatype instanceof MediaType) $type = $mediatype->getName();
    else $type = $mediatype;
    $c = new Criteria();
    $videoProcessor = null;
    switch ($type) {
      case "youtube": 
        $c->add(MediaTypePeer::NAME, "youtube");
        $videoProcessor = new videoYouTubeProcessor();
        break;
      case "google":
        $c->add(MediaTypePeer::NAME, "googlevideo"); 
        $videoProcessor = new videoGoogleVideoProcessor();
        break;
      case "dailymotion":
        $c->add(MediaTypePeer::NAME, "dailymotion"); 
        $videoProcessor = new videoDailyMotionProcessor();
        break;
      default: return FALSE;
    }
    if ($mediatype instanceof MediaType) $videoProcessor->setMediaType($mediatype);
    else $videoProcessor->setMediaType(MediaTypePeer::doSelectOne($c));
    return $videoProcessor;
  }
}