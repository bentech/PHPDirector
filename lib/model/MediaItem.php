<?php

/**
 * Subclass for representing a row from the 'pp_mediaitem' table.
 *
 * 
 *
 * @package lib.model
 */ 
class MediaItem extends BaseMediaItem
{
  /** @var videoProcessor **/
  private $vProcessor;
  
  public function getPlayerCode() {
    if ($this->vProcessor == null) {
      $vp = videoProcessorFactory::getVideoProcessorByType($this->getMediaType());
      if ($vp != FALSE) {
        $this->vProcessor = $vp;
        $this->vProcessor->setID($this->getFile());
      } else return FALSE;
    }
    return $this->vProcessor->getPlayerCode();
  }
  
  public function setPreviewImages($images) {
    parent::setPreviewImages(implode('# #', $images));
  }
  
  public function getPreviewImages() {
    return explode('#  #', parent::getPreviewImages());
  }
}
