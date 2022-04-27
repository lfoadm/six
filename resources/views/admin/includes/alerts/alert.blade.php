<!-- =================== PARA SUCESSOS =================== -->
@if(session('success'))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

<!-- =================== PARA ATENÇÃO =================== -->
@if(session('warning'))
    <div class="alert alert-warning" role="alert">
        {{ session('warning') }}
    </div>
@endif

<!-- =================== PARA EXCLUSÃO =================== -->
@if(session('danger'))
    <div class="alert alert-danger" role="alert">
        {{ session('danger') }}
    </div>
@endif

<!-- =================== PARA ATUALIZAÇÃO =================== -->
@if(session('info'))
    <div class="alert alert-info" role="alert">
        {{ session('info') }}
    </div>
@endif
