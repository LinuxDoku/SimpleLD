<?php foreach($menuItems as $item): ?>
<li><a href="?p=<?php print $item['link'] ?>" alt="<?php print $item['alt'] ?>" <?php @print $item['params'] ?>><?php print $item['name'] ?></a></li>
<?php endforeach; ?>