@extends('layouts.app')

@section('content')
    <div class="container">

        @can('can_generate_prices')
            <button class="btn btn-success" style="margin-botTom: 10px" id="generate">ReGenerate Data</button>
        @endcan
        <h3>Charts</h3>
        <h4>For more look <a target="_blank" href="https://developers.google.com/chart/interactive/docs/gallery">here</a></h4>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            // Load the Visualization API and the corechart package.
            google.charts.load('current', {'packages': ['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            function generateData(column) {
                let baseDate ={!! $data !!},
                    data = [];
                for (let row in baseDate) {
                    data.push([baseDate[row].data, baseDate[row].price_uah/100, baseDate[row][column]])
                }
                return data;
            }

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
                let charts = {
                    'price_bitcoin': 'Price Bitcoin',
                    'price_usd': 'Price USD',
                    'price_eur': 'Price Eur',

                };

                for (let column in charts) {
                    let data = new google.visualization.DataTable();

                    data.addColumn('string', 'Date');
                    data.addColumn('number', 'Price UAH');
                    data.addColumn('number', charts[column])

                    data.addRows(generateData(column));


                    // Instantiate and draw our chart, passing in some options.
                    let chart = new google
                        .visualization
                        .ComboChart(document.getElementById('chart_' + column +'_1'))
                        .draw(data, {
                            'title': 'TestChart',
                            'width': 600,
                            'curveType': 'function',
                            'height': 400,
                            seriesType: 'bars',
                            colors: ['#15e00e', '#ea092a', '#ec8f6e', '#f3b49f', '#f6c7b6'],
                        });


                   new google
                       .visualization
                       .AreaChart(document.getElementById('chart_' + column +'_2'))
                       .draw(data, {
                           'title': 'TestChart',
                           'width': 600,
                           'curveType': 'function',
                           'height': 400,
                           lineWidth: 3,
                           colors: ['#15e00e', '#09ead7', '#ec6e6e', '#9ff3e2', '#f6c7b6'],
                       });

                   new google
                       .visualization
                       .BarChart(document.getElementById('chart_' + column +'_3'))
                       .draw(data, {
                           'title': 'TestChart',
                           'width': 600,
                           'curveType': 'function',
                           'height': 400,
                           isStacked: true,
                       });

                }
                // Create the data table.


            }
        </script>
        <div class="row">
            @foreach([
                "chart_price_bitcoin_1",
                "chart_price_bitcoin_2",
                "chart_price_bitcoin_3",
                "chart_price_eur_1",
                "chart_price_eur_2",
                "chart_price_eur_3",
                "chart_price_usd_1",
                "chart_price_usd_2",
                "chart_price_usd_3",
                ] as $id)
                <div class="col-md-6" id="{{$id}}"></div>
            @endforeach
        </div>
    </div>

    <script>
        (function () {
            $('#generate').on('click', function () {
                $.ajax({
                    'url': '{{route('stats.prices.regenerate')}}',
                    complete: function () {
                        window.location.reload();
                    }
                })
            });
        })()
    </script>
@endsection
