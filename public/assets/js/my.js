document.addEventListener("DOMContentLoaded", function () {
    let salesData = @json($sales);

    // 💡 إعداد البيانات للمخطط
    let dates = salesData.map(s => s.date);
    let totals = salesData.map(s => s.total_sales);

    new Chart(document.getElementById('salesChart'), {
        type: 'bar',
        data: {
            labels: dates,
            datasets: [{
                label: '💰 المبيعات اليومية',
                data: totals,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: { beginAtZero: true }
            }
        }
    });

    // 💡 تحسين الجدول
    $('#salesTable').DataTable();
});