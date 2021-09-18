@extends('layouts/fullLayoutMaster')

@section('title', 'Firma del Contrato')

@section('vendor-style')
{{-- Vendor Css files --}}
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')

<!-- Validation -->

<style>
    #capa-exterior {
        min-height: 200px;
        position: relative;
    }

    #capa-interior {
        left: 0;
        margin: 0;
        position: absolute;
        right: 0;
        text-align: center;
        top: 25%;
        transform: translateY(-50%);
        color: #fff;


    }

    .btn-prima {
        background: #00c2ef;
        border: 1px solid #00c2ef;
        box-sizing: border-box;
        box-shadow: 0px 2px 0px rgba(0, 0, 0, 0.043);
        border-radius: 35px;
        font-size: 18px;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        color: white;


    }
</style>

<div class="capa-exterior mb-5">
    <img class="margin" href="#" src="{{asset('images/svg/Frame.svg')}}" alt="">

    <div>
        <h3 class="capa-interior">the new investor</h3>
        <br>
        <p class="capa-exterior2">Te damos la bienvenida a nuestro sistema de inversión, agradecemos diligenciar el siguiente formulario para poder brindarte un mejor servicio y garantizar consignar tus rentabilidades mensuales directamente a tu cuenta bancaria.</p>
    </div>
</div>

@foreach($inversiones as $inversion)
<div id="capa-exterior">
    <div id="capa-interior">
        <h2>Firmar Contrato</h2>
        <a href="#" class="btn btn-prima mt-3 subir" inversion="{{$inversion->id}}">Firmar</a>
    </div>
</div>
@endforeach
<footer class="footert">
    <span>
        <img src="{{asset('images/svg/Frame.svg')}}" alt="">
        </label>
        <div class="ul mt-2">
            <p class="li nav-item">The New Investor 2021 | Todos los Derechos Reservados</p>
        </div>
</footer>

<!-- Vertical modal -->
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Vertically Centered</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="signature-pad" class="signature-pad" style="margin: 0px auto;">
                    <div class="signature-pad--body">
                        <p>Colocar tu firma aqui</p>
                        <canvas style="border: 1px solid #000; width: 100%;"></canvas>
                        <form method="POST" id="formContrato">
                            @csrf
                            <input type="hidden" id="imagen64" name="imagen64">
                            <input type="hidden" id="inversion_id" name="inversion_id">
                        </form>
                    </div>
                    <div class="signature-pad--footer">
                        <div class="text-center">Accion</div>
                        <div class="text-center">
                            <button type="button" class="button clear btn btn-info btn-round" data-action="clear" id="limpiar">Limpiar</button>
                            <button type="button" class="button btn btn-info btn-round" data-action="undo" id="btnGuardar">Firmar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cancelar</button>
            </div>
        </div>
    </div>
</div>


</section>


<!-- /Validation -->
@endsection



@push('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    var modal = document.getElementById('modal')

    $('.subir').click(function() {

        $('#inversion_id').val($('.subir').attr('inversion'));
        var myModal = new bootstrap.Modal(modal);

        myModal.show();

    });

    modal.addEventListener('shown.bs.modal', function(event) {

        var wrapper = document.getElementById("signature-pad");

        var canvas = wrapper.querySelector("canvas");
        var signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgb(255, 255, 255)'
        });

        function resizeCanvas() {

            var ratio = Math.max(window.devicePixelRatio || 1, 1);

            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);

            signaturePad.clear();
        }

        window.onresize = resizeCanvas;
        resizeCanvas();

        $('#limpiar').click(function() {
            signaturePad.clear();
        })

        $('#btnGuardar').click(function() {

            event.preventDefault();
            if (signaturePad.isEmpty()) {
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                swalWithBootstrapButtons.fire({
                    title: "Debe realizar la firma!"
                });
            } else {
                document.getElementById('imagen64').value = signaturePad.toDataURL();
                //$("#loading").modal('show');
                var datos = $('#formContrato').serialize();
                $.ajax({
                    method: "GET",
                    url: "{{route('contratos.firmar')}}",
                    data: datos
                }).done(function(response) {
                    //$("#loading").modal('hide');

                    if (response.success == true) {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success'
                            },
                            buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire({
                            title: "Contrato creado exitosamente.",
                            text: "Un asesor se encargará de validar la firma del contrato y pronto se habilitará el botón de Pago para que empieces a disfrutar los beneficios.",
                            icon: "success",
                            backdrop: true,
                            allowOutsideClick: false
                        }).then(function(e) {
                            location.href = "{{ route('contratos.index') }}";
                        });
                    } else {
                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                        })
                        swalWithBootstrapButtons.fire({
                            title: "Opss! Algo no salio bien",
                            text: "El contrato no se creó!",
                            icon: "warning"
                        });
                    }
                });
            }
        });
    })
</script>

@endpush

@section('vendor-script')
<!-- vendor files -->
<script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

@endsection
@section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
@endsection