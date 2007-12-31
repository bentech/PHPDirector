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
    $c = new Criteria();
    $c->setLimit(10);
    $c->add(MediaItemPeer::APPROVED, TRUE);
    $c->addAnd(MediaItemPeer::REJECT, FALSE);
    $result = MediaItemPeer::doSelect($c);
    if (count($result)> 0) {
      $this->setVar("MediaList", $result);
    }
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
  
  /**
  * View a single video, in playable format.
  */
  public function executeView() {
  }
}
