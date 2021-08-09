<footer id="footer" class="smallPadding white smallBottomMargin width100 inlineBlock">
	<?php if ($site->termsConditionsFile()->isNotempty()) { ?>
		<span class="noUnderline floatLeft mediumRightMargin"><a href="<?= $site->termsConditionsFile()->toFile()->url() ?>">AGBs</a></span>
	<?php } else if ($site->termsConditionsPage()->isNotEmpty()) { ?>
		<span class="noUnderline floatLeft mediumRightMargin"><a href="<?= $site->termsConditionsPage()->toPage()->url() ?>">AGBs</a></span>
	<?php } ?>
	<span class="floatRight">&copy <?= $site->name()->html() ?></span>
</footer>