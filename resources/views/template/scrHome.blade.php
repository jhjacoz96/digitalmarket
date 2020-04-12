<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('adminlte/dist/js/demo.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>


<script src="/adminlte/ckeditor/ckeditor.js"></script>

<!-- select2---->
<script src="{{asset('adminlte/plugins/select2/js/select2.full.min.js')}}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{asset('adminlte/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js')}}"></script>

<script src="{{ asset('js/appAdmin.js') }}" defer></script>

<script>

  window.data={

    editar:'si',
    datos:{
      "nombre":"{{$producto->nombre}}",
      "precioAnterior":"{{$producto->precioAnterior}}",
      "porcentajeDescuento":"{{$producto->porcentajeDescuento}}"
        }

  }

$(function () {
    //Initialize Select2 Elements
    $('#categoria_id').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })

</script>



