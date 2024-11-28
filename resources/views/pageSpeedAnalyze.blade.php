@extends('layouts.app')

@section('title', 'Desafio - Broobe | Inicio')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-dark">Broobe URL Analizer</h2>

    <form id="form-analyzer">

        @csrf

        <div class="mb-3">
            <label for="url" class="form-label text-dark">URL:</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Ingrese la url que desea analizar" required>
        </div>

        <div class="mb-3">
            <label for="strategy" class="form-label text-dark">Estrategia:</label>
            <select class="form-select" id="strategy" name="strategy" required>
                <option value="" disabled selected>Selecciona una estrategia...</option>
                @foreach($strategies as $name => $id)
                    <option value="{{ $name }}" data-id="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class=" form-label text-dark">Categorias:</label><br>
            @foreach($categories as $category)
                <input type="checkbox" id="{{$category}}" name="categories[]" value="{{$category}}">
                <label class="text-dark" for="{{$category}}">{{$category}}</label><br>
            @endforeach
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg">Obtener Métricas</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function(){
        let obtainedData = null;
        let csrf = $('meta[name="csrf-token"]').attr('content');

        $('#form-analyzer').on('submit', function (e) {
            e.preventDefault();
            var data = $(this).serialize();
            $.ajax({
                url: '{{ route("analizar.url") }}',
                method: 'POST',
                data: data,
                beforeSend: function () {
                    $('#loadingModalLabel').text('Por favor, espera');
                    $('#modal-body-content').html(`
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Cargando...</span>
                        </div>
                        <p class="mt-3">Estamos procesando los datos...</p>
                    `);
                    $('#modal-footer-buttons').hide();
                    $('#loadingModal').modal('show');
                },
                success: function (response) {
                if (response['ok']) {
                    obtainedData = {'url':response['data']['id'], 'categories':{}, 'strategy_id': $('#strategy option:selected').data('id')};
                    const categories = response['data']['lighthouseResult']['categories'];
                    const labels = [];
                    const scores = [];
                    for (const key in categories) {
                        obtainedData['categories'][categories[key].id] = categories[key].score;
                        labels.push(categories[key].title);
                        scores.push((categories[key].score * 100).toFixed(2));
                    }
                    $('#loadingModalLabel').text('Resultados del Análisis');
                    $('#modal-body-content').html(`
                        <canvas id="metricsChart" width="400" height="200"></canvas>
                    `);
                    $('#modal-footer-buttons').show();
                    const ctx = document.getElementById('metricsChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Puntuaciones (%)',
                                data: scores,
                                backgroundColor: [
                                    '#4caf50',
                                    '#2196f3',
                                    '#ffc107',
                                    '#f44336'
                                ],
                                borderColor: [
                                    '#388e3c',
                                    '#1976d2',
                                    '#ffa000',
                                    '#d32f2f'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    max: 100
                                }
                            }
                        }
                    });
                    $('#form-analyzer')[0].reset(); // Reiniciar los campos del formulario
                } else {
                    $('#loadingModal').modal('hide');
                    Swal.fire({
                        title: response['error'],
                        text: response['details'],
                        icon: 'error'
                    });
                }
                },
                error: function (error) {
                    $('#loadingModal').modal('hide');
                    Swal.fire({
                        title:error.responseJSON.message || 'Algo salió mal!',
                        icon:'error'
                    })
                }
            });
        });

        $('#saveMetricsButton').on('click', function () {
            if (obtainedData)
            {
                $.ajax({
                    url: '{{route("guardarMetrica.url")}}',
                    method: 'POST',
                    data: {'data': obtainedData, '_token': csrf},
                    success: function(response){
                        $('#loadingModal').modal('hide');
                        if(response['ok'])
                        {
                            Swal.fire({
                                title: response['message'],
                                icon: 'success'
                            })
                        } else {
                            Swal.fire({
                                title: response['error'],
                                icon: 'error'
                            })
                        }
                    },
                    error: function(error){
                        $('#loadingModal').modal('hide');
                        Swal.fire({
                        title:error.responseJSON.message || 'Algo salió mal!',
                        icon:'error'
                    })
                    }
                })
            } else {
                Swal.fire({
                        title:'No hay datos para guardar!',
                        icon:'error'
                    });
            }
        });
    })
</script>
@endpush
