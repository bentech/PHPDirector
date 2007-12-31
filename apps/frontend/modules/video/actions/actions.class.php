<?php

/**
 * video actions.
 *
 * @package    phpDirector
 * @subpackage video
 * @author     James Moey <jamesmoey@gmail.com>
 * @version    SVN: $Id$
 */
class videoActions extends sfActions
{
  /**
  * Video Index, forward to All action by default
  */
  public function executeIndex() {
    $this->forward("video", "all");
  }
  
  /**
  * Display all video.
  */
  public function executeAll() {
  }
  
  /**
  * Display featured video only
  */
  public function executeFeatured() {
  }
  
  /**
  * Display video Categories
  */
  public function executeCategories() {
  }
  
  /**
  * Display video images thumbnail.
  */
  public function executeImages() {
  }
  
  /**
  * Display a random video.
  */
  public function executeRandom() {
  }
  
  /**
  * Form to submit video.
  */
  public function executeSubmit() {
  }
}
