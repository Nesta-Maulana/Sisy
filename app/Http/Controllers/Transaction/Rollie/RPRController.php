<?php

namespace App\Http\Controllers\Transaction\Rollie;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Transaction\Rollie\Palet;
Use App\Models\Transaction\Rollie\WoNumber;
use App\Models\Master\Product;

use App\Models\Transaction\Rollie\CppHead;
use App\Models\Transaction\Rollie\CppDetail;

class RPRController extends Controller
{
    public function exportBar(Request $request)
    {
        $bar_number     = $request['data_bar'][1]['__EMPTY_8'];
        // unset($request['data_bar'][0]);
        // unset($request['data_bar'][1]);
        // unset($request['data_bar'][2]);
        // unset($request['data_bar'][3]);
        // unset($request['data_bar'][4]);
        // unset($request['data_bar'][5]);
        // unset($request['data_bar'][6]);
        // unset($request['data_bar'][7]);
        $array_product   = array();
        
        foreach ($request['data_bar'] as $key => $value) 
        {
            if ($key > 6) 
            {
                $product['oracle_code']         = $value['__EMPTY_1'];
                $product['product_name']        = $value['__EMPTY_2'];
                $product['lot_number']          = $value['__EMPTY_4'];
                $product['bar_status']          = $value['__EMPTY_5'];
                $product['bar_date']            = $value['__EMPTY_6'];
                array_push($array_product,$product);
            }
        }
        $fail_update                = '';
        foreach ($array_product as $list_lot) 
        {
            $explode_lot            = explode('-',$list_lot['lot_number']);
            $lot_numbers            = CppDetail::where('lot_number',$explode_lot[0])->first();
            $palets                 = $lot_numbers->palets->where('palet',$explode_lot[1])->first();
            $bar_date               = date('Y-m-d',strtotime($list_lot['bar_date']));
            if (is_null($palets->bar_number))
            {
            }
            $palets->bar_number     = $bar_number;
            $palets->bar_status     = $list_lot['bar_status'];
            $palets->bar_date       = $bar_date;
            $palets->save();
            /*else
            {
                $fail_update        .= ' Palet '.$palets->palet.' ';
            } */
        }
        return ['success'=>true,'message'=>'Data berhasil diupload'];
    }
}
