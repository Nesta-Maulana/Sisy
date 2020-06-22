<?php

namespace App\Http\Controllers\Master\Rollie;

use App\Models\Master\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
class ProductController extends ResourceController
{

    public function manageProduct(Request $request)
    {
        $product_id                        = $request->product_id;
        $product_name                      = $request->product_name;  
        $oracle_code                       = $request->oracle_code; 
        $subbrand_id                       = $this->decrypt($request->subbrand_id); 
        $product_type_id                   = $this->decrypt($request->product_type_id); 
        $filling_machine_group_head_id     = $this->decrypt($request->filling_machine_group_head_id); 
        $expired_range                     = $request->expired_range; 
        $trial_code                        = $request->trial_code; 
        $spek_ts_min                       = $request->spek_ts_min; 
        $spek_ts_max                       = $request->spek_ts_max; 
        $spek_ph_min                       = $request->spek_ph_min; 
        $spek_ph_max                       = $request->spek_ph_max; 
        $sla                               = $request->sla; 
        $waktu_analisa_mikro               = $request->waktu_analisa_mikro; 
        $inkubasi                          = $request->inkubasi; 
        $is_active                         = $request->is_active;    
        if (is_null($product_id)) 
        {
            $cekAkses   = $this->checkAksesTambah(\Request::getRequestUri(),'master_app.master_data.manage_products');
            if ($cekAkses['success']) 
            {
                $cekProduct     = Product::where('oracle_code',$oracle_code)->first();
                if (is_null($cekProduct)) 
                {
                    /*ini untuk penambahan produk baru nya*/
                    $newProduct = Product::create([
                                    'product_name'                  => $product_name,
                                    'oracle_code'                   => $oracle_code,
                                    'subbrand_id'                   => $subbrand_id,
                                    'product_type_id'               => $product_type_id,
                                    'filling_machine_group_head_id' => $filling_machine_group_head_id,
                                    'expired_range'                 => $expired_range,
                                    'trial_code'                    => $trial_code,
                                    'spek_ts_min'                   => $spek_ts_min,
                                    'spek_ts_max'                   => $spek_ts_max,
                                    'spek_ph_min'                   => $spek_ph_min,
                                    'spek_ph_max'                   => $spek_ph_max,
                                    'sla'                           => $sla,
                                    'waktu_analisa_mikro'           => $waktu_analisa_mikro,
                                    'inkubasi'                      => $inkubasi,
                                    'is_active'                     => $is_active
                                ]);
                    return redirect(route('master_app.master_data.manage_products'))->with('success',$newProduct->product_name.' berhasil ditambahkan ke list product');
                } 
                else 
                {
                    return redirect()->back()->with('error','Produk dengan kode oracle '.$oracle_code.' sudah terdaftar dengan nama produk'.$cekProduct->product_name);
                }
                
            }
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
            
        } 
        else 
        {
            $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_products');
            if ($cekAkses['success']) 
            {
                $cekProduct     = Product::where('oracle_code',$oracle_code)->first();
                $product        = Product::find($this->decrypt($product_id));
                if (!is_null($cekProduct) && $cekProduct->id !== $product->id) 
                {
                    return redirect()->back()->with('error','Produk dengan kode oracle '.$oracle_code.' sudah terdaftar dengan nama produk'.$cekProduct->product_name.' harap mengecek kembali data yang ingin anda ubah. Data produk '.$product->product_name.'gagal diubah.');
                }
                else
                {

                    $old_product_name                               = $product->product_name;
                    $product->product_name                          = $product_name;
                    $product->oracle_code                           = $oracle_code;
                    $product->subbrand_id                           = $subbrand_id;
                    $product->product_type_id                       = $product_type_id;
                    $product->filling_machine_group_head_id         = $filling_machine_group_head_id;
                    $product->expired_range                         = $expired_range;
                    $product->trial_code                            = $trial_code;
                    $product->spek_ts_min                           = $spek_ts_min;
                    $product->spek_ts_max                           = $spek_ts_max;
                    $product->spek_ph_min                           = $spek_ph_min;
                    $product->spek_ph_max                           = $spek_ph_max;
                    $product->sla                                   = $sla;
                    $product->waktu_analisa_mikro                   = $waktu_analisa_mikro;
                    $product->inkubasi                              = $inkubasi;
                    $product->is_active                             = $is_active;
                    $product->save();
                    return redirect(route('master_app.master_data.manage_products'))->with('success','Data produk dengan nama produk '.$old_product_name.' berhasil diubah');
                }
            } 
            else 
            {
                return redirect()->back()->with('error',$cekAkses['message']);
            }
            
        }
        
    }

    public function editProduct($product_id)
    {
        $cekAkses   = $this->checkAksesUbah(\Request::getRequestUri(),'master_app.master_data.manage_products');
        if ($cekAkses['success']) {
            $product            = Product::find($this->decrypt($product_id));
            $product            = $this->encryptId($product,'subbrand_id','filling_machine_group_head_id','product_type_id');
            $product->success   = true;
            return $product;
        } else {
            return $cekAkses;
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Master\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Master\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Master\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Master\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
