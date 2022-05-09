<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel de Controle</title>
    <link rel="stylesheet" href="{{ asset('panel/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/plugins/sortable/jquery-ui.css') }}">
    <style>
        #menu { list-style-type: none; margin: 0; padding: 0; width: 100%; cursor: move; }
        #menu li { margin: 5px 0px; padding: 10px 10px; font-size: 1.4em; background-color: #D2D3D5; color: #000 }
        #menu li span { position: absolute; margin-left: -1.3em; }
        #menu a { color: #fff; text-decoration: none }
        #menu a hover { color: #fff }
    </style>
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        @include('admin.includes.mainmenu')
        @yield('paneladmin')
        @include('admin.includes.footer')
    </div>

    <script src="{{ asset('panel/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('panel/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('panel/dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('panel/plugins/sortable/jquery-1.12.4.js') }}"></script>
    <script src="{{ asset('panel/plugins/sortable/jquery-ui.js') }}"></script>
    <script>
        $( function() {
            $( "#menu" ).sortable({
                stop: function(){
                    $.map($(this).find('li'), function(el) {
                        var itemID = el.id;
                        var itemIndex = $(el).index();
                        var itemMenu = {{ $menu->id }}
                        $.ajax({
                            url: "/paneladmin/p-menus-conteudos-ordenar-salva",
                            type: "POST",
                            datatype: "json",
                            data: {itemMenu: itemMenu, itemID: itemID, itemIndex: itemIndex, "_token": "{{ csrf_token() }}" },
                        })

                    })
                }
            });
        });
    </script>
</body>
</html>
