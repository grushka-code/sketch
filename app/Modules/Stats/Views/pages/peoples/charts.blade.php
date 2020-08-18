@extends('layouts.app')

@section('content')
    <div class="container">

        @can('can_generate_peoples')
            <button class="btn btn-success" style="margin-botTom: 10px" id="generate">ReGenerate Data</button>
        @endcan
        <h3>Charts</h3>
        <h4>For more look <a target="_blank"
                             href="https://developers.google.com/chart/interactive/docs/gallery">here</a></h4>

        <script type='text/javascript' src='https://www.gstatic.com/charts/loader.js'></script>
        <script type="text/javascript">
            google.charts.load('current', {'packages': ['corechart']});
            google.charts.setOnLoadCallback(drawVisualization);

            function getComboData() {
                let data = {!! $data !!},
                    rows = [];
                rows.push(
                    [
                        'Region',
                        'Male',
                        'Famale',
                        'Short',
                        'Tall',
                        'Average M/F',
                        'Average S/T',
                    ]
                );
                for (let i = 0; i <= 7; i++) {
                    let {females, males, name, short, tall} = data[i];

                    rows.push([
                        name,
                        males,
                        females,
                        short,
                        tall,
                        (females + tall) / 2,
                        (males + short) / 2,
                    ])
                }

                return rows;
            }

            function getPieData(options) {
                let data = {!! $data !!},
                    rows = [],
                    col1 = options[0],
                    col2 = options[1],

                    col1_sum = 0,
                    col2_sum = 0
                ;
                rows.push(
                    [
                        'Type',
                        'Sum'
                    ]
                );
                for (let i = 0; i < data.length; i++) {
                    col1_sum += data[i][col1];
                    col2_sum += data[i][col2];

                }
                rows.push(
                    [
                        col1[0].toUpperCase() + col1.slice(1),
                        col1_sum
                    ],
                    [
                        col2[0].toUpperCase() + col2.slice(1),
                        col2_sum
                    ],

                );

                return rows
            }
            function getDData() {
                let rand = () => { return Math.floor(Math.random() * Math.floor(100));}
                return [
                    ['Region', 'Data'],
                    ['Vinnytsia',rand()],
                    ['Lutsk',rand()],
                    ['Lysychansk',rand()],
                    ['Luhansk',rand()],
                    ['Dnipro',rand()],
                    ['Kryvyi Rih',rand()],
                    ['Nikopol',rand()],
                    ['Donetsk',rand()],
                    ['Horlivka',rand()],
                    ['Makiivka',rand()],
                    ['Mariupol',rand()],
                    ['Zhytomyr',rand()],
                    ['Uzhhorod',rand()],
                    ['Melitopol',rand()],
                    ['Kyiv',rand()]

                ];
            }

            function drawVisualization() {

                new google.visualization.ComboChart(document.getElementById('combo_chart'))
                    .draw(google.visualization.arrayToDataTable(getComboData()), {

                        vAxis: {title: 'Cups'},
                        hAxis: {title: 'Regions'},
                        width: 1200,
                        height: 600,
                        seriesType: 'bars',
                        series: {
                            4: {type: 'line'},
                            5: {type: 'line'}
                        }
                    });


                new google.visualization.PieChart(document.getElementById('pie_chart_1')).draw(google.visualization.arrayToDataTable(getPieData(['males', 'females'])), {

                    width: 600,
                    height: 400,
                });

                new google.visualization.PieChart(document.getElementById('pie_chart_2')).draw(google.visualization.arrayToDataTable(getPieData(['short', 'tall'])), {
                    is3D:true,
                    width: 600,
                    height: 400,
                    legend: 'none',
                    pieSliceText: 'label',
                });

                new google.visualization.PieChart(document.getElementById('d_chart'))
                    .draw(google.visualization.arrayToDataTable(getDData()), {
                        slices: {
                            1: {offset: 0.5},
                            4: {offset: 0.2},
                            7: {offset: 0.3},
                            12: {offset: 0.3},
                            14: {offset: 0.4},
                        },
                    width: 1200,
                    height: 600,
                });



            }
        </script>
        <div id="combo_chart"></div>
        <div class="row">
            <div class="col-md-6" id="pie_chart_1"></div>
            <div class="col-md-6" id="pie_chart_2"></div>
        </div>
        <div  id="d_chart"></div>
    </div>

    <script>
        (function () {
            $('#generate').on('click', function () {
                $.ajax({
                    'url': '{{route('stats.peoples.regenerate')}}',
                    complete: function () {
                        window.location.reload();
                    }
                })
            });
        })()
    </script>
@endsection
