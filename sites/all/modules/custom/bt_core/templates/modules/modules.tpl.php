<div class="blogs grid row">
  <?php foreach($modules as $module): ?>
    <div class="blog col-lg-6 col-sm-2">
      <div class="grid-box">
        <div class="grid-content">
          <div class="icon"><?php echo $module['icon']; ?></div>
          <div class="title"><h3><a href="/<?php echo $module['url']; ?>"><?php echo $module['title']; ?></a></h3></div>
          <?php if (isset($module['card_icon'])): ?>
            <?php echo $module['card_icon']; ?>
          <?php endif; ?>
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
