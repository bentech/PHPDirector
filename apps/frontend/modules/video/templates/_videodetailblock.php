<?php 
  /** @var MediaItem **/
  $media = $media;
?>
<div align='center'>
<h2><?php echo $media->getName() ?></h2>
<p>
  <b>Author:</b>
  <br />
  <?php echo $media->getCreator() ?>
</p>
<?php 
  if ($media->getPlayerCode()) {
    echo $media->getPlayerCode();
  } else {
    echo "Error Player Code.";
  }
?>
<br />
<strong>Description:</strong>
<br />
<div id='description'><?php echo $media->getDescription() ?></div>
<br />
</div>