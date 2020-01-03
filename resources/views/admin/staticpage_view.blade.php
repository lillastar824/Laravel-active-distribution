<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="{!! url('/public/admin_assets/vendor/bootstrap/css/bootstrap.min.css')!!}" rel="stylesheet">
</head>

<body>
	<div class="container">
     <h4 style="margin-top: 20px;"><center><b>{{ ucfirst($view[0]->title) }}</b></center></h4>
	<p style="text-align: justify; line-height: 25px;">{{(strip_tags(html_entity_decode($view[0]->description)))}}</p>
  </div>
</body>
</html>