@extends('layouts.app')

@section('title', 'Desafio - Broobe | Historial')

@section('content')
<div class="container-fluid mt-5"> <!-- Cambiado a container-fluid para ocupar el ancho completo -->
    <h2 class="text-center text-dark">Historial de Métricas</h2>
    <div class="table-responsive"> <!-- Contenedor responsivo -->
        <table id="metricsTable" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>URL</th>
                    <th>ACCESSIBILITY</th>
                    <th>PWA</th>
                    <th>SEO</th>
                    <th>PERFORMANCE</th>
                    <th>BEST PRACTICES</th>
                    <th>STRATEGY</th>
                    <th>DATETIME</th>
                </tr>
            </thead>
            <tbody>
                @foreach($metrics as $metric)
                    <tr>
                        <td>{{ $metric->id }}</td>
                        <td>{{ $metric->url }}</td>
                        <td>{{ $metric->accessibility_metric }}</td>
                        <td>{{ $metric->pwa_metric }}</td>
                        <td>{{ $metric->performance_metric }}</td>
                        <td>{{ $metric->seo_metric }}</td>
                        <td>{{ $metric->best_practices_metric }}</td>
                        <td>{{ $metric->strategy->name }}</td>
                        <td>{{ $metric->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        ('#metricsTable').DataTable({
            paging: true,
            searching: true,
            ordering: true,
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/es-ES.json'
            }
        });
    })
</script>
@endpush