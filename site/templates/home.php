<?php snippet("head"); ?>
<body class="home">
	<?php //Initialize filters
	if (isset($_GET["filter"])) {
		$filter = $_GET["filter"];
	} else $filter = "off"; ?>

	<?php snippet("header", ["productColor" => "0", "filter" => $filter]); ?>
	<?php snippet("products", ["filter" => $filter]); ?>
	<?php snippet("footer"); ?>
	<?php snippet("overlayaccount"); ?>
	<?php snippet("overlaycart"); ?>
</body>