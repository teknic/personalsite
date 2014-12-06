<div class="slides">
  <?php foreach ($items as $item): ?>
    <div class="slide">
      <h2 class="title">
        <span><?php echo $item->title; ?></span>
      </h2>
      <div class="image">
        <img data-lazy="<?php echo $item->image_style; ?>">
      </div>
    </div>
  <?php endforeach; ?>
</div>