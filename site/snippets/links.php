<?php foreach($links as $link) { ?>
	<?php if ($link->textLink() == "true") { ?>
		<a class="alwaysUnderline" href="<?= $link->textLinkUrl()->html() ?>" target="_blank"><button class="blue rounded"><?= $link->linkText()->html() ?></button></a> 
	<?php } else {
		if (($link->linkTarget() == "true") && ($link->pageLink()->isNotEmpty())) { ?>
				<a class="alwaysUnderline" href="<?= $link->pageLink()->toPage()->url() ?>"><button class="blue rounded"><?= $link->linkText()->html() ?></button></a> 
		<?php } elseif (($link->linkTarget() == "false") && ($link->fileLink()->isNotEmpty())) { ?>
			<a class="alwaysUnderline" href="<?= $link->fileLink()->toFile()->url() ?>" target="_blank"><button class="blue rounded"><?= $link->linkText()->html() ?></button></a> 
		<?php }
	} ?>
<?php } ?>