<div class="blogs grid row">
  <?php foreach($blogs as $blog): ?>
    <div class="blog col-lg-4 col-sm-6">
      <div class="grid-box">
        <a class="grid-img-holder" href="/<?php echo $blog['url']; ?>"><?php echo $blog['image_style']; ?></a>
        <div class="grid-content">
          <div class="date grid-time"><?php echo $blog['display_date']; ?></div>
          <div class="title"><h2><a href="/<?php echo $blog['url']; ?>"><?php echo $blog['title']; ?></a></h2></div>
        </div>
        <div class="grid-bottom">
          <div class="grid-tags">
            <?php foreach($blog['tags'] as $tag): ?>
              <?php echo $tag; ?>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
