<?php
  define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
  define('SF_APP',         'frontend');
  define('SF_ENVIRONMENT', 'prod');
  define('SF_DEBUG',       false);
 
  require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');
  $databaseManager = new sfDatabaseManager();
  $databaseManager->initialize();

  $youtubeList = array("Zdj9vMH4BfQ", "H7Dz0jc1mUs", "VTinQFsoA8I", "WBU3tIhUXXY", "GVI9oPzmWH4", "-vq0lBK0py8", "vYB7CpwxcUw");
  $dailymotionList = array("-st-vincent-marry-me", "x3vhkj_animation-procreation-3_shortfilms", "x3s9g8_daft-punk-piano_music", "x1x2r2_skydivergirl-jenn-age-24_extreme");
  $googlevideoList = array("1047064382297597701", "-191580394852217491", "-2149576815319098675", "881321004838285177", "-92587371559679358");
  
  foreach ($youtubeList as $id) {
    $vp = videoProcessorFactory::getVideoProcessor("http://www.youtube.com/watch?v=".$id);
    $media = $vp->save(TRUE);    
    if ($media) {
      $media->setApproved(TRUE);
      $media->save();
    }
  }
  
  foreach ($dailymotionList as $id) {
    $vp = videoProcessorFactory::getVideoProcessor("http://www.dailymotion.com/video/".$id);
    $media = $vp->save(TRUE);    
    if ($media) {
      $media->setApproved(TRUE);
      $media->save();
    }    
  }
  
  foreach ($googlevideoList as $id) {
    $vp = videoProcessorFactory::getVideoProcessor("http://video.google.com.au/videoplay?docid=".$id);
    $media = $vp->save(TRUE);    
    if ($media) {
      $media->setApproved(TRUE);
      $media->save();
    }    
  }