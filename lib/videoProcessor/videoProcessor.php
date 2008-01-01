<?php
abstract class videoProcessor {
  
  /** @var String */
  protected $url;
  /** @var String */
  protected $id;
  /** @var DOMDocument */
  protected $xml;
  /** @var DOMXPath **/
  protected $xpath;
  /** @var MediaType **/
  protected $mediaType;
  
  function __construct() {
    $this->url = null;
    $this->id = null;
    $this->xml = null; 
    $this->xpath = null; 
  }
  
  /**
  * Set Video URL
  * @param String Video URL
  */
  public function setURL($url) {
    $this->url = $url;
  }
  
  /**
  * Get Video URL
  * @return String Video URL
  */
  public function getURL() {
    return $this->url;
  }
  
  /**
  * Check if the Video URL is valid
  * @return BOOL
  */
  public function isValidVideo() {
    if (! $this->getID()) return FALSE;
    if (! $this->init()) return FALSE;
    else return TRUE;
  }
  
  /**
  * Get Value from XML Source
  * @param String XPath
  * @param Bool Return raw node?
  * @return String or array of String or raw node
  */
  protected function getValueFromXMLSource($xpath, $raw = FALSE) {
    if (! $this->xpath) $this->xpath = $this->getDomXPath();
    $node = $this->xpath->evaluate($xpath);
    if ($raw) return $node;
    if ($node instanceof DOMNodelist) {
      if ($node->length == 0) return FALSE;
      if ($node->length == 1) return $node->item(0)->nodeValue;
      $result = array();
      for ($i = 0; $i < $node->length; $i++) {
        $result[] = $node->item($i)->nodeValue;
      }
      return $result;
    }
  }
  
  /**
  * Function to create a DOMXPath. Subclass need to override this class to register extra Namespace.
  * @return DOMXPath
  */
  public function getDomXPath() {
    return new DOMXPath($this->xml);
  }
  
  /**
  * Is the video description in XML format?
  * @return BOOL
  */
  public function isXML() {
    if ($this->init()) {
      if ($this->xml != NULL) return TRUE;
    }
    return FALSE;
  }
  
  /**
  * Set media type.
  * @param MediaType
  */
  public function setMediaType($type) {
    if ($type instanceof MediaType) $this->mediaType = $type;
  }
  
  /**
  * Save Video
  * @param BOOL Update video if already exist.
  * @return MediaItem or false for not save successfully
  */
  public function save($update = FALSE) {
    if ($this->isValidVideo() && $this->mediaType) {
      $c = new Criteria();
      $c->add(MediaItemPeer::MEDIATYPE_ID, $this->mediaType->getId());
      $c->add(MediaItemPeer::FILE, $this->getID());
      /** @var MediaItem **/
      $mediaitem = null;
      if (MediaItemPeer::doCount($c) == 0) {
        $mediaitem = new MediaItem();
        $mediaitem->setNew(true);
      } else {
        $mediaitem = MediaItemPeer::doSelectOne($c);
        $mediaitem->setNew(false);
        if (! $update) return $mediaitem;
      }
      $mediaitem->setFile($this->getID());
      $mediaitem->setMediaType($this->mediaType);
      $mediaitem->setDescription($this->getDescription());
      $mediaitem->setName($this->getTitle());
      $mediaitem->setCreator($this->getAuthor());
      $mediaitem->setPreviewImages($this->getPreviewImages());
      if ($mediaitem->save()) return $mediaitem;
      else return FALSE;
    }
    return FALSE;
  }
  
  /**
  * Initialise Video Processor
  * @return BOOL Status of Initialisation
  */
  public function init() {
    if (! $this->xml) {
      $id = $this->getID();
      if ($id) {
        $xmlurl = $this->getXMLDescriptionURL();
        $content = file_get_contents($xmlurl);
        $this->xml = new DOMDocument();
        if (! $this->xml->loadXML($content)) {
          $this->xml = null;
          return FALSE;
        }
      }
    }
    return TRUE;
  }
  
  /**
  * Set video ID
  * @param String ID of the video
  */
  public function setID($id) {
    $this->id = $id;
  }
  
  /**
  * Get XML Description URL.
  * @return String URL to the video
  */
  protected abstract function getXMLDescriptionURL();
  
  /**
  * Get Video ID
  * @return String
  */
  public abstract function getID();
  /**
  * Get Video Author
  * @return String
  */
  public abstract function getAuthor();
  /**
  * Get Video Title
  * @return String
  */
  public abstract function getTitle();
  /**
  * Get Video Description
  * @return String
  */
  public abstract function getDescription();
  /**
  * Get Player code
  * @return String
  */
  public abstract function getPlayerCode();
  /**
  * Get Preview Image URLs
  * @return array of URL String
  */
  public abstract function getPreviewImages();
}