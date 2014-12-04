<div class="tutorials row">
  <?php foreach($tutorials as $tutorial): ?>
    <div class="tutorial-wrapper col-lg-4 col-md-4 col-sm-6 col-xs-12">
      <div class="tutorial-box" style="background-image:url(<?php echo $tutorial['image_style']; ?>)">
        <div class="overlay">
          <a href="/<?php echo $tutorial['url']; ?>" class="title">
            <span><?php echo $tutorial['title']; ?></span>
          </a>
          <span><?php echo $tutorial['difficulty']; ?></span>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
