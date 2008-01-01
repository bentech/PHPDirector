<?php 
  /** @var MediaItem **/
  $media = $media;
?>
<p class="date"><?php echo $media->getDate() ?></p>
<?php 
  $pics = $media->getPreviewImages();
  echo link_to(
    image_tag($pics[0], array ('class'=>'bigimage', 'alt'=>substr($media->getName(), 0, 12))),
    "video/view?id=" . $media->getId()
  );
?>
<h3>
  <?php
    echo link_to(
      substr($media->getName(), 0, 64),
      "video/view?id=" . $media->getId()
    );
  ?>
</h3>
<p><?php echo substr($media->getDescription(), 0, 128); ?></p>
<p>&nbsp;</p>
<br />