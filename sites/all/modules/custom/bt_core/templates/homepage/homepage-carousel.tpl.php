<div class="slides">
  <?php foreach ($items as $item): ?>
    <div class="slide">
      <a href="<?php echo $item->url; ?>">
        <h2 class="title">
          <span><?php echo $item->title; ?></span>
        </h2>
      </a>
      <div class="image">
        <a href="<?php echo $item->url; ?>"><img data-lazy="<?php echo $item->image_style; ?>"></a>
      </div>
    </div>
  <?php endforeach; ?>
</div>