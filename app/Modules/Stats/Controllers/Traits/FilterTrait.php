<?php


namespace App\Modules\Stats\Controllers\Traits;

use Illuminate\Database\Eloquent\Builder;

trait FilterTrait
{
    private function baseFilter(Builder $query)
    {
        $filters = $this->filters;
        foreach ($filters as $filter) {
            $data = request()->input($filter, null);
            if ($data) {
                $query->where($filter, 'like', "%$data%");
            }
        }
        return $query;
    }

    private function betweenFilter(Builder $query)
    {
        $filters = $this->betweenFilters;
        foreach ($filters as $filter => $inputs) {
            $from = request()->input($inputs['from'], null)
                * (in_array($filter, $this->moneyAttributes) ? 100 : 1);
            $to = request()->input($inputs['to'], null)
                * (in_array($filter, $this->moneyAttributes) ? 100 : 1);
            if ($from && $to) {
                $query->whereBetween($filter, [$from, $to]);
            } elseif ($from) {
                $query->where($filter, '>=', $from);
            } elseif ($to) {
                $query->where($filter, '<=', $to);
            }
        }
        return $query;
    }
}
