<footer id="footer" class="width100 smallPadding black centeredText">
	<?php if ($site->termsConditionsFile()->isNotempty()) { ?>
		<span class="noUnderline floatLeft mediumRightMargin"><a href="<?= $site->termsConditionsFile()->toFile()->url() ?>">AGBs</a></span>
	<?php } else if ($site->termsConditionsPage()->isNotEmpty()) { ?>
		<span class="noUnderline floatLeft mediumRightMargin"><a href="<?= $site->termsConditionsPage()->toPage()->url() ?>">AGBs</a></span>
	<?php } ?>
	<span>&copy <?= $site->name()->html() ?></span>
</footer>