const mockData = {
  totalAppointments: 120,
  activeUsers: 45,
  traffic: 300,
  appointmentsOverTime: [10, 20, 30, 25, 15, 40, 50],
  trafficSources: [120, 80, 100]
};

document.getElementById('totalAppointments').textContent = mockData.totalAppointments;
document.getElementById('activeUsers').textContent = mockData.activeUsers;
document.getElementById('traffic').textContent = mockData.traffic;

const appointmentsCtx = document.getElementById('appointmentsChart').getContext('2d');
new Chart(appointmentsCtx, {
  type: 'line',
  data: {
    labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
    datasets: [{
      label: 'Appointments',
      data: mockData.appointmentsOverTime,
      borderColor: '#ff8da1',
      backgroundColor: 'rgba(255, 141, 161, 0.2)',
      fill: true
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});

const trafficCtx = document.getElementById('trafficChart').getContext('2d');
new Chart(trafficCtx, {
  type: 'pie',
  data: {
    labels: ['Direct', 'Referral', 'Search'],
    datasets: [{
      data: mockData.trafficSources,
      backgroundColor: ['#ff8da1', '#e72851', '#f5a9b8']
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false
  }
});
