<div class="modal fade show" id="analisaPiSampelModal" {{-- tabindex="-1" --}} role="dialog" aria-labelledby="analisaSampelModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title" id="analisaPiSampelModalLabel">Analisa Sampel Pi <label  id="nama_produk_analisa_pi"></label></h5>
                <button type="button" id="close-button-pi" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rpd_filling_detail_id_pi">
                <input type="hidden" id="wo_id_sampel">
                <input type="hidden" id="mesin_filling_id_sampel">
                <input type="hidden" id="nama_produk_analisa_pi_kirim">
                <div id="event-point" style="border-bottom: 1px solid black; padding-bottom: 1rem;">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="text-center" style="border-top: 1px solid black; border-bottom: 1px solid black">
                                <h5 class="mt-2">Event Point</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-7 col-md-7 col-sm-7">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label for="sampel_pi_analisa">Kode Sampel</label>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <input type="text" name="sampel_pi_analisa" id="sampel_pi_analisa" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <label for="mesin_filling_pi_analisa">Mesin Filling</label>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <input type="text" name="mesin_filling_pi_analisa" id="mesin_filling_pi_analisa" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-7 col-md-7 col-sm-7">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4">
                                    <label for="tanggal_filling_pi_analisa" class="">Tanggal Filling</label>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <input type="text" name="tanggal_filling_pi_analisa" id="tanggal_filling_pi_analisa" value="" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <label for="jam_filling_pi_analisa">Jam Filling</label>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <input type="text" name="jam_filling_pi_analisa" id="jam_filling_pi_analisa" value="07:02:00" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="parameter-analisa" class="mt-4">
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_overlap">Overlap (3.5-4.5)</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" name="hasil_overlap" inputmode="decimal" pattern="[0-9]*" id="hasil_overlap" class="form-control" maxlength="4" max="5" min="3" autocomplete="off" onfocusout="cekOverlap()" required>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <small class="form-text text-muted" id="batas_overlap_text">*</small>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_ls_sa_proportion">LS/SA Proportion</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" class="form-control" inputmode="tel" id="hasil_ls_sa_proportion" name="hasil_ls_sa_proportion" maxlength="5" placeholder="Ex : 40:60" autocomplete="off" onfocusout="cekLsSaProportion()">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <small class="form-text text-muted" >Di isi dengan Angka dengan format XX:XX</small>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_volume_kanan">Hasil Volume Kanan</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <input type="text" inputmode="numeric" class=" form-control" name="hasil_volume_kanan" id="hasil_volume_kanan" maxlength="3" placeholder="Ex : 200" onkeypress="return event.charCode >= 48 && event.charCode <= 57" autocomplete="off" onfocusout="cekHasilKoreksi()">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <small class="form-text text-muted" >Batas Min. 198 Batas Max. 200</small>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_volume_kiri">Hasil Volume Kiri</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 ">
                            <input type="text" inputmode="numeric" class="form-control" name="hasil_volume_kiri" id="hasil_volume_kiri" maxlength="3" placeholder="Ex : 200" onkeypress="return event.charCode >= 48 && event.charCode <= 57" autocomplete="off" onfocusout="cekHasilKoreksi()">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <small class="form-text text-muted" >Batas Min. 198 Batas Max. 200</small>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div  class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_air_gap">Airgap (Max. 1mm)</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_air_gap" id="hasil_air_gap" class="select form-control" style="padding: 0 .8rem;" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_ts_accurate_kanan">TS Accurate Kanan</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8" id="hasil_ts_accurate_kanan_div">
                            <select name="hasil_ts_accurate_kanan" id="hasil_ts_accurate_kanan" class="select form-control" required="true" onchange="cekTsAccurateKanan()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden" id="ts_accurate_kanan_tidak_ok_div">
                            <select name="ts_accurate_kanan_tidak_ok" id="ts_accurate_kanan_tidak_ok" class="select form-control"required="true">
                                <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                                <option value="Block Seal">Block Seal</option>
                                <option value="Crack">Crack</option>
                                <option value="Plastic Lump">Plastic Lump</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_ts_accurate_kiri" >TS Accurate Kiri</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8" id="hasil_ts_accurate_kiri_div">
                            <select name="hasil_ts_accurate_kiri" id="hasil_ts_accurate_kiri" class="select form-control" required="true" onchange="cekTsAccurateKiri()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden" id="ts_accurate_kiri_tidak_ok_div">
                            <select name="ts_accurate_kiri_tidak_ok" id="ts_accurate_kiri_tidak_ok" class="select form-control" required="true">
                                <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                                <option value="Block Seal">Block Seal</option>
                                <option value="Crack">Crack</option>
                                <option value="Plastic Lump">Plastic Lump</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_ls_accurate">LS Accurate</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8" id="hasil_ls_accurate_div">
                            <select name="hasil_ls_accurate" id="hasil_ls_accurate" class="select form-control" required="true" onchange="cekLsAccurate()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden" id="ls_accurate_tidak_ok_div">
                            <select name="ls_accurate_tidak_ok" id="ls_accurate_tidak_ok" class="select form-control" required="true">
                                <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                                <option value="Block Seal">Block Seal</option>
                                <option value="Strip Wrinkle">Strip Wrinkle</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_sa_accurate">SA Accurate</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8" id="hasil_sa_accurate_div">
                            <select name="hasil_sa_accurate" id="hasil_sa_accurate" class="select form-control" required="true" onchange="cekSaAccurate()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden" id="sa_accurate_tidak_ok_div">
                            <select name="sa_accurate_tidak_ok" id="sa_accurate_tidak_ok" class="select form-control" required="true">
                                <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                                <option value="Block Seal">Block Seal</option>
                                <option value="Strip Wrinkle">Strip Wrinkle</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_surface_check" >Surface Check</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8" id="hasil_surface_check_div">
                            <select name="hasil_surface_check" id="hasil_surface_check" class="select form-control" required="true" onchange="cekSurfaceCheck()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 hidden" id="surface_check_tidak_ok_div">
                            <select name="surface_check_tidak_ok" id="surface_check_tidak_ok" class="select form-control" required="true">
                                <option value="#ok" selected disabled>Pilih Kategori #OK</option>
                                <option value="Block Seal">Block Seal</option>
                                <option value="Strip Wrinkle">Strip Wrinkle</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_pinching">Pinching</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_pinching" id="hasil_pinching" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_strip_folding">Strip Folding</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_strip_folding" id="hasil_strip_folding" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_konduktivity_kanan">Konduktivity Kanan</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_konduktivity_kanan" id="hasil_konduktivity_kanan" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_konduktivity_kiri">Konduktivity Kiri</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_konduktivity_kiri" id="hasil_konduktivity_kiri" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_design_kanan">Design Kanan</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_design_kanan" id="hasil_design_kanan" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_design_kiri">Design Kiri</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_design_kiri" id="hasil_design_kiri" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_dye_test">Dye Test*</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_dye_test" id="hasil_dye_test" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_residu_h2o2">Residu H2O2 (Maks. 0,5 ppm)</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_residu_h2o2" id="hasil_residu_h2o2" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_prod_code_no_md">Prod Code & No Md</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select name="hasil_prod_code_no_md" id="hasil_prod_code_no_md" class="select form-control" required="true" onchange="cekHasilKoreksi()">
                                <option value="OK" selected>OK</option>
                                <option value="#OK">#OK</option>
                                <option value="-">-</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_correction" >Correction</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <textarea name="hasil_correction" id="hasil_correction" cols="30" rows="5" class="form-control" required>-</textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <button class="btn btn-primary form-control" onclick="submitAnalisaPi()">
                                Input Hasil Analisa
                            </button>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
{{-- 
                <hr>
            </div>

            <div class="modal-footer bg-dark">
                
            </div>
        </div>
    </div>
</div> --}}