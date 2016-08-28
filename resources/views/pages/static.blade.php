@extends('layouts.master') @section('title','投票區') @section('pagename',$get->item) @section('content')
<?php

    $getItems = array();
    $getVotes = array();

    foreach(range(1,10) as $i){
        if(!empty($get['optionName'.$i])){
            $getItems[] = $get['optionName'.$i];
            $getVotes[] = $get['vote'.$i];
        }
    }
?>
    <canvas id="chart"></canvas>
    <script>
        console.log('抱歉! 直接顯示在圓餅圖上的%數，我想不出作法!!!');
    var ctx = document.getElementById("chart");
    var myNewChart = new Chart(ctx ,{
        type: 'pie', //bar
        data: {
            labels : ['{!!implode("','",$getItems)!!}'],
            datasets : [{ 
                label: '投票人數',
                data:[{{implode(',', $getVotes)}}],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)',
                    'rgba(153, 102, 255, 0.5)',
                    'rgba(255, 159, 64, 0.5)'
                ],
                hoverBackgroundColor: [
                    'rgba(255,99,132,1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                 ],
                borderWidth: 1        
            }],
        },options: {
            {{-- scales: {
                yAxes: [{
                    reverse: true,
                    ticks: {
                        beginAtZero:true
                    }
                }]
            }, --}}
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function(previousValue, currentValue, currentIndex, array) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var precentage = Math.floor(((currentValue/total) * 100)+0.5);     
                    return precentage + "%, 共得 "+currentValue+" 票";
                    }
                }
            }
        }
    });
</script> @endsection