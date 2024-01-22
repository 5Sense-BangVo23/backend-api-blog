<html>
<head>
    <title>{{ config('app.name') }} | Frontend API's Swagger</title>
    <link href="{{config('app.asset_function')('swagger/style.css')}}" rel="stylesheet">
</head>
<body>
<div id="swagger-ui"></div>
<script src="{{config('app.asset_function')('swagger/jquery-2.1.4.min.js')}}"></script>
<script src="{{config('app.asset_function')('swagger/swagger-bundle.js')}}"></script>
<script type="application/javascript">
    const ui = SwaggerUIBundle({
        url: "{{ config('app.asset_function')('swagger/swagger.yaml') }}",
        dom_id: '#swagger-ui',
    });
</script>
</body>
</html>
