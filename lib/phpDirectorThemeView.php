<?php
  class phpDirectorThemeView extends sfSmartyView {
    
    public function configure() {
      parent::configure();
      $theme = sfConfig::get("app_site_theme");
      if (is_readable($this->getDecoratorDirectory().'/'.$theme.'/'.$this->getDecoratorTemplate())) {
        $this->setDecoratorDirectory($this->getDecoratorDirectory().'/'.$theme);
      }
    }
  }