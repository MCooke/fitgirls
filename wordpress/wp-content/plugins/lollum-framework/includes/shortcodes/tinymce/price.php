<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<style>
		#main-shortcodes { width: 95%; }
		#lol-shortcodes label { font-weight: bold; }
		#lol-shortcodes label em { font-weight: normal; }
		#lol-shortcodes th { padding: 18px 10px; }
	</style>

</head>
<body>

<div id="main-shortcodes">
	<table id="lol-shortcodes" class="form-table">
		<tbody>
			<!-- price size -->
			<tr class="option lol-price">
				<th class="label">
					<label for="lol-price-size">Columns</label>
				</th>
				<td class="field">
					<select name="lol-price-size" id="lol-price-size" class="widefat">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4" selected>4</option>
						<option value="5">5</option>
					</select>
				</td>
			</tr>
			<!-- insert shortcode -->
			<tr>
				<th class="label"></th>
				<td class="field">
					<p><button id="insert-shortcode-price" class="button-primary">Insert Shortcode</button></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>