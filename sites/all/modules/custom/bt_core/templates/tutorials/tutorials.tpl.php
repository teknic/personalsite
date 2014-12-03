<div class="tutorials grid row">
  <?php foreach($tutorials as $tutorial): ?>
    <div class="tutorial col-lg-4 col-sm-6">
      <div class="grid-box">
        <a class="grid-img-holder" href="/<?php echo $tutorial['url']; ?>" style="background-image:url(<?php echo $tutorial['image_style']; ?>)"></a>
        <div class="grid-content">
          <div class="date grid-time"><?php echo $tutorial['display_date']; ?></div>
          <div class="title"><h3><a href="/<?php echo $tutorial['url']; ?>"><?php echo $tutorial['title']; ?></a></h3></div>
        </div>
        <div class="grid-bottom">
          <div class="grid-tags">
            <?php foreach($tutorial['tags'] as $tag): ?>
              <a href="/<?php echo $tag['url']; ?>"><?php echo $tag['name']; ?></a>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
