<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home - SeekMed</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  @vite('resources/css/home.css')
  @vite('resources/js/analytics.js')
  @livewireStyles
</head>
<body>
    <header>
        <x-nav/>
    </header>

    <main class="analytics-container">
    <div class="stats-cards">
        <div class="stats-card">
            <h3>Total Appointments</h3>
            <p id="totalAppointments">0</p>
        </div>
        <div class="stats-card">
            <h3>Active Users</h3>
            <p id="activeUsers">0</p>
        </div>
        <div class="stats-card">
            <h3>Traffic</h3>
            <p id="traffic">0</p>
        </div>
    </div>

    <div class="charts">
        <div class="chart-box">
            <h2>Appointments Over Time</h2>
            <canvas id="appointmentsChart"></canvas>
        </div>
        <div class="chart-box">
            <h2>Traffic Sources</h2>
            <canvas id="trafficChart"></canvas>
        </div>
    </div>
    <livewire:search-user/>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="analytics.js"></script>
    @livewireScripts
</body>