<?php


namespace App\Modules\Stats\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Stats\Controllers\Traits\FilterTrait;
use App\Modules\Stats\DB\Seeds\PeoplesSeeder;
use App\Modules\Stats\Models\Regions\Peoples;
use App\Modules\Stats\Models\Regions\Region;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class PeoplesController extends Controller
{
    use FilterTrait;

    private $filters = [
        'source'
    ];
    private $moneyAttributes = [];
    private $betweenFilters = [
        'date' => [
            'from' => 'date_from',
            'to' => 'date_to'
        ],
        'count' => [
            'from' => 'count_from',
            'to' => 'count_to'
        ],
        'males' => [
            'from' => 'males_from',
            'to' => 'males_to'
        ],
        'females' => [
            'from' => 'females_from',
            'to' => 'females_to'
        ],
        'short' => [
            'from' => 'short_from',
            'to' => 'short_to'
        ],
        'tall' => [
            'from' => 'tall_from',
            'to' => 'tall_to'
        ],
    ];

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('stats::pages.peoples.table', [
            'models' =>
                $this->getQuery()
                    ->sortable()
                    ->paginate(50),
            'regions' => Region::all()
                ->pluck('name', 'id')
                ->toArray()
        ]);
    }

    public function reGenerate()
    {
        Region::query()->truncate();
        Peoples::query()->truncate();
        (new PeoplesSeeder())->run();
    }

    private function getQuery()
    {
        $query = Peoples::with('region');
        $query = $this->baseFilter($query);
        $query = $this->betweenFilter($query);
        if($region = request()->input('region',false)){
            $query->where('region_id','=',$region);
        }
        return $query;
    }

    public function charts()
    {
        return view('stats::pages.peoples.charts',
            [
                'data' => $this->getChartData()
            ]);
    }

    private function getChartData()
    {
        return Peoples::query()
            ->join('regions', 'regions.id', '=', 'peoples.region_id')
            ->orderBy(\DB::raw('RANDOM()'))
            ->limit(20)
            ->get()
            ->toJson();
    }
}
