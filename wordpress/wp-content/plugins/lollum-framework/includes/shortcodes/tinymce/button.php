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
			<!-- button text -->
			<tr class="option lol-button">
				<th class="label">
					<label for="lol-button-text">Text</label>
				</th>
				<td class="field">
					<input type="text" name="lol-button-text" id="lol-button-text" value="" class="widefat">
				</td>
			</tr>
			<!-- button URL -->
			<tr class="option lol-button">
				<th class="label">
					<label for="lol-button-url">URL</label>
				</th>
				<td class="field">
					<input type="text" name="lol-button-url" id="lol-button-url" value="" class="widefat">
				</td>
			</tr>
			<!-- button size -->
			<tr class="option lol-button">
				<th class="label">
					<label for="lol-button-size">Size</label>
				</th>
				<td class="field">
					<select name="lol-button-size" id="lol-button-size" class="widefat">
						<option value="small">Small</option>
						<option value="medium" selected>Medium</option>
						<option value="big">Big</option>
					</select>
				</td>
			</tr>
			<!-- insert shortcode -->
			<tr>
				<th class="label"></th>
				<td class="field">
					<p><button id="insert-shortcode-button" class="button-primary">Insert Shortcode</button></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>