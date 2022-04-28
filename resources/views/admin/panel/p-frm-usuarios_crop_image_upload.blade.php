<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="ctoken" content="{{ csrf_token() }}">
    <meta name="cuser" content="{{ $dados->id }}">
    <title>Painel de Controle | Car Truck</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('panel/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('panel/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/plugins/cropper/cropper.css') }}">
    <script src="{{ asset('panel/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('panel/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('panel/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/cropper/cropper.js') }}"></script>

    <style type="text/css">
        img {display: block; max-width: 100%;}
        .preview {overflow: hidden; width: 160px; height: 160px; margin: 10px; border: 1px solid red}
        .modal-lg {max-width: 1000px !important}
    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.includes.mainmenu')
        <div class="content-wrapper">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Foto de perfil</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Foto</li>
                                <li class="breadcrumb-item"><a href="{{ route('usuarios.profile') }}">Profile</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Home</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
            <section class="content">
                <div class="card" style="background-color:azure">
                    <div class="card-body">
                        @include('admin.includes.alerts.alert')
                        <h4 style="text-align: center">Foto perfil de: <strong>{{ $dados->nome}}</strong></h4>
                        @if($dados->foto)
                            <div class="basic-form" style="text-align: center">
                                <div class="card">
                                    <div class="card-body">
                                        <img src="{{ asset('img/usuarios') }}/{{ $dados->nome_foto }}" alt="{{ $dados->nome_foto }}" width="250px" style="margin: 15px auto">
                                    </div>
                                </div>
                                <a href="{{ route('profile.pictureExclui') }}" type="button" class="btn mb-1 btn-danger"><i class="fas fa-trash"></i> Excluir</a>
                            </div>
                        @else
                        <div class="basic-form">
                            <div class="card">
                                <div class="card-body" style="text-align: center">
                                    <input type="file" name="image" id="image1" class="image btn btn-primary">
                                </div>
                            </div>
                        </div>
                            <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modallabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal-label">Use o mouse para delimitar a área de recorte</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="cancelar"><span area-hidden="true">x</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="img-container">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <img src="https://avatars0.githubusercontent.com/u/3456749" id="image" alt="">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="preview"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                            <button type="button" class="btn btn-primary" id="crop">Salvar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <script>
                        var $modal = $('#modal');
                        var image = document.getElementById('image');
                        var cropper;

                        $("body").on("change", ".image", function(e) {
                            var files = e.target.files;
                            var done = function (url) { image.src = url; $modal.modal('show'); };
                            var reader;
                            var file;
                            var url;

                            if (files && files.length > 0) {
                                file = files[0];

                                if (URL) {
                                    done(URL.createObjectURL(file));
                                } else if (FileReader) {
                                    reader = new FileReader();
                                    reader.onload = function (e) { done(reader.result); };
                                    reader.readAsDataURL(file);
                                }
                            }
                        });

                        $modal.on('shown.bs.modal', function () {
                            cropper = new Cropper(image, {
                                aspectRatio: 1,
                                viewMode: 1,
                                preview: '.preview'
                            });
                        }).on('hidden.bs.modal', function () {
                            cropper.destroy();
                            cropper = null;
                        });

                        $("#crop").click(function(){
                            canvas = cropper.getCroppedCanvas({
                                width: 300,
                                height: 300,
                            });

                            canvas.toBlob(function(blob) {
                                url = URL.createObjectURL(blob);
                                var reader = new FileReader();
                                reader.readAsDataURL(blob);
                                reader.onloadend = function() {
                                    var base64data = reader.result;

                                    $.ajax({
                                        type: "POST",
                                        dataType: "json",
                                        url: "/paneladmin/p-usuarios-profile-salva-foto",
                                        data: {'_token': $('meta[name="ctoken"]').attr('content'), 'id': $('meta[name="cuser"]').attr('content'), 'image': base64data },

                                        error: function(result){
                                            console.log(result);
                                        },
                                        success: function(result){
                                            $("#modal").modal('hide');
                                            window.location.replace("/paneladmin/p-usuarios-profile");
                                        }
                                    })
                                }
                            });
                        })
                    </script>
                </div>
            </section>
        </div>
        @include('admin.includes.footer')
    </div>
</body>
</html>
