<?php


namespace App\Modules\Stats\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Stats\Controllers\Traits\FilterTrait;
use App\Modules\Stats\DB\Seeds\PricesSeeder;
use App\Modules\Stats\Models\{Products\Prices, Products\Products};
use Illuminate\Contracts\{Foundation\Application, View\Factory};
use Illuminate\View\View;

class PricesController extends Controller
{
    use FilterTrait;

    private $filters = [
        'source'
    ];

    private $moneyAttributes = [
        'price_uah',
        'price_usd',
        'price_eur',
    ];

    private $betweenFilters = [
        'date' => [
            'from' => 'date_from',
            'to' => 'date_to'
        ],
        'price_uah' => [
            'from' => 'price_uah_from',
            'to' => 'price_uah_to'
        ],
        'price_usd' => [
            'from' => 'price_usd_from',
            'to' => 'price_usd_to'
        ],
        'price_eur' => [
            'from' => 'price_eur_from',
            'to' => 'price_eur_to'
        ],
        'price_bitcoin' => [
            'from' => 'price_bitcoin_from',
            'to' => 'price_bitcoin_to'
        ],
    ];

    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('stats::pages.prices.table', [
            'models' =>
                $this->getQuery()
                    ->sortable()
                    ->paginate(50),
            'products' => Products::all()
                ->pluck('name', 'id')
                ->toArray()
        ]);
    }

    public function reGenerate()
    {
        Prices::query()->truncate();
        Products::query()->truncate();
        (new PricesSeeder())->run();
    }

    public function charts()
    {
        return view('stats::pages.prices.charts',
            [
                'data' => $this->getChartData()
            ]);
    }

    private function getQuery()
    {
        $query = Prices::with('product');
        $query = $this->baseFilter($query);
        $query = $this->betweenFilter($query);
        if($product = request()->input('product',false)){
            $query->where('product_id','=',$product);
        }
        return $query;
    }

    private function getChartData()
    {
        return Prices::query()
            ->join('products', 'products.id', '=', 'prices.product_id')
            ->orderBy(\DB::raw('RANDOM()'))
            ->limit(20)
            ->get()
            ->toJson();
    }
}
