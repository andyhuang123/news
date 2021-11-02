<canvas id="doughnut" width="200" height="200"></canvas>
<script>
$(function () {

    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    {{  $gender['0'] }},
                    {{  $gender['1'] }}
                ],
                backgroundColor: [
                    'rgb(54, 162, 235)',
                    'rgb(255, 99, 132)' 
                ]
            }],
            labels: [
                '未订阅',
                '已订阅'
                
            ]
        },
        options: {
            maintainAspectRatio: false
        }
    };

    var ctx = document.getElementById('doughnut').getContext('2d');
    new Chart(ctx, config);
});
</script>