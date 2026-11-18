document.addEventListener('DOMContentLoaded', () => {
  const sidebar = document.getElementById('sidebar');
  const toggle = document.getElementById('menuToggle');
  if (toggle && sidebar) toggle.addEventListener('click', () => sidebar.classList.toggle('open'));

  const taskCanvas = document.getElementById('taskChart');
  if (taskCanvas && window.Chart) {
    new Chart(taskCanvas, {
      type: 'doughnut',
      data: {
        labels: ['Выполнено', 'В процессе', 'Запланировано'],
        datasets: [{
          data: [
            Number(taskCanvas.dataset.done || 0),
            Number(taskCanvas.dataset.process || 0),
            Number(taskCanvas.dataset.planned || 0)
          ],
          backgroundColor: ['#625cf2', '#35c99a', '#ffbd62'],
          borderWidth: 0,
          hoverOffset: 5
        }]
      },
      options: {
        maintainAspectRatio: false,
        cutout: '68%',
        plugins: { legend: { position: 'bottom', labels: { usePointStyle: true, boxWidth: 7, padding: 18, font: { family: 'Manrope', size: 10 } } } }
      }
    });
  }

  const gradeCanvas = document.getElementById('gradeChart');
  if (gradeCanvas && window.Chart) {
    let labels = [], values = [];
    try { labels = JSON.parse(gradeCanvas.dataset.labels || '[]'); values = JSON.parse(gradeCanvas.dataset.values || '[]'); } catch(e) {}
    new Chart(gradeCanvas, {
      type: 'bar',
      data: { labels, datasets: [{ label: 'Средняя оценка', data: values, backgroundColor: '#7c75f7', borderRadius: 7, maxBarThickness: 34 }] },
      options: {
        maintainAspectRatio: false,
        scales: { y: { min: 0, max: 5, ticks: { stepSize: 1 }, grid: { color: '#f0f2f7' } }, x: { grid: { display: false } } },
        plugins: { legend: { display: false } }
      }
    });
  }
});
