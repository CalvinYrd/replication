<?php require_once("php/config.php") ?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>replication</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

	<div class="game"></div>
	<a class="leave" href="leave.php">quitter</a>

	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="app.js"></script>
	<?php
	if (!connect()) {
	?>
	<script type="text/javascript">

		String.prototype.remove = function(char) {
			return this.replaceAll(char, "")
		}
		let name = ""
		while (!name.remove(" ").remove("\t")) {
			name = prompt("Saisissez votre pseudo").trim()
		}
		$.ajax({
			method: "POST",
			url: "php/createUser.php",
			data: {
				name: name
			}
		})
		setTimeout(() => {
			window.location = "index.php"
		}, 500);

	</script>
	<?php
	}
	?>

	<script type="text/javascript">
		let lastMouseUpdate = new Date()
		let mouseUpdateDelay = 50
		let game = $(".game")

		<?php
		if (connect()) {
		?>

		$(document).on("mousemove", (e) => {
			// restriction délai
			if (new Date() - lastMouseUpdate >= mouseUpdateDelay) {
				x = e.pageX
				y = e.pageY

				$.ajax({
					method: "POST",
					url: "php/updateCursor.php",
					data: {
						x: x,
						y: y
					}
				})
				lastMouseUpdate = new Date()
			}
		})
		setInterval(() => {
			$.ajax({
				url: "php/checkState.php",
				success: function(res) {
					if (res == "false") window.location = "index.php"
				}
			})
		}, 1000);

		<?php
		}
		?>
		setInterval(() => {
			$.ajax({
				url: "php/getCursors.php",
				success: function(res) {
					cursors = JSON.parse(res)

					for (cursor of cursors) {
						x = cursor.x - 35
						y = cursor.y - 35
						el = $(`.game .cursor#${cursor.id}`)

						if (el.get(0)) {
							el.css("left", x+"px")
							el.css("top", y+"px")
						}
						else game.append(html(
							"p", {
								class: "cursor",
								id: cursor.id.toString(),
								style: `background: ${cursor.color}; box-shadow: ${cursor.color} 0px 10px 20px -10px, ${cursor.color} 0px 6px 12px -18px;`
							},
							cursor.name
						))
					}
				}
			})
		}, mouseUpdateDelay);

	</script>

</body>
</html>
