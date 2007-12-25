<?php
  if (!@constant('SF_APP')) { // Define constants if not done before (group testing)
    define('SF_APP', 'backend');
    define('SF_ENVIRONMENT', 'test');
    define('SF_DEBUG', TRUE);
  }
  
  if (!@constant('SF_ROOT_DIR')) { // Load unit test framework if not done before (group testing)
    include(dirname(__FILE__).'/../bootstrap/unit.php');
  }
  
  require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
  sfCore::initSimpleAutoload(array(SF_ROOT_DIR.'/lib/model' // DB model classes
                                ,$sf_symfony_lib_dir // Symfony itself
                                ,SF_ROOT_DIR.'/apps/'.SF_APP.'/lib'
                                ,SF_ROOT_DIR.'/lib/videoProcessor'
                                ,SF_ROOT_DIR.'/plugins')); // Location plugins
                                
  set_include_path($sf_symfony_lib_dir . '/vendor' . PATH_SEPARATOR . SF_ROOT_DIR . PATH_SEPARATOR . get_include_path());
  
 /*
 * Start database and Symfony core
 */
  sfCore::bootstrap($sf_symfony_lib_dir, $sf_symfony_data_dir);
  sfContext::getInstance();
  Propel::setConfiguration(sfPropelDatabase::getConfiguration());
  Propel::initialize();
  
  $test = new lime_test(18, new lime_output_color());
  
  /** Start YouTube Test **/
  $test->isa_ok($vp = videoProcessorFactory::getVideoProcessor("http://www.youtube.com/watch?v=T6DtRbg9BPE"), "videoYouTubeProcessor", "YouTube URL is recorgnise.");
  $test->is($vp->getID(), "T6DtRbg9BPE", "YouTube ID is Good.");
  $test->is($vp->getTitle(), "Jennifer Love Hewitt Big boobs", "Title match.");
  $test->is($vp->getAuthor(), "papalinaceleb", "Author match.");
  $test->is($vp->getDescription(), "Jennifer Love Hewitt Big boobs", "Description match.");
  $m = $vp->save();
  $test->isa_ok($m, "MediaItem", "Save Successfully");
  $m->delete();
  
  /** Start DailyMotion Test **/
  $test->isa_ok($vp = videoProcessorFactory::getVideoProcessor("http://www.dailymotion.com/video/x3ssjv_ridan_music"), "videoDailyMotionProcessor", "DailMotion URL is recorgnise.");
  $test->is($vp->getID(), "x3ssjv_ridan_music", "Daily Motion ID is Good");
  $test->is($vp->getTitle(), "Ridan", "Title match.");
  $test->is($vp->getAuthor(), "Charmade", "Author match.");
  $test->is($vp->getDescription(), "Extrait du clip \"La partie de Golf\" de Ridan", "Description match.");
  $m = $vp->save();
  $test->isa_ok($m, "MediaItem", "Save Successfully");
  $m->delete();
  
  /** Start GoogleVideo Test **/
  $test->isa_ok($vp = videoProcessorFactory::getVideoProcessor("http://video.google.com.au/videoplay?docid=2469928627183918026"), "videoGoogleVideoProcessor", "GoogleVideo URL is recorgnise.");
  $test->is($vp->getID(), "2469928627183918026", "GoogleVideo ID is Good");
  $test->is($vp->getTitle(), "really expensive cat toy", "Title match.");
  $test->is($vp->getAuthor(), "mattcoats!", "Author match.");
  $test->is($vp->getDescription(), "This is our kitten, Robot.  She likes computers.  No the screen was not damaged because she doesn't use her claws when playing...  only when attacking, which is more often.", "Description match");
  $m = $vp->save();
  $test->isa_ok($m, "MediaItem", "Save Successfully");
  $m->delete();
?>
