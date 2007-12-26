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
      if ($vp !== FALSE) $this->vProcessor = $vp;
      else return FALSE;
    }
    $this->vProcessor->getPlayerCode();
  }
  
  public function setPreviewImages($images) {
    parent::setPreviewImages(implode('# #', $images));
  }
  
  public function getPreviewImages() {
    return explode('#  #', parent::getPreviewImages());
  }
}
