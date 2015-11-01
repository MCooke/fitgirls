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
			<!-- skill name -->
			<tr class="option lol-skill">
				<th class="label">
					<label for="lol-skill-name">Skill Name</label>
				</th>
				<td class="field">
					<input type="text" name="lol-skill-autnamehor" id="lol-skill-name" value="" class="widefat">
				</td>
			</tr>
			
			<!-- skill size -->
			<tr class="option lol-skill">
				<th class="label">
					<label for="lol-skill-size">Size</label>
				</th>
				<td class="field">
					<select name="lol-skill-size" id="lol-skill-size" class="widefat">
						<option value="5" selected>5</option>
						<option value="10">10</option>
						<option value="15">15</option>
						<option value="20">20</option>
						<option value="25">25</option>
						<option value="30">30</option>
						<option value="35">35</option>
						<option value="40">40</option>
						<option value="45">45</option>
						<option value="50">50</option>
						<option value="55">55</option>
						<option value="60">60</option>
						<option value="65">65</option>
						<option value="70">70</option>
						<option value="75">75</option>
						<option value="80">80</option>
						<option value="85">85</option>
						<option value="90">90</option>
						<option value="95">95</option>
						<option value="100">100</option>
					</select>
				</td>
			</tr>
			<!-- insert shortcode -->
			<tr>
				<th class="label"></th>
				<td class="field">
					<p><button id="insert-shortcode-skill" class="button-primary">Insert Shortcode</button></p>
				</td>
			</tr>
		</tbody>
	</table>
</div>
</body>
</html>