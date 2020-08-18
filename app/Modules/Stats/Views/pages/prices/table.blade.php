@extends('layouts.app')

@section('content')
    <div class="container">
        @can('can_generate_prices')
            <button class="btn btn-success" style="margin-botTom: 10px" id="generate">ReGenerate Data</button>
        @endcan
        <table class="table table-bordered table-hover ">
            <thead>
            <th>@sortablelink('id', 'Row Id')</th>
            <th>@sortablelink('date', 'Date')</th>
            <th style="width: 15%">@sortablelink('product.name', 'Product')</th>
            <th>@sortablelink('price_uah', 'Price UAH')</th>
            <th>@sortablelink('price_usd', 'Price USD')</th>
            <th>@sortablelink('price_eur', 'Price EUR')</th>
            <th>@sortablelink('price_bitcoin', 'Price Bitcoin')</th>
            <th>@sortablelink('source', 'Source')</th>
            </thead>
            <tbody>
            <form class="form-inline" method="GET" action="{{route('stats.prices')}}">
                <div class="form-group">
                    <tr>
                        <td></td>
                        <td>
                            <label>
                                <input name="date_from" class="form-control" value="{{request('date_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="date_to" class="form-control" value="{{request('date_to')}}"
                                       placeholder="To">
                            </label>
                        </td>
                        <td>
                            <label>
                                <select name="product" class="form-control">
                                    <option value="0">--//--</option>
                                    @foreach($products as $id => $product)
                                        <option value="{{$id}}"
                                                @if(request('product') == $id) selected @endif>{{$product}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="price_uah_from" class="form-control" value="{{request('price_uah_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="price_uah_to" class="form-control" value="{{request('price_uah_to')}}"
                                       placeholder="To">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="price_usd_from" class="form-control" value="{{request('price_usd_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="price_usd_to" class="form-control" value="{{request('price_usd_to')}}"
                                       placeholder="To">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="price_eur_from" class="form-control" value="{{request('price_eur_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="price_eur_to" class="form-control" value="{{request('price_eur_to')}}"
                                       placeholder="To">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="price_bitcoin_From" class="form-control" value="{{request('price_bitcoin_From')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="price_bitcoin_To" class="form-control" value="{{request('price_bitcoin_To')}}"
                                       placeholder="To">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="source" class="form-control" value="{{request('source')}}"
                                       placeholder="Source">
                            </label>
                            <button class="btn btn-primary">Filter</button>
                        </td>
                    </tr>
                </div>
            </form>
            @if ($models->count() == 0)
                <tr>
                    <td colspan="5">No products To display.</td>
                </tr>
            @endif

            @foreach ($models as $model)
                <tr>
                    <td>{{ $model->id }}</td>
                    <td>{{ $model->date }}</td>
                    <td>{{ $model->product->name }}</td>
                    <td>{{ ($model->price_uah/100) }}</td>
                    <td>{{ round($model->price_usd/100,2) }}</td>
                    <td>{{ round($model->price_eur/100,2) }}</td>
                    <td>{{ $model->price_bitcoin }}</td>
                    <td>{{ $model->source }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {!! $models->appends(request()->except('page'))->render() !!}

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
