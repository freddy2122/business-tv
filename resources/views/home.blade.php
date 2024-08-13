@extends('layouts.admin')

@section('content')
    @if (auth()->check() && auth()->user()->rule === 'admin')
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Utilisateurs inscrits</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            ({{ $users_count }})
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape  shadow text-center border-radius-md"
                                        style="background: #007bff">
                                        <i class="fa-solid fa-person"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total commentaires</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            ({{ $comment_count }})
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape  shadow text-center border-radius-md"style="background: #007bff">
                                        <i class="fa-solid fa-comment"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Messages total reçus</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            ()
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape  shadow text-center border-radius-md"style="background: #007bff">
                                        <i class="fa-solid fa-message"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Total des actualités</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            ({{ $news_count }})
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape  shadow text-center border-radius-md"style="background: #007bff">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="container-fluid py-4">
                        <div class="row">
                            <!-- Vos cartes existantes ici -->
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Statistiques du site</h5>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="trafficChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Ajouter le script pour le graphique -->

                </div>
            </div>
        </div>
    @endif
                    <script>
                        var ctx = document.getElementById('trafficChart').getContext('2d');
                        var trafficChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Exemple de labels
                                datasets: [{
                                    label: 'Visites du site',
                                    data: [30, 45, 60, 50, 70, 65], // Exemple de données
                                    backgroundColor: 'rgba(0, 123, 255, 0.2)',
                                    borderColor: 'rgba(0, 123, 255, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script>
@endsection
