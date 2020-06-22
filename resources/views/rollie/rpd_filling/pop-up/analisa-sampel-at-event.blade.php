<div class="modal fade bd-example-modal-lg" id="analisaSampleAtEvent" tabindex="-1" role="dialog" aria-labelledby="analisaSample" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title">Hasil Analisa At Event Produk <span id="nama_produk_analisa_at_event"></span></h5>
                <button type="button" id="close-button-at-event" class="close" data-dismiss="modal" onclick="resetPiAtEvent()">
                   <span aria-hidden="true"> &times; </span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rpd_filling_detail_id_at_event">
                <input type="hidden" id="wo_id_sampel_event">
                <input type="hidden" name="user_id_inputer" id="user_id_inputer" value="{{-- {{ app('App\Http\Controllers\ResourceController')->enkripsi(Auth::user()->id) }} --}}">
                <div id="eventpoint" style="border-bottom: 1px solid black; padding-bottom: 1rem;">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center" style="border-top: 1px solid black; border-bottom: 1px solid black">
                                <h5 class="mt-2">Event Point</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-lg-7 col-md-7 col-sm-7">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <label for="sampel_at_event" >Kode Sampel</label>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <input type="text" name="sampel_at_event" id="sampel_at_event" class="form-control" readonly>
                                    <input type="hidden" name="sampel_at_event" id="sampel_at_event_kode" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <label for="mesin_filling_at_event">Mesin Filling</label>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <input type="text" name="mesin_filling_at_event" id="mesin_filling_at_event" class="form-control" readonly>
                                    <input type="hidden" name="mesin_filling_at_event" id="mesin_filling_at_event_id" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-7 col-md-7 col-sm-7">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <label for="tanggal_filling_at_event" class="">Tanggal Filling</label>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <input type="text" name="tanggal_filling_at_event" id="tanggal_filling_at_event" value="" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5">
                                    <label for="jam_filling_at_event">Jam Filling</label>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7">
                                    <input type="text" name="jam_filling_at_event" id="jam_filling_at_event" value="07:02:00" class="form-control" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="parameter-analisa" class="mt-4" style="border-bottom: 1px solid black; padding-bottom: 1rem;">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_ls_sa_proportion">LS/SA Proportion</label>
                        </div>
                        <div class="col-lg-4 col-md-4 col sm-4">
                            <input type="text" inputmode="tel" class="form-control" name="hasil_ls_sa_proportion" id="hasil_ls_sa_proportion_event" maxlength="5" placeholder="Ex : 40:60" onfocusout="status_akhir_at_event($('#sampel_at_event_kode').val())">
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <small class="form-text text-muted">Di isi dengan Angka dengan format XX:XX</small>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <label for="hasil_ls_sa_sealing_quality">LS/SA Sealing Quality</label>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_ls_sa_sealing_quality" id="hasil_ls_sa_sealing_quality_event" class="select form-control" {{-- style="padding: 0 .8rem;" --}} required="true">
                                <option disabled selected>-- Status LS/SA Sealing Quality --</option>
                                <option value="OK">OK</option>
                                <option value="#OK">#OK</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="custom_input">
                    <div id="paper_splicing" class="hidden" style="border-bottom: 1px solid black; padding-bottom: 1rem;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center" style="border-bottom: 1px solid black;">
                                    <h5 class="mt-2">Paper Splicing</h5>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="hasil_sideway_sealing_alignment">Sideway sealing alignment (0-0.5)</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" name="hasil_sideway_sealing_alignment" id="hasil_sideway_sealing_alignment_event" class="form-control" maxlength="3" onfocusout="status_akhir_at_event($('#sampel_at_event_kode').val())" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <small class="form-text text-muted">Batas Min. 0 batas Max. 0.5</small>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="hasil_overlap">Overlap (16-17)</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" name="hasil_overlap" id="hasil_overlap_event" class="form-control" onfocusout="status_akhir_at_event($('#sampel_at_event_kode').val())" maxlength="5" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <small class="form-text text-muted">Batas Min. 16 Batas Max. 17</small>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="hasil_package_length">Package Length</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <input type="number" name="hasil_package_length" id="hasil_package_length_event" class="form-control" onfocusout="status_akhir_at_event($('#sampel_at_event_kode').val())" maxlength="6" onkeypress="return event.charCode >= 46 && event.charCode <= 57 && event.charCode !== 47" required>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <small class="form-text text-muted">Batas Min. 118.5 Batas Max. 119.5</small>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="hasil_paper_splice_sealing_quality">Paper Splice Sealing Quality</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_paper_splice_sealing_quality" id="hasil_paper_splice_sealing_quality_event" class="select form-control" required="true">
                                    <option disabled selected>-- Status Paper Sealing Quality --</option>
                                    <option value="OK">OK</option>
                                    <option value="#OK">#OK</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="hasil_no_kk">Nomor KK</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input type="text" name="hasil_no_kk" id="hasil_no_kk_event" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode == 45" required>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="nomor_md">Nomor MD</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <input type="text" name="nomor_md" id="hasil_nomor_md_event" class="form-control" maxlength="14" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required>
                            </div>
                        </div>
                    </div>
                    <div id="strip_splicing" class="hidden" style="border-bottom: 1px solid black; padding-bottom: 1rem;">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center" style="border-bottom: 1px solid black;">
                                    <h5 class="mt-2">Strip Splicing</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="hasil_ls_sa_sealing_quality_strip">Paper Splice Sealing Quality</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_ls_sa_sealing_quality_strip" id="hasil_ls_sa_sealing_quality_strip_event" class="select form-control"  required="true">
                                    <option disabled selected>-- Status Paper Splice Sealing Quality --</option>
                                    <option value="OK">OK</option>
                                    <option value="#OK">#OK</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="short_stop" class="hidden" >
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center" style="border-bottom: 1px solid black;">
                                    <h5 class="mt-2">Short Stop</h5>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="hasil_ls_short_stop_quality">LS Short Stop Quality</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_ls_short_stop_quality" id="hasil_ls_short_stop_quality_event" class="form-control" required="true">
                                    <option disabled selected>-- Status LS Short Stop Quality --</option>
                                    <option value="OK">OK</option>
                                    <option value="#OK">#OK</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <label for="hasil_sa_short_stop_quality">SA Short Stop Quality</label>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select onchange="status_akhir_at_event($('#sampel_at_event_kode').val())" name="hasil_sa_short_stop_quality" id="hasil_sa_short_stop_quality_event" class="form-control" required="true">
                                    <option disabled selected>-- Status SA Short Stop Quality --</option>
                                    <option value="OK">OK</option>
                                    <option value="#OK">#OK</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <label for="hasil_status_akhir">Status Akhir</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <input type="text" name="hasil_status_akhir" id="hasil_status_akhir_event" class="form-control" readonly required>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <label for="hasil_keterangan">Keterangan</label>
                    </div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <textarea name="hasil_keterangan" id="hasil_keterangan_event" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-lg-4 col-md-4 col-sm-4"></div>
                    <div class="col-lg-8 col-md-8 col-sm-8">
                        <button class="btn btn-info form-control" onclick="submit_at_event($('#sampel_at_event_kode').val(),$('#rpd_filling_detail_id_at_event').val(),$('#wo_id_sampel_event').val(),$('#hasil_ls_sa_sealing_quality_event').val(),$('#hasil_ls_sa_proportion_event').val(),$('#hasil_sideway_sealing_alignment_event').val(),$('#hasil_overlap_event').val(),$('#hasil_package_length_event').val(),$('#hasil_paper_splice_sealing_quality_event').val(),$('#hasil_no_kk_event').val(),$('#hasil_nomor_md_event').val(),$('#hasil_ls_sa_sealing_quality_strip_event').val(),$('#hasil_ls_short_stop_quality_event').val(),$('#hasil_sa_short_stop_quality_event').val(),$('#hasil_status_akhir_event').val(),$('#hasil_keterangan_event').val())">
                            Input Hasil Analisa
                        </button>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
</div>
