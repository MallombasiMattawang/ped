<canvas id="donat_status_sap" style="width: 100%;"></canvas>
<script>
$(function () {

    function randomScalingFactor() {
        return Math.floor(Math.random() * 100)
    }

    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
       
    };

    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    
                ],
                backgroundColor: [
                    window.chartColors.red,
                    window.chartColors.orange,
                    
                ],
                label: 'Dataset 1'
            }],
            labels: [
                'GR',
                'PO'
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'OVERVIEW STATUS SAP'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    var ctx = document.getElementById('donat_status_sap').getContext('2d');
    new Chart(ctx, config);
});
</script>