<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cuteye</title>
	<link rel="stylesheet" href="">
</head>
<body>
		<div class="container wrapper">
			<!-- rember to set off set for  -->
			<div class="col-md-8 main-container">
				<div class="row">

				</div>
				<?php echo "<img src='https://graph.facebook.com/".$fbID."/picture'>"?>
				<p class="col-md-8">
				</p>
				<div class="row">
					<?= form_open("home/post");?>
						<label>Friends</label>
						<div class="controls error">
							<select class="form-control" name="friend">
							  <option value="miggie">miggie</option>
							  <option value="calpat">calpat</option>
							  <option value="bokie">bokie</option>
							  <option value="steups">steups</option>
							  <option value="wine">wine</option>
							  <option value="cuteye">cuteye</option>
							</select>
						</div>



						<label>Actions</label>
						<div class="controls error">
							<select class="form-control" name="action">
							  <option value="miggie">miggie</option>
							  <option value="calpat">calpat</option>
							  <option value="bokie">bokie</option>
							  <option value="steups">steups</option>
							  <option value="wine">wine</option>
							  <option value="cuteye">cuteye</option>
							</select>
						</div>
						<div class="controls">
							<button type="submit" class="btn btn-primary">Post</button>
						</div>
					<?= form_close();?>
				</div>
			</div>
		</div>
</body>
</html>