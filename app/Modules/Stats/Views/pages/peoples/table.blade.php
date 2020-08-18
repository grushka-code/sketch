@extends('layouts.app')

@section('content')
    <div class="container">
        @can('can_generate_peoples')
            <button class="btn btn-success" style="margin-botTom: 10px" id="generate">ReGenerate Data</button>
        @endcan
        <table class="table table-bordered table-hover ">
            <thead>
            <th>@sortablelink('id', 'Row Id')</th>
            <th>@sortablelink('date', 'Date')</th>
            <th style="width: 15%">@sortablelink('region.name', 'Region')</th>
            <th>@sortablelink('count', 'Total Count')</th>
            <th>@sortablelink('males', 'Males')</th>
            <th>@sortablelink('females', 'Females')</th>
            <th>@sortablelink('short', 'Short')</th>
            <th>@sortablelink('tall', 'Tall')</th>
            <th>@sortablelink('source', 'Source')</th>
            </thead>
            <tbody>
            <form class="form-inline" method="GET" action="{{route('stats.peoples')}}">
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
                                <select name="region" class="form-control">
                                    <option value="0">--//--</option>
                                    @foreach($regions as $id => $region)
                                        <option value="{{$id}}"
                                                @if(request('region') == $id) selected @endif>{{$region}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="count_from" class="form-control" value="{{request('count_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="count_to" class="form-control" value="{{request('count_to')}}"
                                       placeholder="To">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="males_from" class="form-control" value="{{request('males_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="males_to" class="form-control" value="{{request('males_to')}}"
                                       placeholder="To">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="females_from" class="form-control" value="{{request('females_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="females_to" class="form-control" value="{{request('females_to')}}"
                                       placeholder="To">
                            </label>
                        </td>
                        <td>
                            <label>
                                <input name="short_from" class="form-control"
                                       value="{{request('short_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="short_To" class="form-control"
                                       value="{{request('short_to')}}"
                                       placeholder="To">
                            </label>
                        </td>    <td>
                            <label>
                                <input name="tall_From" class="form-control"
                                       value="{{request('tall_from')}}"
                                       placeholder="From">
                            </label>
                            <label>
                                <input name="tall_to" class="form-control"
                                       value="{{request('tall_to')}}"
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
                    <td colspan="5">No regions To display.</td>
                </tr>
            @endif

            @foreach ($models as $model)
                <tr>
                    <td>{{ $model->id }}</td>
                    <td>{{ $model->date }}</td>
                    <td>{{ $model->region->name }}</td>
                    <td>{{ $model->count }}</td>
                    <td>{{ $model->males }} <sub style="color:green">{{round($model->males/$model->count*100.2)}}%</sub></td>
                    <td>{{ $model->females }}<sub style="color:green">{{round($model->females/$model->count*100.2)}}%</sub></td>
                    <td>{{ $model->short }}<sup style="color:green">{{round($model->short/$model->count*100.2)}}%</sup></td>
                    <td>{{ $model->tall }}<sup style="color:green">{{round($model->tall/$model->count*100.2)}}%</sup></td>
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
                    'url': '{{route('stats.peoples.regenerate')}}',
                    complete: function () {
                        window.location.reload();
                    }
                })
            });
        })()
    </script>
@endsection
