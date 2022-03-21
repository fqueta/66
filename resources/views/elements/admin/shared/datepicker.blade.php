@section('head')
	<link rel="stylesheet" type="text/css" href="/admin_files/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/admin_files/css/bootstrap-datetimepicker.min.css">
@stop
@section('scripts')
	<script src="/admin_files/js/moment.js"></script>
  <script src="/admin_files/js/bootstrap.min.js"></script>
  <script src="/admin_files/js/bootstrap-datetimepicker.min.js"></script>
  <script type="text/javascript">
    $(function () {
      $('#datetimepicker1').datetimepicker({
      	locale: 'pt-BR',
      	format: ''
      });
    });
  </script>
@stop