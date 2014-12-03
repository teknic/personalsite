<div class="blogs grid row">
  <?php foreach($modules as $module): ?>
    <div class="blog col-lg-6 col-sm-2">
      <div class="grid-box">
        <a class="grid-img-holder" href="/<?php echo $module['url']; ?>" style="background-image:url(<?php echo $module['image_style']; ?>)"></a>
        <div class="grid-content">
          <div class="date grid-time"><?php echo $module['display_date']; ?></div>
          <div class="title"><h3><a href="/<?php echo $module['url']; ?>"><?php echo $module['title']; ?></a></h3></div>
        </div>
        <div class="grid-bottom">
          <div class="grid-tags">
            <?php foreach($module['tags'] as $tag): ?>
              <a href="/<?php echo $tag['url']; ?>"><?php echo $tag['name']; ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
