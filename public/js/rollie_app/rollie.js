/* Start Production Schedules Script */
$("#upload_mtol").on("submit", function(e) {
    event.preventDefault();
    var extension = $('#mtolFile').val().split('.').pop().toLowerCase();
    if ($.inArray(extension, ['csv', 'xls', 'xlsx']) == -1) 
    {
        swal({
            title: 'Proses Gagal',
            text: 'Harap pilih file mtol dengan format excel yang valid .',
            type: 'success'
        })
    } 
    else 
    {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"tambah-jadwal",
            method:"POST",
            data:new FormData(this),
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success:function(data)
            {
                if (data.success) 
                {
                    document.getElementById('editMtolModal').click();
                    swal({
                        title: 'Proses Berhasil',
                        text: data.message,
                        type: 'success'
                    }); 
                    document.location.href=''
                } 
                else 
                {
                    document.getElementById('editMtolModal').click();
                    swal({
                        title: 'Proses Gagal',
                        text: data.message,
                        type: 'error'
                    });                
                }
            }
        });
    }
});

function setUpdateDataWo(params,wo_id) 
{
    $.ajax({
        url     : '/rollie/jadwal-produksi/ambil-detail-wo/'+wo_id,
        method  : 'GET',
        dataType: 'JSON',
        success : function(data) 
        {
            if (params == 'draft') 
            {
                $('#production_plan_date_div').hide();
                $('#realisation_date_div').hide();
                $('#label-jangan').hide();
                $('#submit_proses').hide();
                $('#submit_proses_draft').show();

                $('#product_name_div').show();
                $('#wo_number_div').show();
                $('#production_plan_date_draft_div').show();
                
                $('#product_name').val(data.product.product_name);
                $('#product_id').val(data.product.enkripsi_id);
                $('#wo_number').val(data.wo_number);
                $('#wo_number_id').val(data.enkripsi_id);
                $('#production_plan_date_draft').val(data.production_plan_date);
                
            }
            else
            {

                $('#production_plan_date_div').show();
                $('#realisation_date_div').show();
                $('#label-jangan').hide();
                $('#submit_proses').show();
                $('#submit_proses_draft').hide();

                $('#product_name_div').show();
                $('#wo_number_div').show();

                $('#production_plan_date_draft_div').hide();
                
                $('#product_name').val(data.product.product_name);
                $('#product_id').val(data.product.enkripsi_id);
                $('#wo_number').val(data.wo_number);
                $('#wo_number_id').val(data.enkripsi_id);
                $('#production_plan_date').val(data.production_plan_date);

                $('#realisation_date').val(data.production_realisation_date);
                // $("#realisation_date").prop('readonly',true);
                if (data.wo_status*1 > 2) 
                {
                    $('#label-jangan').addClass('show');
                    document.getElementById("realisation_date").readOnly = true;
                }
                else
                {
                    $('#label-jangan').addClass('hidden');
                    document.getElementById("realisation_date").readOnly = false;
                    //$("#realisation_date").prop('readonly',true);
                }
            }     
        }
    });
}

function updateDataWo(params) 
{
    if (params == 'draft') {
        var data = 
        {
            'wo_number_id'            : $('#wo_number_id').val(),
            'wo_number'               : $('#wo_number').val(),
            'production_plan_date'    : $('#production_plan_date_draft').val(),
            'params'                  : 'draft',
        };
    } 
    else 
    {
        // ini jika bukan draft
        var data = {
            'wo_number_id'                      : $('#wo_number_id').val(),
            'wo_number'                         : $('#wo_number').val(),
            'production_realisation_date'       : $('#realisation_date').val(),
            'params'                            : 'realisation',
        };
    }
    $.ajax({
        headers: 
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/rollie/jadwal-produksi/update-data-wo', 
        method: 'POST',
        dataType: 'JSON',
        data:data,
        success: function (data) 
        {
            if (data.success)
            {
                swal({
                    title: 'Proses Berhasil',
                    text: data.message,
                    type: 'success'
                });
                document.location.href='';
            }
            else
            {
                swal({
                    title: 'Proses Gagal',
                    text: data.message,
                    type: 'error'
                });
            }
        }  
    });
}
$('.addRow').click(function ()
{
    var rowCount    = $('#production-schedule-draft-table tbody tr').length*1;
    var checkActive = $('#production-schedule-draft-table tbody tr').hasClass("show");
    if (checkActive == true) 
    {

        var $tableBody = $('#production-schedule-draft-table').find("tbody"),
            $trLast = $tableBody.find("tr:last"),
            $trNew = $trLast.clone();
        $trLast.after($trNew);
        $i = 1;
        $input = $trNew.find('input').attr({

            'name': function (_, name) {
                return name
            }
        });
        if (rowCount > 2) 
        {
            $('#bottom-action').removeClass('hidden');   
            $('#bottom-action').addClass('show');   
        }
        else
        {
            $('#bottom-action').addClass('hidden');   
            $('#bottom-action').removeClass('show');   
        }
    }
    else
    {
        $('.tambah-jadwal').removeClass('hidden');   
        $('.tambah-jadwal').addClass('show');   
    }

    loadButton();
});

function removeWo(that) 
{
    var rowCount    = $('#production-schedule-draft-table tbody tr').length*1;
    var checkActive = $('#production-schedule-draft-table tbody tr').hasClass("show");
    if (rowCount > 1) 
    {
        $(that).closest("tr").remove();
        if (rowCount > 4) 
        {
            $('#bottom-action').removeClass('hidden');   
            $('#bottom-action').addClass('show');   
        }
        else
        {
            $('#bottom-action').addClass('hidden');   
            $('#bottom-action').removeClass('show');   
        }
    }
    else
    {
        $('.tambah-jadwal').addClass('hidden');   
        $('.tambah-jadwal').removeClass('show');   
    }      
    loadButton();
}
function deleteWo(wo_number, product_name, wo_number_id) 
{
    Swal.fire({
        title: 'Penghapusan Jadwal Proses Produksi',
        text:  'Apakah anda yakin akan menghapus data proses produksi produk ' + product_name + 'dengan nomor Wo '+wo_number+' ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak, Proses yang lain',
        confirmButtonText: 'Ya, Hapus Wo',
    }).then((result) => {
        if (result.value) 
        {
            $.ajax({
                headers: 
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/rollie/jadwal-produksi/hapus-data-wo', 
                method: 'POST',
                dataType: 'JSON',
                data:{
                    'wo_number_id' :wo_number_id
                },
                success: function (data) 
                {
                    if (data.success)
                    {
                        swal({
                            title: 'Proses Berhasil',
                            text: data.message,
                            type: 'success'
                        });
                        document.location.href='';
                    }
                    else
                    {
                        swal({
                            title: 'Proses Gagal',
                            text: data.message,
                            type: 'error'
                        });
                    }
                }  
            });
        }
    });    
}
function backToSchedulePage()
{
    var rowCount    = $('.tambah-jadwal').length;
    var checkActive = $('#production-schedule-draft-table tbody tr').hasClass("show");
    // console.log(rowCount);
    // console.log(checkActive);
    if (rowCount > 1 && (checkActive !== false)) 
    {
        Swal.fire({
                title: 'Kembali ke dashboard jadwal produksi ?',
                text: 'Jika anda kembali ke dashboard jadwal produksi tanpa finalize jadwal, maka jadwal yang anda input manual akan hilang',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kembali ke dashboard jadwal produksi',
                cancelButtonText: 'Tidak, proses yang lain',
        }).then((result) => {
            if (result.value) 
            {
                document.location.href  = '/rollie/jadwal-produksi';    
            }
        });
    }
    else if (rowCount == 1 && (checkActive !== false)) 
    {
        Swal.fire({
                title: 'Kembali ke dashboard jadwal produksi ?',
                text: 'Jika anda kembali ke dashboard jadwal produksi tanpa finalize jadwal, maka jadwal yang anda input manual akan hilang',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kembali Kedashboard',
                cancelButtonText: 'Tidak, proses yang lain',
        }).then((result) => {
            if (result.value) 
            {
                document.location.href  = '/rollie/jadwal-produksi';    
            }
        });
    }
    else
    {
        document.location.href  = '/rollie/jadwal-produksi';            
    }
}
function loadButton() 
{
    var rowCount    = $('#production-schedule-draft-table tbody tr').length*1;
    var rowCountTambah    = $('.tambah-jadwal').length;
    var checkActive = $('#production-schedule-draft-table tbody tr').hasClass("show");
    if (rowCount > 1 || ((rowCountTambah == 1) && checkActive !== false)) 
    {
        $('#button-finalize').show();
    }
    else
    {
        $('#button-finalize').hide();
    }
}
/* End Production Schedules Script  */

function prosesWoNumber(namaproduk,nomorwo,wo_id,aksi) 
{
if (aksi == 'Filling') 
{
    var dokumen = 'RPD Filling';
    var url     = 'rpd-filling/proses-rpd-filling';
    var urlnya  = 'rpd-filling';
} else {
    var dokumen = 'CPP Produk';
    var url     = 'cpp-produk/proses-cpp-produk';
    var urlnya  = 'cpp-produk';

}
Swal.fire
({
    title: 'Konfirmasi Aksi '+aksi,
    text: 'Apakah '+namaproduk+' dengan Nomor Wo '+nomorwo+' akan diproses '+aksi+' ?',
    type: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya, Masuk Ke Form '+dokumen,
    cancelButtonText: 'Tidak Proses Yang Lain',
}).then((result) => 
{
    if (result.value) 
    {
        $.ajax({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            method: 'POST',
            dataType: 'JSON',
            data: 
            { 
                'product_name'      : namaproduk, 
                'wo_number'         : nomorwo,
                'wo_number_id'      : wo_id
            },
            success: function (data) 
            {
                if (data.success) 
                {
                    if (urlnya == 'rpd-filling') 
                    {
                        var id  = data.rpd_filling_head_id;
                    } 
                    else 
                    {
                        var id  = data.cpp_head_id;
                    }
                    window.location.href    = urlnya+"/form/"+id;
                } 
                else 
                {
                    swal({
                        title   : "Failed",
                        text    : data.message,
                        type    : "error"
                    });
                }
            },
        });
    }
})
}
function changeProduct(id) 
{
window.location.href = id.value; 
}
/* Start RPD Filling Script */
/* start pop up tambah batch */
    function getWoFilling() 
    {
        var jenis_tambah            = $('#jenis_tambah').val();
        var rpd_filling_head_id     = $('#rpd_filling_head_id').val();
        $.ajax({
            url     : 'get-wo-filling/'+jenis_tambah+'/'+rpd_filling_head_id,
            method  : 'GET',
            dataType: 'JSON',
            success : function(data) 
            {
                if (data.success == true) 
                {
                    var optionwo = '<option disabled selected>-- PILIH Nomor Wo --</option>', $combowo = $('#nomor_wo_tambah');
                    for (index = 0; index < data.data.length; index++) 
                    {
                        optionwo+='<option  value="'+data.data[index].enkripsi_id+'" >'+data.data[index].wo_number+' - '+data.data[index].product.product_name+'</option>';   
                    }
                    $combowo.html(optionwo).on('change');
                } 
                else 
                {
                    swal({
                        title   : "Proses Gagal",
                        text    : data.message,
                        type    : "error",
                    });
                    document.getElementById('close-button-tambah-wo').click();
                }
            }
        });
    }

/* end pop up tambah batch */
/* start pop up tambah sampel*/
   /* ini untuk mengambil kode analisa berdasarkan mesin filling yang dipilih*/
    function getFillingSampel() 
    {
        $.ajax({
            url     : 'get-filling-sampel/'+$('#mesin_filling_sampel').val()+'/'+$('#rpd_filling_head_id').val(),
            method  : 'GET',
            dataType: 'JSON',
            success : function(data) 
            {
                var kode_sampel_analisa = '<option disabled selected>-- Pilih Kode Sampel --</option>', $combosampel = $('#kode_sampel_analisa');
                for (index = 0; index < data.length; index++) 
                {
                    kode_sampel_analisa+='<option  value="'+data[index].enkripsi_id+'" >'+data[index].filling_sampel_code+'-'+data[index].filling_sampel_event+'</option>';   

                }
                $combosampel.html(kode_sampel_analisa).on('change');
                // checkFillingSampel();
            }
        });
    }
    /*ini pengecekan kode sampel yang diambil dan mesin filling yang dipilih untuk menentukan parameter analisa berat kanan dan kiri dianalisa atau tidak*/
    function checkFillingSampel() 
    {
        var mesin_filling   = $('#mesin_filling_sampel').val();
        if (mesin_filling == null || mesin_filling == '') 
        {
            swal({
                    title: "Proses Gagal",
                    text : "Harap pilih mesin filling terlebih dahulu",
                    type : "error",
                });
            return false;
        }
        var kode_sampel         = $('#kode_sampel_analisa').val();
        var event_sampel        = $('#event_sampel').val();
        if (kode_sampel !== '' || !kode_sampel) 
        {
            $.ajax({
                url     : 'check-filling-sampel/'+kode_sampel,
                method  : 'GET',
                dataType: 'JSON',
                success : function(data) 
                {
                    if (data.pi < 1 /* && event_sampel == '1' */ && (mesin_filling == 'MjE0SUJ1N0VKR3hPbTZJU1p2alBJUT09' || mesin_filling == 'TTcrSFIrTm9OL3A4SzJDKzBNN3lCQT09')) 
                    {
                        /* apabila yang ditambahkan tidak mengambil PI berarti analisa akan otomatis terisi oleh sistem. Ini mengacu ke tabel Filling Sampel Code column PI */
                        $('#berat_kanan_sampel').val('000.00');
                        $('#berat_kiri_sampel').val('000.00');
                        $('#berat_kanan_div').hide();
                        $('#berat_kiri_div').hide();
                    }
                    else
                    {
                        // console.log('ada apa');
                        $('#berat_kanan_sampel').val('');
                        $('#berat_kiri_sampel').val('');
                        $('#berat_kanan_div').show();
                        $('#berat_kiri_div').show();   
                    }
                 
                }
            });
        }
    }
    function hapusDataPopupTambahSampel()
    {
        
        $('#nomor_wo_sampel option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('#mesin_filling_sampel option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('.timepickernya').data("DateTimePicker").date(moment(new Date()).format('HH:mm:ss'));
        $('.datepickernya').data("DateTimePicker").date(moment(new Date()).format('YYYY-MM-DD'));
        $('#kode_sampel_analisa option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('#kode_sampel_analisa').empty().append('<option selected disabled value="0">Pilih Kode Sampel</option>');

        $('#event_sampel option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('#berat_kanan_sampel').val('');
        $('#berat_kiri_sampel').val('');
        $('#save_to_draft_pi').attr('disabled',false);
        

    }
    function tambahSampelAnalisa(nomorwo,mesinfilling,tanggalfilling,jamfilling,kodeanalisa,keteranganevent,beratkanan,beratkiri,id_user,id_rpd_head) 
    {
        /*disini dilakukan pengecekan apakah value yang dibutuhkan untuk masuk kedatabase kosong atau tidak*/
        if (!nomorwo || !mesinfilling || !tanggalfilling || !jamfilling || !kodeanalisa || !keteranganevent || !beratkanan || !beratkiri)
        {
            /*var alert = nomorwo+'-'+mesinfilling+'-'+tanggalfilling+'-'+kodeanalisa+'-'keteranganevent+'-'+beratkanan+'-'+beratkiri'.';*/
            swal({
                title: "Proses Gagal",
                text: "Harap lengkapi data-data analisa sampel",
                type: "error",
            });
            return false;
        }

        if (beratkanan !== '000.00' && beratkiri !== '000.00') /*ini untuk pengecekan selain sampel f yang sudah di default berat kanan dan kirinya*/
        {
            if (beratkanan.includes('.') && beratkiri.includes('.'))
            {
                if (beratkanan.toString().split(".")[1].length != 2 || beratkiri.toString().split(".")[1].length != 2) /*pengecekan apakah terdapat dua angka dibelakang koma atau tidak*/
                {
                    swal({
                        title: "Proses Gagal",
                        text: "Berat Kanan dan Berat Kiri Harus Desimal 2 angka dibelakang koma contoh : 222.30",
                        type: "error",
                    });
                    return false;
                }
            }
            else
            {
                swal({
                        title: "Proses Gagal",
                        text: "Berat Kanan dan Berat Kiri Harus Desimal 2 angka dibelakang koma contoh : 222.30",
                        type: "error",
                    });
                return false;
            }
        } 
        /* ini untuk menonaktifkan button save to draft analisa agar tidak terjadi input dua kali saat diklik*/
        $('#save_to_draft_pi').attr('disabled',true);
        
        $.ajax({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url         : 'tambah-sampel-filling',
            method      : 'POST',
            dataType    : 'JSON',
            data        : 
            {
                'wo_number_id'                  : nomorwo,
                'filling_machine_id'            : mesinfilling,
                'filling_date'                  : tanggalfilling,
                'filling_time'                  : jamfilling,
                'filling_sampel_code_id'        : kodeanalisa,
                'keteranganevent'               : keteranganevent,
                'berat_kanan'                   : beratkanan,
                'berat_kiri'                    : beratkiri,
                'rpd_filling_head_id'           : id_rpd_head
            },
            success      : function(data) 
            {  
                if (data.success == true) 
                {
                    document.getElementById('close-button').click();
                    hapusDataPopupTambahSampel();
                    refreshTablePi();
                } 
                else 
                {
                    swal({
                        title: "Proses Gagal",
                        text: data.message,
                        type: "error",
                    });
                   return false;
                }
            }
        });
    }
/* end pop up tambah sampel*/
function refreshTablePi() 
{
    var $idrpdfillinghead = $('#rpd_filling_head_id').val();
    $.ajax({
        url     : 'refresh-tabel-pi/'+$idrpdfillinghead,
        method  : 'GET',
        dataType: 'JSON',
        success : function(data) 
        {
            var isitable = '', $isitable = $('#draft_detail_pi');
            for (var i = 0; i < data.rpdFillingDetailPi_nya.length; i++)
            {
                isitable    += '<tr>';
                isitable    += '<td>'+data.rpdFillingDetailPi_nya[i].nomor_wo+'</td>';
                isitable    += '<td>'+data.rpdFillingDetailPi_nya[i].mesin_filling+'</td>';
                isitable    += '<td style="display:none">'+data.rpdFillingDetailPi_nya[i].tanggal_filling+'</td>';
                isitable    += '<td>'+data.rpdFillingDetailPi_nya[i].jam_filling+'</td>';
                isitable    += '<td>'+data.rpdFillingDetailPi_nya[i].kode_sampel+'</td>';
                if(data.akses_ubah == 'show' || data.akses_hapus == 'show')
                {
                    if (data.rpdFillingDetailPi_nya[i].kodenya == 'Event') 
                    {
                        isitable    += '<td>';
                        isitable    += '<div class="row">';
                        if (data.akses_ubah == 'show') 
                        {    
                            isitable    += '<div class="col-lg-6 col-md-12 col-sm-12">';
                            isitable    += '<div class="form-group">';
                            isitable    += '<button class="btn btn-info form-control"  onclick="analisa_sampel_at_event(\''+data.rpdFillingDetailPi_nya[i].kode_sampel+'\',\''+data.rpdFillingDetailPi_nya[i].event+'\',\''+data.rpdFillingDetailPi_nya[i].mesin_filling+'\',\''+data.rpdFillingDetailPi_nya[i].tanggal_filling+'\',\''+data.rpdFillingDetailPi_nya[i].jam_filling+'\',\''+data.rpdFillingDetailPi_nya[i].detail_id_enkripsi+'\',\''+data.rpdFillingDetailPi_nya[i].wo_id+'\',\''+data.rpdFillingDetailPi_nya[i].mesin_filling_id+'\');getPopUp(\''+"analisaSampleAtEvent"+'\')"> <i class="fas fa-file-signature"></i> </button>';
                            isitable    += '</div>';
                            isitable    += '</div>';

                        }
                        if(data.akses_hapus == 'show') 
                        {
                            isitable    += '<div class="col-lg-6 col-md-12 col-sm-12">';
                            isitable    += '<div class="form-group">';
                            isitable    += '<button class="btn btn-danger form-control" onclick="hapus_sampel(\''+data.rpdFillingDetailPi_nya[i].detail_id_enkripsi+'\',\'true\',\''+data.rpdFillingDetailPi_nya[i].kode_sampel+'\',\''+data.rpdFillingDetailPi_nya[i].mesin_filling+'\',\''+data.rpdFillingDetailPi_nya[i].jam_filling+'\')" style="margin-left: 5px;"><i class="fas fa-trash"></i></button>';
                            isitable    += '</div>';
                            isitable    += '</div>';
                        }
                        isitable    += '</div>';
                        isitable    += '</td>';
                    } 
                    else if (data.rpdFillingDetailPi_nya[i].kodenya == 'Bukan Event') 
                    {
                        isitable    += '<td>';
                        isitable    += '<div class="row">';
                        if (data.akses_ubah == 'show')
                        {
                            isitable    += '<div class="col-lg-6 col-md-12 col-sm-12">';
                            isitable    += '<div class="form-group">';
                            isitable    += '<button class="btn btn-primary form-control" onclick="analisa_sampel_pi(\''+data.rpdFillingDetailPi_nya[i].kode_sampel+'\',\''+data.rpdFillingDetailPi_nya[i].event+'\',\''+data.rpdFillingDetailPi_nya[i].mesin_filling+'\',\''+data.rpdFillingDetailPi_nya[i].tanggal_filling+'\',\''+data.rpdFillingDetailPi_nya[i].jam_filling+'\',\''+data.rpdFillingDetailPi_nya[i].detail_id_enkripsi+'\',\''+data.rpdFillingDetailPi_nya[i].nama_produk+'\',\''+data.rpdFillingDetailPi_nya[i].wo_id+'\',\''+data.rpdFillingDetailPi_nya[i].mesin_filling_id+'\');getPopUp(\''+"analisaPiSampelModal"+'\')"> <i class="fas fa-file-signature"></i> </button>';
                            isitable    += '</div>';
                            isitable    += '</div>';
                        }
                        if(data.akses_hapus == 'show') 
                        {
                            isitable    += '<div class="col-lg-6 col-md-12 col-sm-12">';
                            isitable    += '<div class="form-group">'; 
                            isitable    += '<button class="btn btn-danger form-control" onclick="hapus_sampel(\''+data.rpdFillingDetailPi_nya[i].detail_id_enkripsi+'\',\'false\',\''+data.rpdFillingDetailPi_nya[i].kode_sampel+'\',\''+data.rpdFillingDetailPi_nya[i].mesin_filling+'\',\''+data.rpdFillingDetailPi_nya[i].jam_filling+'\')" style="margin-left: 5px;"><i class="fas fa-trash"></i></button>';
                            isitable    += '</div>';
                            isitable    += '</div>';
                        }
                        isitable    +=  '</div>';
                        isitable    +=  '</td>';
                    }
                }
                isitable    += '</tr>';
            }
            $isitable.html(isitable).on('change');
            var tableok = '', $tableok = $('#done_table_detail_pi');
            for (var i = 0; i < data.rpdFillingDetailPi_ok.length; i++)
            {
                tableok    += '<tr>';
                tableok    += '<td>'+data.rpdFillingDetailPi_ok[i].nomor_wo+'</td>';
                tableok    += '<td>'+data.rpdFillingDetailPi_ok[i].mesin_filling+'</td>';
                tableok    += '<td style="display:none;">'+data.rpdFillingDetailPi_ok[i].tanggal_filling+'</td>';
                tableok    += '<td>'+data.rpdFillingDetailPi_ok[i].jam_filling+'</td>';
                tableok    += '<td>'+data.rpdFillingDetailPi_ok[i].kode_sampel+'</td>';
                tableok    += '<td>'+data.rpdFillingDetailPi_ok[i].status_akhir+'</td>';
                tableok    += '</tr>';
            }
            $tableok.html(tableok).on('change'); 
        }
    });
}

function analisa_sampel_pi(kode_sampel,event_sampel,mesin_filling,tanggal_filling,jam_filling,rpd_filling_detail_id,nama_produk,wo_id_sampel,mesin_filling_id_sampel) 
{
    /*set analisa sampel popup value untuk input ke database*/
    document.getElementById('nama_produk_analisa_pi').innerHTML         = nama_produk;
    document.getElementById('nama_produk_analisa_pi_kirim').value       = nama_produk;
    document.getElementById('sampel_pi_analisa').value                  = kode_sampel+" - "+event_sampel;
    document.getElementById('mesin_filling_pi_analisa').value           = mesin_filling;
    document.getElementById('tanggal_filling_pi_analisa').value         = tanggal_filling;
    document.getElementById('jam_filling_pi_analisa').value             = jam_filling;
    document.getElementById('rpd_filling_detail_id_pi').value           = rpd_filling_detail_id;
    document.getElementById('wo_id_sampel').value                       = wo_id_sampel;
    if (mesin_filling == 'TPA A') 
    {
        document.getElementById('batas_overlap_text').innerHTML         = 'Batas Min. 4.5 Batas Max. 6.0';

            
    } else {
        document.getElementById('batas_overlap_text').innerHTML         = 'Batas Min. 3.5 Batas Max. 4.5';
        
    }
    document.getElementById('mesin_filling_id_sampel').value            = mesin_filling_id_sampel;
}
/* START ANALISA SAMPEL PI */
    function cekOverlap() 
    {
        var hasil_overlap = $('#hasil_overlap').val();
        if (hasil_overlap.includes('.')) 
        {
            if (hasil_overlap.toString().split(".")[0].length != 1 || hasil_overlap.toString().split(".")[1].length > 2 )
            {
                swal({
                    title: "Proses Gagal",
                    text : "Overlap diisi dengan angka dan format x.yz dan maksimal 2 angka di belakang koma",
                    type : "error",
                });
                return false;
            }
            else
            {
                /* ini untuk menjalankan fungsi cek hasil koreksinya */
                cekHasilKoreksi();
            }
        } 
        else 
        {
            swal({
                title: "Proses Gagal",
                text : "Overlap diisi dengan angka dan format x.yz dan maksimal 2 angka di belakang koma",
                type : "error",
            });
            return false;
        }
    }
    function cekLsSaProportion() 
    {
        /* pengecekan apakah format sudah sesuai dengan yang diinginkan atau belum*/
        var ls_sa_proportion = $('#hasil_ls_sa_proportion').val();
        if (ls_sa_proportion.includes('(') || ls_sa_proportion.includes('/') || ls_sa_proportion.includes(')') ||ls_sa_proportion.includes('N') || ls_sa_proportion.includes('.') || ls_sa_proportion.includes('-') ||ls_sa_proportion.includes(',') || ls_sa_proportion.includes(' ') || ls_sa_proportion.includes('*') || ls_sa_proportion.includes('#')) 
        {
            /* kalo ada charachter yang ada di keyboard type decimal dari tablet yang ga sesuai maka akan muncul error berikut*/
            swal({
                title: "Proses Gagal",
                text : "LS/SA Proportion Di isi dengan Angka dengan format WX:YZ",
                type : "error",
            });
            return false;
        } 
        else 
        {
            /* pengecekan apakah dia mengandung titik koma (;) titik koma ini adalah bawaan dari keyboard type decimal dari tabletnya qc , tolong diubah jika emang dikeyboard bisa langsung klik titik dua ( : )*/
            if (ls_sa_proportion.includes(';'))
            {
                /* kalo udah sesuai dia akan mengecek length dan format yang diinginkan*/  
                if (ls_sa_proportion.toString().split(";")[1].length != 2 || ls_sa_proportion.toString().split(";")[0].length != 2)
                {
                    swal({
                        title: "Proses Gagal",
                        text : "LS/SA Proportion Di isi dengan Angka dengan format WX:YZ",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    /* disini akan mereplace titik koma menjadi titik koma sesuai format prosedur*/
                    var ubahkoma = ls_sa_proportion.replace(';',':');
                    $('#hasil_ls_sa_proportion').val(ubahkoma);
                    cekHasilKoreksi()
                }
            }
            else
            {
                /* ini notif kalo ga sesuai format ya */
                swal({
                    title: "Proses Gagal",
                    text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                    type : "error",
                });
                return false;
            }
        }
    }
    function cekTsAccurateKanan() 
    {
        var hasil_ts_accurate_kanan = $('#hasil_ts_accurate_kanan').val();
        switch(hasil_ts_accurate_kanan)
        {
            case 'OK':
                $('#hasil_ts_accurate_kanan_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ts_accurate_kanan_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#ts_accurate_kanan_tidak_ok_div').addClass('hidden');
            break;

            case '#OK':
                $('#hasil_ts_accurate_kanan_div').removeClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ts_accurate_kanan_div').addClass('col-lg-4 col-md-4 col-sm-4');
                $('#ts_accurate_kanan_tidak_ok_div').removeClass('hidden');
            break;

            case '-':
                $('#hasil_ts_accurate_kanan_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ts_accurate_kanan_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#ts_accurate_kanan_tidak_ok_div').addClass('hidden');
            break;
            
        }
        cekHasilKoreksi();
    }
    function cekTsAccurateKiri() 
    {
        var hasil_ts_accurate_kiri = $('#hasil_ts_accurate_kiri').val();
        switch(hasil_ts_accurate_kiri)
        {
            case 'OK':
                $('#hasil_ts_accurate_kiri_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ts_accurate_kiri_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#ts_accurate_kiri_tidak_ok_div').addClass('hidden');
            break;

            case '#OK':
                $('#hasil_ts_accurate_kiri_div').removeClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ts_accurate_kiri_div').addClass('col-lg-4 col-md-4 col-sm-4');
                $('#ts_accurate_kiri_tidak_ok_div').removeClass('hidden');
            break;

            case '-':
                $('#hasil_ts_accurate_kiri_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ts_accurate_kiri_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#ts_accurate_kiri_tidak_ok_div').addClass('hidden');
            break;
        }
        cekHasilKoreksi();
    }
    function cekLsAccurate() 
    {
        
        var hasil_ls_accurate = $('#hasil_ls_accurate').val();
        switch(hasil_ls_accurate)
        {
            case 'OK':
                $('#hasil_ls_accurate_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ls_accurate_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#ls_accurate_tidak_ok_div').addClass('hidden');
            break;

            case '#OK':
                $('#hasil_ls_accurate_div').removeClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ls_accurate_div').addClass('col-lg-4 col-md-4 col-sm-4');
                $('#ls_accurate_tidak_ok_div').removeClass('hidden');
            break;

            case '-':
                $('#hasil_ls_accurate_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_ls_accurate_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#ls_accurate_tidak_ok_div').addClass('hidden');
            break;
        }
        cekHasilKoreksi();
    }
    
    function cekSaAccurate() 
    {
        
        var hasil_sa_accurate = $('#hasil_sa_accurate').val();
        switch(hasil_sa_accurate)
        {
            case 'OK':
                $('#hasil_sa_accurate_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_sa_accurate_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#sa_accurate_tidak_ok_div').addClass('hidden');
            break;

            case '#OK':
                $('#hasil_sa_accurate_div').removeClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_sa_accurate_div').addClass('col-lg-4 col-md-4 col-sm-4');
                $('#sa_accurate_tidak_ok_div').removeClass('hidden');
            break;

            case '-':
                $('#hasil_sa_accurate_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_sa_accurate_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#sa_accurate_tidak_ok_div').addClass('hidden');
            break;
        }
        cekHasilKoreksi();
    }
    
    function cekSurfaceCheck() 
    {
        
        var hasil_surface_check = $('#hasil_surface_check').val();
        switch(hasil_surface_check)
        {
            case 'OK':
                $('#hasil_surface_check_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_surface_check_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#surface_check_tidak_ok_div').addClass('hidden');
            break;

            case '#OK':
                $('#hasil_surface_check_div').removeClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_surface_check_div').addClass('col-lg-4 col-md-4 col-sm-4');
                $('#surface_check_tidak_ok_div').removeClass('hidden');
            break;

            case '-':
                $('#hasil_surface_check_div').addClass('col-lg-8 col-md-8 col-sm-8');
                $('#hasil_surface_check_div').removeClass('col-lg-4 col-md-4 col-sm-4');
                $('#surface_check_tidak_ok_div').addClass('hidden');
            break;
            
        }
        cekHasilKoreksi();
    }
    function cekHasilKoreksi()
    {
        var mesin_filling_id    = $('#mesin_filling_pi_analisa').val();
        if (mesin_filling_id == 'TPA A') 
        {
            /*jika mesin filling TPA maka overlap nya 4.6 - 6.0*/
            if (
                ( 
                    $('#hasil_overlap').val() <= 6.0 && 
                    $('#hasil_overlap').val() >= 4.5
                ) && 
                $('#hasil_volume_kanan').val()  >= 198 &&  
                $('#hasil_volume_kiri').val()   >= 198 && 
                (
                    $('#hasil_ts_accurate_kanan').val() == 'OK' &&  
                    $('#hasil_ts_accurate_kiri').val()  == 'OK' && 
                    $('#hasil_ls_accurate').val()       == 'OK' && 
                    $('#hasil_sa_accurate').val()       == 'OK' && 
                    $('#hasil_surface_check').val()     == 'OK' && 
                    $('#hasil_pinching').val()          == 'OK' && 
                    $('#hasil_strip_folding').val()     == 'OK' && 
                    $('#hasil_konduktivity_kanan').val()== 'OK' && 
                    $('#hasil_konduktivity_kiri').val() == 'OK' && 
                    $('#hasil_design_kanan').val()      == 'OK' && 
                    $('#hasil_design_kiri').val()       == 'OK' && 
                    $('#hasil_dye_test').val()          == 'OK' && 
                    $('#hasil_residu_h2o2').val()       == 'OK' && 
                    $('#hasil_prod_code_no_md').val()   == 'OK'
                ) ||
                (
                    $('#hasil_ts_accurate_kanan').val() == '-' && 
                    $('#hasil_ts_accurate_kiri').val()  == '-' && 
                    $('#hasil_ls_accurate').val()       == '-' && 
                    $('#hasil_sa_accurate').val()       == '-' && 
                    $('#hasil_surface_check').val()     == '-' && 
                    $('#hasil_pinching').val()          == '-' && 
                    $('#hasil_strip_folding').val()     == '-' && 
                    $('#hasil_konduktivity_kanan').val()== '-' && 
                    $('#hasil_konduktivity_kiri').val() == '-' && 
                    $('#hasil_design_kanan').val()      == '-' && 
                    $('#hasil_design_kiri').val()       == '-' && 
                    $('#hasil_dye_test').val()          == '-' && 
                    $('#hasil_residu_h2o2').val()       == '-' && 
                    $('#hasil_prod_code_no_md').val()   == '-'
                )
            ) 
            {
                /*jika hasil pengamatannya sesuai dengan spek maka tindakan koreksi akan otomatis terisi '-' kalo tidak maka dia wajib isi tindakan koreksinya*/
                $('#hasil_correction').val('-');
            } 
            else 
            {
                $('#hasil_correction').val('');        
            }    
        }
        else if(mesin_filling_id =='A3CF B' || mesin_filling_id == 'TBA C')
        {
            /*jika mesin filling TBA dan A3 maka overlap nya 3.5 - 4.5*/
            if (
                (
                    $('#hasil_overlap').val() <= 4.5 &&
                    $('#hasil_overlap').val() >= 3.5
                ) && 
                $('#hasil_volume_kanan').val()  >= 198 && 
                $('#hasil_volume_kiri').val()   >= 198 && 
                (
                    $('#hasil_ts_accurate_kanan').val() == 'OK' && 
                    $('#hasil_ts_accurate_kiri').val()  == 'OK' && 
                    $('#hasil_ls_accurate').val()       == 'OK' && 
                    $('#hasil_sa_accurate').val()       == 'OK' && 
                    $('#hasil_surface_check').val()     == 'OK' && 
                    $('#hasil_pinching').val()          == 'OK' && 
                    $('#hasil_strip_folding').val()     == 'OK' && 
                    $('#hasil_konduktivity_kanan').val()== 'OK' && 
                    $('#hasil_konduktivity_kiri').val() == 'OK' && 
                    $('#hasil_design_kanan').val()      == 'OK' && 
                    $('#hasil_design_kiri').val()       == 'OK' && 
                    $('#hasil_dye_test').val()          == 'OK' && 
                    $('#hasil_residu_h2o2').val()       == 'OK' && 
                    $('#hasil_prod_code_no_md').val()   == 'OK'
                ) || 
                (
                    $('#hasil_ts_accurate_kanan').val() == '-' && 
                    $('#hasil_ts_accurate_kiri').val()  == '-' && 
                    $('#hasil_ls_accurate').val()       == '-' && 
                    $('#hasil_sa_accurate').val()       == '-' && 
                    $('#hasil_surface_check').val()     == '-' && 
                    $('#hasil_pinching').val()          == '-' && 
                    $('#hasil_strip_folding').val()     == '-' && 
                    $('#hasil_konduktivity_kanan').val()== '-' && 
                    $('#hasil_konduktivity_kiri').val() == '-' && 
                    $('#hasil_design_kanan').val()      == '-' && 
                    $('#hasil_design_kiri').val()       == '-' && 
                    $('#hasil_dye_test').val()          == '-' && 
                    $('#hasil_residu_h2o2').val()       == '-' && 
                    $('#hasil_prod_code_no_md').val()   == '-'
                )
            ) 
            {
                $('#hasil_correction').val('-');
            } 
            else 
            {
                $('#hasil_correction').val('');        
            }
        }
    }
    
    function submitAnalisaPi() 
    {
        var rpd_filling_detail_id_pi        = $('#rpd_filling_detail_id_pi').val();
        var rpd_filling_head_id             = $('#rpd_filling_head_id').val();
        var nama_produk_analisa_pi          = $('#nama_produk_analisa_pi_kirim').val();
        var hasil_air_gap                   = $('#hasil_air_gap').val();
        var hasil_ts_accurate_kanan         = $('#hasil_ts_accurate_kanan').val();
        var hasil_ts_accurate_kiri          = $('#hasil_ts_accurate_kiri').val();
        var hasil_ls_accurate               = $('#hasil_ls_accurate').val();
        var hasil_sa_accurate               = $('#hasil_sa_accurate').val();
        var hasil_surface_check             = $('#hasil_surface_check').val();
        var hasil_pinching                  = $('#hasil_pinching').val();
        var hasil_strip_folding             = $('#hasil_strip_folding').val();
        var hasil_konduktivity_kanan        = $('#hasil_konduktivity_kanan').val();
        var hasil_konduktivity_kiri         = $('#hasil_konduktivity_kiri').val();
        var hasil_design_kanan              = $('#hasil_design_kanan').val();
        var hasil_design_kiri               = $('#hasil_design_kiri').val();
        var hasil_dye_test                  = $('#hasil_dye_test').val();
        var hasil_residu_h2o2               = $('#hasil_residu_h2o2').val();
        var hasil_prod_code_no_md           = $('#hasil_prod_code_no_md').val();
        var hasil_correction                = $('#hasil_correction').val();
        var ts_accurate_kanan_tidak_ok      = $('#ts_accurate_kanan_tidak_ok').val();
        var ts_accurate_kiri_tidak_ok       = $('#ts_accurate_kiri_tidak_ok').val();
        var ls_accurate_tidak_ok            = $('#ls_accurate_tidak_ok').val();
        var sa_accurate_tidak_ok            = $('#sa_accurate_tidak_ok').val();
        var surface_check_tidak_ok          = $('#surface_check_tidak_ok').val();
        var mesin_filling                   = $('#mesin_filling_pi_analisa').val();
        var wo_id                           = $('#wo_id_sampel').val();
        var mesin_filling_id                = $('#mesin_filling_id_sampel').val();
        var overlap                         = $('#hasil_overlap').val();
        var ls_sa_proportion                = $('#hasil_ls_sa_proportion').val();
        var volume_kanan                    = $('#hasil_volume_kanan').val();
        var volume_kiri                     = $('#hasil_volume_kiri').val();
        if (!rpd_filling_detail_id_pi || !rpd_filling_head_id || !nama_produk_analisa_pi || !hasil_air_gap || !hasil_ts_accurate_kanan || !hasil_ts_accurate_kiri || !hasil_ls_accurate || !hasil_sa_accurate || !hasil_surface_check || !hasil_pinching || !hasil_strip_folding || !hasil_konduktivity_kanan || !hasil_konduktivity_kiri || !hasil_design_kanan || !hasil_design_kiri || !hasil_dye_test || !hasil_residu_h2o2 || !hasil_prod_code_no_md || !hasil_correction || !wo_id || !mesin_filling_id || !overlap || !ls_sa_proportion || !volume_kanan || !volume_kiri || rpd_filling_detail_id_pi=='' || rpd_filling_head_id=='' || nama_produk_analisa_pi=='' || hasil_air_gap=='' || hasil_ts_accurate_kanan=='' || hasil_ts_accurate_kiri=='' || hasil_ls_accurate=='' || hasil_sa_accurate=='' || hasil_surface_check=='' || hasil_pinching=='' || hasil_strip_folding=='' || hasil_konduktivity_kanan=='' || hasil_konduktivity_kiri=='' || hasil_design_kanan=='' || hasil_design_kiri=='' || hasil_dye_test=='' || hasil_residu_h2o2=='' || hasil_prod_code_no_md=='' || hasil_correction=='' || wo_id=='' || mesin_filling_id=='' || overlap=='' || ls_sa_proportion=='' || volume_kanan=='' || volume_kiri=='' )
        {         
            swal({
                title: "Proses Gagal",
                text : "Harap Lengkapi Data Analisa",
                type : "error",
            });
            return false;   
        }
        else
        {
            /* pengecekan format overlap apakah dia mengandung koma atau tidak */
            if (overlap.includes('.')) 
            {
                /* pengecekan format overlap apakah dia dua angka dibelakang koma atau tidak */
                if (overlap.toString().split(".")[0].length != 1 || overlap.toString().split(".")[1].length > 2 )
                {
                    swal({
                        title: "Proses Gagal",
                        text : "Overlap di isi dengan Angka maksimal 2 angka di belakang koma",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    /* pengecekan ls sa proportion dia mengandung titik dua atau tidak */
                    if (ls_sa_proportion.includes(':'))
                    {
                        /* pengecekan apakah formatnya sudah sesuai atau belum seperti prosedur */
                        if (ls_sa_proportion.toString().split(":")[1].length != 2 | ls_sa_proportion.toString().split(":")[0].length != 2)
                        {
                            swal({
                                title: "Proses Gagal",
                                text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                                type : "error",
                            });
                            return false;
                        }
                        else
                        {
                            var status_akhir    = '';
                            if (mesin_filling == 'TPA A') 
                            {
                                if 
                                    (
                                        hasil_air_gap               == 'OK' &&
                                        hasil_ts_accurate_kanan     == 'OK' &&
                                        hasil_ts_accurate_kiri      == 'OK' &&
                                        hasil_ls_accurate           == 'OK' &&
                                        hasil_sa_accurate           == 'OK' &&
                                        hasil_surface_check         == 'OK' &&
                                        hasil_pinching              == 'OK' &&
                                        hasil_strip_folding         == 'OK' &&
                                        hasil_konduktivity_kanan    == 'OK' &&
                                        hasil_konduktivity_kiri     == 'OK' &&
                                        hasil_design_kanan          == 'OK' &&
                                        hasil_design_kiri           == 'OK' &&
                                        hasil_dye_test              == 'OK' &&
                                        hasil_residu_h2o2           == 'OK' &&
                                        hasil_prod_code_no_md       == 'OK' &&
                                        (
                                            ls_sa_proportion !== '10:90' &&
                                            ls_sa_proportion !== '90:10' &&
                                            ls_sa_proportion !== '80:20' &&
                                            ls_sa_proportion !== '70:30'
                                        ) &&
                                        volume_kanan   >= 198 &&
                                        volume_kiri    >= 198 &&
                                        (
                                            overlap >= 4.5 &&
                                            overlap <= 6.0
                                        )
                                    ) 
                                {
                                    status_akhir    = 'OK';
                                }
                                else
                                {
                                    status_akhir    = '#OK';
                                }
                            } 
                            else if(mesin_filling == 'A3CF B' || mesin_filling == 'TBA C')
                            {
                                if 
                                (
                                    hasil_air_gap               == 'OK' &&
                                    hasil_ts_accurate_kanan     == 'OK' &&
                                    hasil_ts_accurate_kiri      == 'OK' &&
                                    hasil_ls_accurate           == 'OK' &&
                                    hasil_sa_accurate           == 'OK' &&
                                    hasil_surface_check         == 'OK' &&
                                    hasil_pinching              == 'OK' &&
                                    hasil_strip_folding         == 'OK' &&
                                    hasil_konduktivity_kanan    == 'OK' &&
                                    hasil_konduktivity_kiri     == 'OK' &&
                                    hasil_design_kanan          == 'OK' &&
                                    hasil_design_kiri           == 'OK' &&
                                    hasil_dye_test              == 'OK' &&
                                    hasil_residu_h2o2           == 'OK' &&
                                    hasil_prod_code_no_md       == 'OK' &&
                                    (
                                        ls_sa_proportion !== '10:90' &&
                                        ls_sa_proportion !== '90:10' &&
                                        ls_sa_proportion !== '80:20' &&
                                        ls_sa_proportion !== '70:30'
                                    ) &&
                                    volume_kanan    >= 198 &&
                                    volume_kiri     >= 198 &&
                                    (
                                        overlap >= 3.5 &&
                                        overlap <= 4.5
                                    )
                                ) 
                                {
                                    status_akhir    = 'OK';
                                }
                                else
                                {
                                    status_akhir    = '#OK';
                                }
                            }
                            if (status_akhir == 'OK') 
                            {
                                Swal.fire({
                                    title: 'Apa benar hasil semua pengecekan OK?',
                                    text: "Jika hasil semua OK klik lanjutkan, Jika ada #OK click Revisi dan ubah hasil sesuai pengamatan",
                                    type: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor  : '#3085d6',
                                    cancelButtonColor   : '#d33',
                                    confirmButtonText   : 'Ya, Lanjutkan',
                                    cancelButtonText    : 'Revisi Data Analisa'
                                }).then((result) => 
                                {
                                    if (result.value) 
                                    {
                                        $.ajax({
                                            headers: 
                                            {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            url         : 'submit-analisa-sampel-pi',
                                            method      : 'POST',
                                            dataType    : 'JSON',
                                            data        : 
                                            {
                                                'rpd_filling_detail_id_pi'  :rpd_filling_detail_id_pi,
                                                'rpd_filling_head_id'       :rpd_filling_head_id,
                                                'nama_produk_analisa_pi'    :nama_produk_analisa_pi,
                                                'overlap'                   :overlap,
                                                'ls_sa_proportion'          :ls_sa_proportion,
                                                'volume_kanan'              :volume_kanan,
                                                'volume_kiri'               :volume_kiri,
                                                'airgap'                    :hasil_air_gap,
                                                'ts_accurate_kanan'         :hasil_ts_accurate_kanan,
                                                'ts_accurate_kiri'          :hasil_ts_accurate_kiri,
                                                'ls_accurate'               :hasil_ls_accurate,
                                                'sa_accurate'               :hasil_sa_accurate,
                                                'surface_check'             :hasil_surface_check,
                                                'pinching'                  :hasil_pinching,
                                                'strip_folding'             :hasil_strip_folding,
                                                'konduktivity_kanan'        :hasil_konduktivity_kanan,
                                                'konduktivity_kiri'         :hasil_konduktivity_kiri,
                                                'design_kanan'              :hasil_design_kanan,
                                                'design_kiri'               :hasil_design_kiri,
                                                'dye_test'                  :hasil_dye_test,
                                                'residu_h2o2'               :hasil_residu_h2o2,
                                                'prod_code_no_md'           :hasil_prod_code_no_md,
                                                'correction'                :hasil_correction,
                                                'ts_accurate_kanan_tidak_ok':ts_accurate_kanan_tidak_ok,
                                                'ts_accurate_kiri_tidak_ok' :ts_accurate_kiri_tidak_ok,
                                                'ls_accurate_tidak_ok'      :ls_accurate_tidak_ok,
                                                'sa_accurate_tidak_ok'      :sa_accurate_tidak_ok,
                                                'surface_check_tidak_ok'    :surface_check_tidak_ok,
                                                'wo_number_id'              :wo_id,
                                                'filling_machine_id'        :mesin_filling_id,
                                                'status_akhir'              :status_akhir,
                                            },
                                            success      : function(data) 
                                            {
                                                if (data.success == true) 
                                                {                                                    
                                                    if (data.ppq == false) 
                                                    {``
                                                        hapusdatapopupanalisapi();
                                                        document.getElementById('close-button-pi').click();
                                                        refreshTablePi();
                                                    } 
                                                    else 
                                                    {
                                                        swal({
                                                            title: "Notifikasi Ketidaksesuaian",
                                                            text: "Terdapat Event #OK, anda akan dialihkan otomatis oleh sistem untuk mengisi form PPQ Produk",
                                                            type: "info",
                                                        });   
                                                        setTimeout(function(){ document.location.href="form-ppq-filling/"+data.isidatanya.rpd_filling_head_id+'/'+data.isidatanya.rpd_filling_detail_pi+'/'+data.isidatanya.filling_machine_id+'/'+data.isidatanya.wo_number_id },2000);
                                                    }
                                                } 
                                            }
                                        });    
                                    }
                                });   
                            } 
                            else if(status_akhir == '#OK')
                            {
                                $.ajax({
                                headers: 
                                {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url         : 'submit-analisa-sampel-pi',
                                method      : 'POST',
                                dataType    : 'JSON',
                                data        : 
                                {
                                    'rpd_filling_detail_id_pi'  :rpd_filling_detail_id_pi,
                                    'rpd_filling_head_id'       :rpd_filling_head_id,
                                    'nama_produk_analisa_pi'    :nama_produk_analisa_pi,
                                    'overlap'                   :overlap,
                                    'ls_sa_proportion'          :ls_sa_proportion,
                                    'volume_kanan'              :volume_kanan,
                                    'volume_kiri'               :volume_kiri,
                                    'airgap'                    :hasil_air_gap,
                                    'ts_accurate_kanan'         :hasil_ts_accurate_kanan,
                                    'ts_accurate_kiri'          :hasil_ts_accurate_kiri,
                                    'ls_accurate'               :hasil_ls_accurate,
                                    'sa_accurate'               :hasil_sa_accurate,
                                    'surface_check'             :hasil_surface_check,
                                    'pinching'                  :hasil_pinching,
                                    'strip_folding'             :hasil_strip_folding,
                                    'konduktivity_kanan'        :hasil_konduktivity_kanan,
                                    'konduktivity_kiri'         :hasil_konduktivity_kiri,
                                    'design_kanan'              :hasil_design_kanan,
                                    'design_kiri'               :hasil_design_kiri,
                                    'dye_test'                  :hasil_dye_test,
                                    'residu_h2o2'               :hasil_residu_h2o2,
                                    'prod_code_no_md'           :hasil_prod_code_no_md,
                                    'correction'                :hasil_correction,
                                    'ts_accurate_kanan_tidak_ok':ts_accurate_kanan_tidak_ok,
                                    'ts_accurate_kiri_tidak_ok' :ts_accurate_kiri_tidak_ok,
                                    'ls_accurate_tidak_ok'      :ls_accurate_tidak_ok,
                                    'sa_accurate_tidak_ok'      :sa_accurate_tidak_ok,
                                    'surface_check_tidak_ok'    :surface_check_tidak_ok,
                                    'wo_number_id'              :wo_id,
                                    'filling_machine_id'        :mesin_filling_id,
                                    'status_akhir'              :status_akhir,
                                },
                                success      : function(data) 
                                {
                                    if (data.success == true) 
                                    {                                                    
                                        hapusdatapopupanalisapi();
                                        document.getElementById('close-button-pi').click();
                                        refreshTablePi();
                                    } 
                                    else
                                    {
                                        swal({
                                            title: "Proses Gagal",
                                            text: data.message,
                                            type: "error",
                                        });
                                    }
                                }
                            });
                            }
                            
                        }   
                    }
                    else
                    {
                        swal({
                                title: "Proses Gagal",
                                text: "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                                type: "error",
                            });
                        return false;
                    }
                }
            } 
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text : "Overlap di isi dengan format maksimal 2 angka dibelakang koma ex. 3.87",
                    type : "error",
                });
                return false;
            }
        }
    }
    function hapusdatapopupanalisapi()
    {
        $('#rpd_filling_detail_id_pi').val('');
        $('#wo_id_sampel').val('');
        $('#mesin_filling_id_sampel').val('');
        $('#rpd_filling_detail_id_pi').val('');
        $('#sampel_pi_analisa').val('');
        $('#mesin_filling_pi_analisa').val('');
        $('#tanggal_filling_pi_analisa').val('');
        $('#jam_filling_pi_analisa').val('');
        $('#hasil_air_gap option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_ts_accurate_kanan option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_ts_accurate_kiri option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_ls_accurate option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_sa_accurate option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_surface_check option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_pinching option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_strip_folding option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_konduktivity_kanan option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_konduktivity_kiri option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_design_kanan option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_design_kiri option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_dye_test option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_residu_h2o2 option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_prod_code_no_md option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_correction option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#ts_accurate_kanan_tidak_ok option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#ts_accurate_kiri_tidak_ok option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#ls_accurate_tidak_ok option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#sa_accurate_tidak_ok option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#surface_check_tidak_ok option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#wo_id option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#mesin_filling_id option').prop('selected', function() {
            return this.defaultSelected;
        })
        $('#hasil_overlap').val('');
        $('#hasil_ls_sa_proportion').val('');
        $('#hasil_volume_kanan').val('');
        $('#hasil_volume_kiri').val('');
    }
/* END ANALISA SAMPEL PI */
/* START ANALISA SAMPEL AT EVENT */
    function analisa_sampel_at_event(kode_sampel,event_sampel,mesin_filling,tanggal_filling,jam_filling,rpd_filling_detail_id,wo_id,mesin_filling_id,nama_produk)
    {
        document.getElementById('sampel_at_event').value                    = kode_sampel+" - "+event_sampel;
        document.getElementById('sampel_at_event_kode').value               = kode_sampel;
        document.getElementById('mesin_filling_at_event').value             = mesin_filling;
        document.getElementById('mesin_filling_at_event_id').value          = mesin_filling_id;
        document.getElementById('rpd_filling_detail_id_at_event').value     = rpd_filling_detail_id;
        document.getElementById('wo_id_sampel_event').value                 = wo_id;
        document.getElementById('jam_filling_at_event').value               = jam_filling;
        document.getElementById('tanggal_filling_at_event').value           = tanggal_filling;
        document.getElementById('nama_produk_analisa_at_event').innerHTML   = nama_produk;
            
        if (kode_sampel.includes(' (Event)')) 
        {
            kode_sampel_baru    = kode_sampel.split(' (Event)')
            kode_sampel         = kode_sampel_baru[0];
        }
        if (kode_sampel.includes('(')) 
        {
            kode_sampel_baru    = kode_sampel.split('(');
            kode_sampel         = kode_sampel_baru[0];
        }
        switch(kode_sampel)
        {
            case 'B':
                $('#paper_splicing').removeClass('hidden');
            break;
            case 'C':
                $('#paper_splicing').removeClass('hidden');
            break;
            case 'D':
                $('#strip_splicing').removeClass('hidden');
            break;
            case 'E':
                $('#strip_splicing').removeClass('hidden');
            break;
            case 'F':
                $('#short_stop').removeClass('hidden');
            break;
            case 'G':
                $('#short_stop').removeClass('hidden');
            break;
        }
    }
    function status_akhir_at_event(kode_sampel) 
    {

        if (kode_sampel.includes(' (Event)')) 
        {
            kode_sampel_baru    = kode_sampel.split(' (Event)')
            kode_sampel         = kode_sampel_baru[0];
        }
        if (kode_sampel.includes('(')) 
        {
            kode_sampel_baru    = kode_sampel.split('(');
            kode_sampel         = kode_sampel_baru[0];
        }
        switch(kode_sampel)
        {
            case 'B':
                var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
                var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
                var hasil_sideway_sealing_alignment_event       =  $('#hasil_sideway_sealing_alignment_event').val();
                var hasil_overlap_event                         =  $('#hasil_overlap_event').val();
                var hasil_package_length_event                  =  $('#hasil_package_length_event').val();
                var hasil_paper_splice_sealing_quality_event    =  $('#hasil_paper_splice_sealing_quality_event').val();
                if (hasil_ls_sa_proportion_event.includes('(') || hasil_ls_sa_proportion_event.includes('/') || hasil_ls_sa_proportion_event.includes(')') ||hasil_ls_sa_proportion_event.includes('N') || hasil_ls_sa_proportion_event.includes('.') || hasil_ls_sa_proportion_event.includes('-') ||hasil_ls_sa_proportion_event.includes(',') || hasil_ls_sa_proportion_event.includes(' ') || hasil_ls_sa_proportion_event.includes('*') || hasil_ls_sa_proportion_event.includes('#')) 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    if (hasil_ls_sa_proportion_event.includes(';'))
                    {  
                        if (hasil_ls_sa_proportion_event.toString().split(";")[1].length != 2 || hasil_ls_sa_proportion_event.toString().split(";")[0].length != 2)
                        {
                            swal({
                                title: "Proses Gagal",
                                text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                                type : "error",
                            });
                            return false;
                        }
                        else
                        {
                            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_paper_splice_sealing_quality_event !=='' && hasil_no_kk_event !=='' && hasil_nomor_md_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_paper_splice_sealing_quality_event !== null && hasil_no_kk_event !== null && hasil_nomor_md_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && hasil_paper_splice_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && (hasil_sideway_sealing_alignment_event > 0 && hasil_sideway_sealing_alignment_event <= 0.5) && (hasil_overlap_event <= 17 && hasil_overlap_event >= 16) && (hasil_package_length_event >= 118.5 && hasil_package_length_event <= 119.5))
                            {
                                document.getElementById('hasil_status_akhir_event').value = 'OK';
                                document.getElementById('hasil_keterangan_event').value     = '-';
                            }
                            else
                            {
                                document.getElementById('hasil_status_akhir_event').value = '#OK';
                                document.getElementById('hasil_keterangan_event').value = '';
                            }  
                            var replacenya = hasil_ls_sa_proportion_event.replace(';',':');
                            $('#hasil_ls_sa_proportion_event').val(replacenya); 
                        }
                    }
                    else if(hasil_ls_sa_proportion_event.includes(':'))
                    {
                        if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_paper_splice_sealing_quality_event !=='' && hasil_no_kk_event !=='' && hasil_nomor_md_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_paper_splice_sealing_quality_event !== null && hasil_no_kk_event !== null && hasil_nomor_md_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && (hasil_sideway_sealing_alignment_event > 0 && hasil_sideway_sealing_alignment_event <= 0.5) && (hasil_overlap_event <= 17 && hasil_overlap_event >= 16) && (hasil_package_length_event >= 118.5 && hasil_package_length_event <= 119.5))
                        {
                            document.getElementById('hasil_status_akhir_event').value = 'OK';
                            document.getElementById('hasil_keterangan_event').value     = '-';
                        }
                        else
                        {
                            document.getElementById('hasil_status_akhir_event').value = '#OK';
                            document.getElementById('hasil_keterangan_event').value = '';
                        }  
                    }
                    else
                    {
                        swal({
                            title: "Proses Gagal",
                            text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                            type : "error",
                        });
                        return false;
                    }

                }
                
            break;
            case 'C':
                var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
                var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
                var hasil_sideway_sealing_alignment_event       =  $('#hasil_sideway_sealing_alignment_event').val();
                var hasil_overlap_event                         =  $('#hasil_overlap_event').val();
                var hasil_package_length_event                  =  $('#hasil_package_length_event').val();
                var hasil_paper_splice_sealing_quality_event    =  $('#hasil_paper_splice_sealing_quality_event').val();
                if (hasil_ls_sa_proportion_event.includes('(') || hasil_ls_sa_proportion_event.includes('/') || hasil_ls_sa_proportion_event.includes(')') ||hasil_ls_sa_proportion_event.includes('N') || hasil_ls_sa_proportion_event.includes('.') || hasil_ls_sa_proportion_event.includes('-') ||hasil_ls_sa_proportion_event.includes(',') || hasil_ls_sa_proportion_event.includes(' ') || hasil_ls_sa_proportion_event.includes('*') || hasil_ls_sa_proportion_event.includes('#')) 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    if (hasil_ls_sa_proportion_event.includes(';'))
                    {  
                        if (hasil_ls_sa_proportion_event.toString().split(";")[1].length != 2 || hasil_ls_sa_proportion_event.toString().split(";")[0].length != 2)
                        {
                            swal({
                                title: "Proses Gagal",
                                text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                                type : "error",
                            });
                            return false;
                        }
                        else
                        {
                            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_paper_splice_sealing_quality_event !=='' && hasil_no_kk_event !=='' && hasil_nomor_md_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_paper_splice_sealing_quality_event !== null && hasil_no_kk_event !== null && hasil_nomor_md_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && (hasil_sideway_sealing_alignment_event > 0 || hasil_sideway_sealing_alignment_event <= 0.5) && (hasil_overlap_event >= 16 || hasil_overlap_event <= 17) && (hasil_package_length_event >= 118.5 && hasil_package_length_event <= 119.5))
                            {
                                document.getElementById('hasil_status_akhir_event').value = 'OK';
                                document.getElementById('hasil_keterangan_event').value     = '-';
                            }
                            else
                            {
                                document.getElementById('hasil_status_akhir_event').value = '#OK';
                                document.getElementById('hasil_keterangan_event').value = '';
                            }
                            var replacenya = hasil_ls_sa_proportion_event.replace(';',':');
                            $('#hasil_ls_sa_proportion_event').val(replacenya);
                        }
                    }
                    else if(hasil_ls_sa_proportion_event.includes(':'))
                    {
                        if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_paper_splice_sealing_quality_event !=='' && hasil_no_kk_event !=='' && hasil_nomor_md_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_paper_splice_sealing_quality_event !== null && hasil_no_kk_event !== null && hasil_nomor_md_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && hasil_paper_splice_sealing_quality_event=='OK' (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && (hasil_sideway_sealing_alignment_event > 0 || hasil_sideway_sealing_alignment_event <= 0.5) && (hasil_overlap_event >= 16 || hasil_overlap_event <= 17) && (hasil_package_length_event >= 118.5 && hasil_package_length_event <= 119.5))
                        {
                            document.getElementById('hasil_status_akhir_event').value = 'OK';
                            document.getElementById('hasil_keterangan_event').value     = '-';
                        }
                        else
                        {
                            document.getElementById('hasil_status_akhir_event').value = '#OK';
                            document.getElementById('hasil_keterangan_event').value = '';
                        }
                    }
                    else
                    {
                        swal({
                            title: "Proses Gagal",
                            text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                            type : "error",
                        });
                        return false;   
                    }
                }
            break;
            case 'D':
                var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
                var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
                var hasil_ls_sa_sealing_quality_strip_event     =  $('#hasil_ls_sa_sealing_quality_strip_event').val();
                if (hasil_ls_sa_proportion_event.includes('(') || hasil_ls_sa_proportion_event.includes('/') || hasil_ls_sa_proportion_event.includes(')') ||hasil_ls_sa_proportion_event.includes('N') || hasil_ls_sa_proportion_event.includes('.') || hasil_ls_sa_proportion_event.includes('-') ||hasil_ls_sa_proportion_event.includes(',') || hasil_ls_sa_proportion_event.includes(' ') || hasil_ls_sa_proportion_event.includes('*') || hasil_ls_sa_proportion_event.includes('#')) 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    if (hasil_ls_sa_proportion_event.includes(';'))
                    {  
                        if (hasil_ls_sa_proportion_event.toString().split(";")[1].length != 2 || hasil_ls_sa_proportion_event.toString().split(";")[0].length != 2)
                        {
                            swal({
                                title: "Proses Gagal",
                                text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                                type : "error",
                            });
                            return false;
                        }
                        else
                        {   
                            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_sa_sealing_quality_strip_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_ls_sa_sealing_quality_strip_event == 'OK')
                            {
                                document.getElementById('hasil_status_akhir_event').value = 'OK';
                                document.getElementById('hasil_keterangan_event').value     = '-';
                            }
                            else
                            {
                                document.getElementById('hasil_status_akhir_event').value = '#OK';
                                document.getElementById('hasil_keterangan_event').value = '';
                            }
                            var replacenya = hasil_ls_sa_proportion_event.replace(';',':');
                            $('#hasil_ls_sa_proportion_event').val(replacenya);
                        }
                    }
                    else if (hasil_ls_sa_proportion_event.includes(':'))
                    {
                        if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_sa_sealing_quality_strip_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_ls_sa_sealing_quality_strip_event == 'OK')
                        {
                            document.getElementById('hasil_status_akhir_event').value = 'OK';
                            document.getElementById('hasil_keterangan_event').value     = '-';
                        }
                        else
                        {
                            document.getElementById('hasil_status_akhir_event').value = '#OK';
                            document.getElementById('hasil_keterangan_event').value = '';
                        }
                    }
                    else
                    {
                        swal({
                            title: "Proses Gagal",
                            text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                            type : "error",
                        });
                        return false;   
                    }
                }
                
            break;
            case 'E':
                var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
                var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
                var hasil_ls_sa_sealing_quality_strip_event     =  $('#hasil_ls_sa_sealing_quality_strip_event').val();
                if (hasil_ls_sa_proportion_event.includes('(') || hasil_ls_sa_proportion_event.includes('/') || hasil_ls_sa_proportion_event.includes(')') ||hasil_ls_sa_proportion_event.includes('N') || hasil_ls_sa_proportion_event.includes('.') || hasil_ls_sa_proportion_event.includes('-') ||hasil_ls_sa_proportion_event.includes(',') || hasil_ls_sa_proportion_event.includes(' ') || hasil_ls_sa_proportion_event.includes('*') || hasil_ls_sa_proportion_event.includes('#')) 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    if (hasil_ls_sa_proportion_event.includes(';'))
                    {  
                        if (hasil_ls_sa_proportion_event.toString().split(";")[1].length != 2 || hasil_ls_sa_proportion_event.toString().split(";")[0].length != 2)
                        {
                            swal({
                                title: "Proses Gagal",
                                text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                                type : "error",
                            });
                            return false;
                        }
                        else
                        {
                            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_sa_sealing_quality_strip_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_ls_sa_sealing_quality_strip_event == 'OK')
                            {
                                document.getElementById('hasil_status_akhir_event').value = 'OK';
                                document.getElementById('hasil_keterangan_event').value     = '-';
                            }
                            else
                            {
                                document.getElementById('hasil_status_akhir_event').value = '#OK';
                                document.getElementById('hasil_keterangan_event').value = '';
                            }
                            var replacenya = hasil_ls_sa_proportion_event.replace(';',':');
                            $('#hasil_ls_sa_proportion_event').val(replacenya);
                        }
                    }
                    else if (hasil_ls_sa_proportion_event.includes(':'))
                    {
                        if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_sa_sealing_quality_strip_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_ls_sa_sealing_quality_strip_event == 'OK')
                        {
                            document.getElementById('hasil_status_akhir_event').value = 'OK';
                            document.getElementById('hasil_keterangan_event').value     = '-';
                        }
                        else
                        {
                            document.getElementById('hasil_status_akhir_event').value = '#OK';
                            document.getElementById('hasil_keterangan_event').value = '';
                        }
                    }
                    else
                    {
                        swal({
                            title: "Proses Gagal",
                            text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                            type : "error",
                        });
                        return false;   
                    }
                }
                
            break;
            case 'F':
                var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
                var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
                var hasil_ls_short_stop_quality_event           =  $('#hasil_ls_short_stop_quality_event').val();
                var hasil_sa_short_stop_quality_event           =  $('#hasil_sa_short_stop_quality_event').val();
                if (hasil_ls_sa_proportion_event.includes('(') || hasil_ls_sa_proportion_event.includes('/') || hasil_ls_sa_proportion_event.includes(')') ||hasil_ls_sa_proportion_event.includes('N') || hasil_ls_sa_proportion_event.includes('.') || hasil_ls_sa_proportion_event.includes('-') ||hasil_ls_sa_proportion_event.includes(',') || hasil_ls_sa_proportion_event.includes(' ') || hasil_ls_sa_proportion_event.includes('*') || hasil_ls_sa_proportion_event.includes('#')) 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    if (hasil_ls_sa_proportion_event.includes(';'))
                    {  
                        if (hasil_ls_sa_proportion_event.toString().split(";")[1].length != 2 || hasil_ls_sa_proportion_event.toString().split(";")[0].length != 2)
                        {
                            swal({
                                title: "Proses Gagal",
                                text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                                type : "error",
                            });
                            return false;
                        }
                        else
                        {
                            if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_short_stop_quality_event !=='' &&hasil_sa_short_stop_quality_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_short_stop_quality_event !== null && hasil_sa_short_stop_quality_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_sa_short_stop_quality_event == 'OK' && hasil_ls_short_stop_quality_event == 'OK')
                            {
                                document.getElementById('hasil_status_akhir_event').value = 'OK';
                                document.getElementById('hasil_keterangan_event').value     = '-';
                            }
                            else
                            {
                                document.getElementById('hasil_status_akhir_event').value = '#OK';
                                document.getElementById('hasil_keterangan_event').value = '';
                            }
                            var replacenya = hasil_ls_sa_proportion_event.replace(';',':');
                            $('#hasil_ls_sa_proportion_event').val(replacenya);
                        }
                    }
                    else if (hasil_ls_sa_proportion_event.includes(':'))
                    {
                        if (hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_short_stop_quality_event !=='' &&hasil_sa_short_stop_quality_event !=='' && hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_ls_short_stop_quality_event !== null && hasil_sa_short_stop_quality_event !== null && hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_sa_short_stop_quality_event == 'OK' && hasil_ls_short_stop_quality_event == 'OK')
                        {
                            document.getElementById('hasil_status_akhir_event').value = 'OK';
                            document.getElementById('hasil_keterangan_event').value     = '-';
                        }
                        else
                        {
                            document.getElementById('hasil_status_akhir_event').value = '#OK';
                            document.getElementById('hasil_keterangan_event').value = '';
                        }
                    }
                    else
                    {
                        swal({
                            title: "Proses Gagal",
                            text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                            type : "error",
                        });
                        return false;   
                    }
                }
            break;
            case 'G':
                var hasil_ls_sa_sealing_quality_event           =  $('#hasil_ls_sa_sealing_quality_event').val();
                var hasil_ls_sa_proportion_event                =  $('#hasil_ls_sa_proportion_event').val();
                var hasil_ls_short_stop_quality_event           =  $('#hasil_ls_short_stop_quality_event').val();
                var hasil_sa_short_stop_quality_event           =  $('#hasil_sa_short_stop_quality_event').val();
                if (hasil_ls_sa_proportion_event.includes('(') || hasil_ls_sa_proportion_event.includes('/') || hasil_ls_sa_proportion_event.includes(')') ||hasil_ls_sa_proportion_event.includes('N') || hasil_ls_sa_proportion_event.includes('.') || hasil_ls_sa_proportion_event.includes('-') ||hasil_ls_sa_proportion_event.includes(',') || hasil_ls_sa_proportion_event.includes(' ') || hasil_ls_sa_proportion_event.includes('*') || hasil_ls_sa_proportion_event.includes('#')) 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                        type : "error",
                    });
                    return false;
                }
                else
                {
                    if (hasil_ls_sa_proportion_event.includes(';'))
                    {  
                        if (hasil_ls_sa_proportion_event.toString().split(";")[1].length != 2 || hasil_ls_sa_proportion_event.toString().split(";")[0].length != 2)
                        {
                            swal({
                                title: "Proses Gagal",
                                text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                                type : "error",
                            });
                            return false;
                        }
                        else
                        {
                            if (hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_sa_short_stop_quality_event == 'OK' && hasil_ls_short_stop_quality_event == 'OK')
                            {
                                document.getElementById('hasil_status_akhir_event').value = 'OK';
                                document.getElementById('hasil_keterangan_event').value     = '-';
                            }
                            else
                            {
                                document.getElementById('hasil_status_akhir_event').value = '#OK';
                                document.getElementById('hasil_keterangan_event').value = '';
                            }
                            var replacenya = hasil_ls_sa_proportion_event.replace(';',':');
                            $('#hasil_ls_sa_proportion_event').val(replacenya);
                        }
                    }
                    else if(hasil_ls_sa_proportion_event.includes(':'))
                    {
                        if (hasil_ls_sa_sealing_quality_event=='OK' && (hasil_ls_sa_proportion_event !== '10:90' || hasil_ls_sa_proportion_event !== '90:10' || hasil_ls_sa_proportion_event !== '80:20' ||hasil_ls_sa_proportion_event !== '70:30' ) && hasil_sa_short_stop_quality_event == 'OK' && hasil_ls_short_stop_quality_event == 'OK')
                        {
                            document.getElementById('hasil_status_akhir_event').value = 'OK';
                            document.getElementById('hasil_keterangan_event').value     = '-';
                        }
                        else
                        {
                            document.getElementById('hasil_status_akhir_event').value = '#OK';
                            document.getElementById('hasil_keterangan_event').value = '';
                        }
                    }
                    else
                    {
                        swal({
                            title: "Proses Gagal",
                            text : "LS/SA Proportion Di isi dengan Angka dengan format XX:XX",
                            type : "error",
                        });
                        return false;
                    }
                }
            break;
        }
    }
    function submit_at_event() 
    {
        kode_sampel                                 = $('#sampel_at_event_kode').val()
        rpd_filling_detail_id_at_event              = $('#rpd_filling_detail_id_at_event').val()
        wo_id_sampel_event                          = $('#wo_id_sampel_event').val()
        hasil_ls_sa_sealing_quality_event           = $('#hasil_ls_sa_sealing_quality_event').val()
        hasil_ls_sa_proportion_event                = $('#hasil_ls_sa_proportion_event').val()
        hasil_sideway_sealing_alignment_event       = $('#hasil_sideway_sealing_alignment_event').val()
        hasil_overlap_event                         = $('#hasil_overlap_event').val()
        hasil_package_length_event                  = $('#hasil_package_length_event').val()
        hasil_paper_splice_sealing_quality_event    = $('#hasil_paper_splice_sealing_quality_event').val()
        hasil_no_kk_event                           = $('#hasil_no_kk_event').val()
        hasil_nomor_md_event                        = $('#hasil_nomor_md_event').val()
        hasil_ls_sa_sealing_quality_strip_event     = $('#hasil_ls_sa_sealing_quality_strip_event').val()
        hasil_ls_short_stop_quality_event           = $('#hasil_ls_short_stop_quality_event').val()
        hasil_sa_short_stop_quality_event           = $('#hasil_sa_short_stop_quality_event').val()
        hasil_status_akhir_event                    = $('#hasil_status_akhir_event').val()
        hasil_keterangan_event                      = $('#hasil_keterangan_event').val()
        var paketan                                 = [];
        paketan.push(kode_sampel,rpd_filling_detail_id_at_event,wo_id_sampel_event);
        if (kode_sampel.includes(' (Event)')) 
        {
            kode_sampel_baru    = kode_sampel.split(' (Event)')
            kode_sampel         = kode_sampel_baru[0];
        }
        if (kode_sampel.includes('(')) 
        {
            kode_sampel_baru    = kode_sampel.split('(');
            kode_sampel         = kode_sampel_baru[0];
        }
        switch(kode_sampel)
        {
            case 'B':
                if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_package_length_event !== null && hasil_paper_splice_sealing_quality_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_package_length_event !=='' && hasil_paper_splice_sealing_quality_event !=='') 
                {
                    $.ajax({
                        headers: 
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : 'submit-analisa-sampel-event',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            paketan                             : paketan,
                            ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                            status_akhir                        : hasil_status_akhir_event,
                            ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                            sideway_sealing_alignment_event     : hasil_sideway_sealing_alignment_event,
                            overlap_event                       : hasil_overlap_event,
                            package_length_event                : hasil_package_length_event,
                            paper_splice_sealing_quality_event  : hasil_paper_splice_sealing_quality_event,
                            no_md                               : hasil_nomor_md_event,
                            no_kk                               : hasil_no_kk_event,
                            keterangan                          : hasil_keterangan_event,
                        },
                        success      : function(data) 
                        {
                            document.getElementById('close-button-at-event').click();
                            resetPiAtEvent();
                            refreshTablePi();
                        }
                    });
                }
                else 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "Harap Lengkapi Data Analisa",
                        type : "error",
                    });
                    return false;   
                }
            break;
            
            case 'C':
                if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null && hasil_sideway_sealing_alignment_event !== null && hasil_overlap_event !== null && hasil_package_length_event !== null && hasil_paper_splice_sealing_quality_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_sideway_sealing_alignment_event !=='' && hasil_overlap_event !=='' && hasil_package_length_event !=='' && hasil_paper_splice_sealing_quality_event !=='') 
                {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : 'submit-analisa-sampel-event',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            paketan                             : paketan,
                            ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                            status_akhir                        : hasil_status_akhir_event,
                            ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                            sideway_sealing_alignment_event     : hasil_sideway_sealing_alignment_event,
                            overlap_event                       : hasil_overlap_event,
                            package_length_event                : hasil_package_length_event,
                            paper_splice_sealing_quality_event  : hasil_paper_splice_sealing_quality_event,
                            no_md                               : hasil_nomor_md_event,
                            no_kk                               : hasil_no_kk_event,
                            keterangan                          : hasil_keterangan_event,
                        },
                        success      : function(data) 
                        {
                            resetPiAtEvent();
                            document.getElementById('close-button-at-event').click();
                            refreshTablePi();
                        }
                    });
                }
                else 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "Harap Lengkapi Data Analisa",
                        type : "error",
                    });
                    return false;   
                }

            break;
            case 'D':
                if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_strip_event !== null) 
                {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : 'submit-analisa-sampel-event',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            paketan                             : paketan,
                            ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                            ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                            ls_sa_sealing_quality_strip         : hasil_ls_sa_sealing_quality_strip_event,
                            
                            status_akhir                        : hasil_status_akhir_event,
                            keterangan                          : hasil_keterangan_event
                        },
                        success      : function(data) 
                        {
                            resetPiAtEvent();
                            document.getElementById('close-button-at-event').click();
                            refreshTablePi();
                        }
                    });
                }
                else 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "Harap Lengkapi Data Analisa",
                        type : "error",
                    });
                    return false;   
                }
            break;
            case 'E':
                if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_sa_sealing_quality_strip_event !=='' && hasil_ls_sa_sealing_quality_strip_event !== null) 
                {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : 'submit-analisa-sampel-event',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            paketan                             : paketan,
                            ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                            ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                            status_akhir                        : hasil_status_akhir_event,
                            ls_sa_sealing_quality_strip         : hasil_ls_sa_sealing_quality_strip_event,
                            keterangan                          : hasil_keterangan_event
                        },
                        success      : function(data) 
                        {
                            resetPiAtEvent();
                            document.getElementById('close-button-at-event').click();
                            refreshTablePi();
                        }
                    });
                }
                else 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "Harap Lengkapi Data Analisa",
                        type : "error",
                    });
                    return false;   
                }
            break;
            case 'F':
                if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_short_stop_quality_event !=='' && hasil_sa_short_stop_quality_event !=='' && hasil_ls_short_stop_quality_event !==null && hasil_sa_short_stop_quality_event !==null) 
                {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : 'submit-analisa-sampel-event',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            paketan                             : paketan,
                            ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                            ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                            ls_short_stop_quality               : hasil_ls_short_stop_quality_event,
                            status_akhir                        : hasil_status_akhir_event,
                            sa_short_stop_qulity                : hasil_sa_short_stop_quality_event,
                            keterangan                          : hasil_keterangan_event
                        },
                        success      : function(data) 
                        {
                            resetPiAtEvent();
                            document.getElementById('close-button-at-event').click();
                            refreshTablePi();
                        }
                    });
                }
                else 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "Harap Lengkapi Data Analisa",
                        type : "error",
                    });
                    return false;   
                }
            break;  
            case 'G':
                if (hasil_ls_sa_sealing_quality_event !== null && hasil_ls_sa_proportion_event !== null &&  hasil_ls_sa_sealing_quality_event !=='' && hasil_ls_sa_proportion_event !=='' && hasil_ls_short_stop_quality_event !=='' && hasil_sa_short_stop_quality_event !=='' && hasil_ls_short_stop_quality_event !==null && hasil_sa_short_stop_quality_event !==null) 
                {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : 'submit-analisa-sampel-event',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            paketan                             : paketan,
                            ls_sa_sealing_quality_event         : hasil_ls_sa_sealing_quality_event,
                            ls_sa_proportion_event              : hasil_ls_sa_proportion_event,
                            ls_short_stop_quality               : hasil_ls_short_stop_quality_event,
                            status_akhir                        : hasil_status_akhir_event,
                            sa_short_stop_qulity                : hasil_sa_short_stop_quality_event,
                            keterangan                          : hasil_keterangan_event
                        },
                        success      : function(data) 
                        {
                            resetPiAtEvent();
                            document.getElementById('close-button-at-event').click();
                            refreshTablePi();
                        }
                    });
                }
                else 
                {
                    swal({
                        title: "Proses Gagal",
                        text : "Harap Lengkapi Data Analisa",
                        type : "error",
                    });
                    return false;   
                }
            break;          
        }
    } 
    function resetPiAtEvent()
    {
        var custom_input    = $('#custom_input');
        var find_non_active     = custom_input.find('.hidden');
        for (var i = 0; i < find_non_active.length; i++) 
        {
            var hapus_class = $('#'+find_non_active[i].id);
            hapus_class.removeClass('hidden');
        }
        $('#paper_splicing').addClass('hidden');        
        $('#strip_splicing').addClass('hidden');        
        $('#short_stop').addClass('hidden');

        $('#kodeanalisasampel option').prop('selected', function() {
            return this.defaultSelected;
        });
        $('#hasil_ls_sa_sealing_quality_event option').prop('selected', function() 
        {
            return this.defaultSelected;
        });
        $('#hasil_sideway_sealing_alignment_event').val('');
        $('#hasil_overlap_event').val('');
        $('#hasil_package_length_event').val('');
        $('#hasil_paper_splice_sealing_quality_event option').prop('selected',function() 
        {
            return this.defaultSelected;
        })

        $('#hasil_no_kk_event').val('');
        $('#hasil_nomor_md_event').val('');
        $('#hasil_ls_sa_sealing_quality_strip_event option').prop('selected',function() 
        {
            return this.defaultSelected;
        });

        $('#hasil_ls_short_stop_quality_event option').prop('selected', function() 
        {
            return this.defaultSelected;
        })
        $('#hasil_sa_short_stop_quality_event option').prop('selected', function() 
        {
            return this.defaultSelected;
        })
        $('#hasil_status_akhir_event').val('');
        $('#hasil_keterangan_event').val('');
    }
/* END ANALISA AT EVENT */
function hapus_sampel(sampel_id,event,kode_sampel,mesin_filling, jamfilling) 
{
    var sampel_id   = sampel_id;
    var event       = event;
    Swal.fire
    ({
        title:  'Konfirmasi Penghapusan Sampel',
        text :  'Apakah anda yakin akan menghapus sampel '+kode_sampel+' mesin '+ mesin_filling +' pada jam filling '+jamfilling+'?',
        type : 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Sampel Tersebut',
        cancelButtonText: 'Cancel',
    }).then((result) => 
    {
        if (result.value) 
        {
             $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'hapus-sampel-analisa',
                method: 'POST',
                dataType: 'JSON',
                data: 
                { 
                    'sampel_id'         : sampel_id,
                    'event'             : event 
                },
                success: function (data) 
                {
                    if (data.success == true) 
                    {
                        swal({
                            title:'Success',
                            text : 'Sampel Analisa Berhasil Dihapus',
                            type:'success'
                        });
                        refreshTablePi();
                    }
                    else
                    {
                        swal({
                            title:'Success',
                            text : data.message,
                            type:'error'
                        });
                    }
                },
            });
        }
    })    
}
function proses_draft_ppq(ppq_id,nomor_ppq) 
{
    Swal.fire({
        title: 'Apakah anda yakin akan memproses Draft PPQ dengan nomor '+nomor_ppq+'?',
        text: "Jika Ya maka PPQ akan diproses dan email notifikasi akan dikirimkan pada user terkait",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor  : '#3085d6',
        cancelButtonColor   : '#d33',
        confirmButtonText   : 'Ya, Lanjutkan',
        cancelButtonText    : 'Tidak, Revisi data PPQ'
    }).then((result) => 
    {
        if (result.value) 
        {
            $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'proses-draft-ppq',
                method: 'POST',
                dataType: 'JSON',
                data: 
                { 
                    ppq_id              : ppq_id,
                    jumlah_pack         : $('#jumlah_pack_'+ppq_id).val(),  
                    alasan_ppq          : $('#alasan_ppq_'+ppq_id).val(),
                    detail_titik_ppq    : $('#detail_titik_ppq_'+ppq_id).val(),
                    kategori_ppq        : $('#kategori_ppq_'+ppq_id).val(),
                    nomor_lot_id        : $('#nomor_lot_id_'+ppq_id).val()
                },
                success: function (data)
                {
                    if (data.success == true) 
                    {
                        swal({
                            title   : "Proses Berhasil",
                            text    : data.message,
                            type    : "success",
                        });
                        window.setTimeout(function () {
                            window.location.href='';
                        },1000)
                    } 
                    else 
                    {
                        swal({
                            title   : "Proses Gagal",
                            text    : data.message,
                            type    : "error",
                        });
                    }
                },
            });
        }
    });
}
function closeRpdFilling(rpd_filling_head_id) 
{
    Swal.fire
    ({
        title: 'Konfirmasi Close RPD Filling',
        text: 'Apakah Proses Filling Telah Selesai Dilakukan?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Close RPD Filling',
        cancelButtonText: 'Tidak, Lanjutkan Proses Analisa',
    }).then((result) => 
    {
        if (result.value == true) 
        {  
            $.ajax({        
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url     : 'close-rpd-filling',
                method  : 'POST',
                data    : 
                {
                    rpd_filling_head_id : rpd_filling_head_id
                },
                dataType: 'JSON',
                success      : function(data) 
                {
                    if (data.success) 
                    {
                        swal({
                            title: "Proses Berhasil",
                            text: data.message,
                            type: "success",
                        });
                        window.setTimeout(function(){ document.location.href='/rollie/rpd-filling' },3000);
                    }
                    else
                    {
                        if (data.draft_ppq) 
                        {
                            swal({
                                title: "Proses Gagal",
                                text: data.message,
                                type: "error",
                            });
                            window.setTimeout(function(){ document.location.href='/rollie/rpd-filling/form/draft-ppq-filling/'+rpd_filling_head_id },1000);
                        } 
                        else
                        {
                            swal({
                                title: "Proses Gagal",
                                text: data.message,
                                type: "error",
                            });
                            refreshTablePi();
                        }
                    }
                }
            });
        }
    });
}
/* End RPD Filling Script */    
/* Start CPP Packing Script */
/* Fungsi proses cpp mengacu pada fungsi proses wo number di atas */
/* Fungsi pindah cpp produk mengacu pada fungsi pindah produk number di atas */
function addPalet(filling_machine_id,wo_number_id,cpp_head_id) 
{
    $.ajax({
        headers:
        {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'tambah-palet',
        method: 'POST',
        dataType: 'JSON',
        data: 
        { 
            'cpp_head_id'           : cpp_head_id,
            'wo_number_id'          : wo_number_id,
            'filling_machine_id'    : filling_machine_id 
        },
        success: function (data) 
        {
            refreshTableCpp();
        },
    });     
}
function refreshTableCpp() 
{
    var cpp_head_id            = $('#cpp_head_id').val();
    var wo_number_id           = $('#no_wo').val();
    $.ajax({
        url     : 'refresh-table-cpp/'+cpp_head_id+'/'+wo_number_id,
        method  : 'GET',
        dataType: 'JSON',
        success : function(data) 
        {
            for (index = 0; index < data.product.filling_machine_group_head.filling_machine_group_details.length; index++) 
            {
                $('#detail-cpp-'+data.product.filling_machine_group_head.filling_machine_group_details[index].filling_machine.short_name).empty();
            }
            for (var i = 0; i < data.product.filling_machine_group_head.filling_machine_group_details.length; i++) 
            {
                // console.log(data.product.filling_machine_group_head.filling_machine_group_details[i].filling_machine.short_code);
                for (var a = 0; a < data.cpp_details.length; a++) 
                {                        
                    if (data.cpp_details[a].enkripsi_wo_number_id === wo_number_id && data.cpp_details[a].enkripsi_cpp_head_id == cpp_head_id) 
                    {
                        if (data.cpp_details[a].lot_number.includes(data.product.filling_machine_group_head.filling_machine_group_details[i].filling_machine.short_code)) 
                        {
                            if (data.cpp_details[a].palets !== null) 
                            {
                                // var table = '';
                                $('#detail-cpp-'+data.product.filling_machine_group_head.filling_machine_group_details[i].filling_machine.short_name).empty();
                                var table = '', $table = $('#detail-cpp-'+data.product.filling_machine_group_head.filling_machine_group_details[i].filling_machine.short_name);
                                for (var j = 0; j < data.cpp_details[a].palets.length; j++) 
                                {
                                    if (!data.cpp_details[a].palets[j].start || data.cpp_details[a].palets[j].start == null) 
                                    {
                                        jamstart  = '';
                                    } 
                                    else 
                                    {
                                        jamstart  = data.cpp_details[a].palets[j].start;
                                    }
                                    if (!data.cpp_details[a].palets[j].end || data.cpp_details[a].palets[j].end == null) 
                                    {
                                        jamend  = '';
                                    } 
                                    else 
                                    {
                                        jamend  = data.cpp_details[a].palets[j].end;
                                    }
                                    if (!data.cpp_details[a].palets[j].jumlah_box || data.cpp_details[a].palets[j].jumlah_box == null) 
                                    {
                                        jumlahbox  = '';
                                    } 
                                    else 
                                    {
                                        jumlahbox  = data.cpp_details[a].palets[j].jumlah_box;
                                    }
                                    if (data.cpp_details[a].palets[j].at_events.length > 0) 
                                    {
                                        table     +=   '<tr style="background-color: #ff5b5bcc">';  
                                    } 
                                    else 
                                    {
                                        table     +=   '<tr>';  
                                    }
                                    table   += '<td>';
                                    table   += '<div class="form-inline">';
                                    table   += '<label class="col-lg-6 col-md-6 col-sm-6" style="font-size: 15px;">'+data.cpp_details[a].lot_number+'- </label>';    
                                    table   += '<input type="text" value="'+data.cpp_details[a].palets[j].palet+'" class="col-lg-6 col-md-6 col-sm-6 form-control"  id="nomor_palet_'+data.cpp_details[a].palets[j].enkripsi_id+'" ';
                                    if (data.akses_ubah =='show') 
                                    {
                                        table += 'onfocusout="changePalet(\''+data.cpp_details[a].palets[j].enkripsi_id+'\')">';

                                    }
                                    else
                                    {
                                        table += 'readonly >';
                                    }
                                    table   += '</div> </td>';

                                    table   += '<td>';
                                    table   += '<div class="row">';
                                    table   += '<div class="col-lg-12 col-md-12 col-sm-12">';
                                    table   += '<input type="text" class="datetimepickernya form-control" id="start_palet_'+data.cpp_details[a].palets[j].enkripsi_id+'" value="'+jamstart+'"';
                                    if (data.akses_ubah =='show') 
                                    {
                                        table += 'onfocusout="changeStart(\''+data.cpp_details[a].palets[j].enkripsi_id+'\')" >';

                                    }
                                    else
                                    {
                                        table += 'readonly >';
                                    }                  
                                    table   += '</div>'; 
                                    table   += '</div>';
                                    table   += '<td>';
                                    table   += '<div class="row">';
                                    table   += '<div class="col-lg-12 col-md-12 col-sm-12">'; 
                                    table   += '<div class="form-group">';
                                    table   += '<input type="text" class="datetimepickernya form-control" id="end_palet_'+data.cpp_details[a].palets[j].enkripsi_id+'" value="'+jamend+'"';
                                    if (data.akses_ubah =='show') 
                                    {
                                        table += 'onfocusout="changeEnd(\''+data.cpp_details[a].palets[j].enkripsi_id+'\')" >';

                                    }
                                    else
                                    {
                                        table += 'readonly >';
                                    }
                                    table   += '</div>';
                                    table   += '</div>';
                                    table   += '</div>';
                                    table   += '</td>';
                                    table   += '<td>';
                                    table   += '<div class="row">';
                                    table   += '<div class="col-lg-12 col-md-12 col-sm-12">';
                                    table   += '<div class="form-group">';
                                    table   += '<input type="text"  id="box_palet_'+data.cpp_details[a].palets[j].enkripsi_id+'" value="'+jumlahbox+'" class="form-control"';
                                    if (data.akses_ubah =='show') 
                                    {
                                        table += 'onfocusout="changeBox(\''+data.cpp_details[a].palets[j].enkripsi_id+'\')">';
                                    }
                                    else
                                    {
                                        table += 'readonly >';
                                    }         
                                    table   += '</div>';
                                    table   += '</div>';
                                    table   += '</div>';
                                    table   += '</td>';
                                    if (data.akses_hapus == 'show') 
                                    {
                                        table += '<td>';
                                        table += '<div class="row">';
                                        table += '<div class="col-lg-12 col-md-12 col-md-12">';
                                        table += '<div class="form-group">';
                                        table += '<a onclick="deletePalet(\''+data.cpp_details[a].lot_number+'-'+data.cpp_details[a].palets[j].palet+'\',\''+data.cpp_details[a].palets[j].enkripsi_id+'\')" class="btn btn-danger text-white form-control">   <i class="fas fa-trash"></i>'
                                        table += '</a>';
                                        table += '</div>';
                                        table += '</div>';
                                        table += '</td>';
                                    }
                                    table += '</tr>';
                                    $table.html(table).on('change');
                                }
                            }
                        }
                    }
                    $('.timepickernya').datetimepicker({
                        format: 'HH:mm:ss',
                        locale:'en',
                        date: new Date()
                    }); 
                    $('.datepickernya').datetimepicker({
                        format: 'YYYY-MM-DD',
                        locale:'en',
                        date: new Date()
                    }); 
                    $('.datetimepickernya').datetimepicker({
                        format: 'YYYY-MM-DD HH:mm:ss'
                    });
                }
            }
            
        }
    });
}
function changePalet(palet_id) 
{
    var nomor_palet         = $('#nomor_palet_'+palet_id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url         : 'ubah-nomor-palet',
        method      : 'POST',
        dataType    : 'JSON',
        data        : 
        {
            palet       : nomor_palet,
            palet_id    : palet_id
        },
        success      : function(data) 
        {
            if (data.success == true) 
            {
                /*swal({
                    title: "Proses Berhasil",
                    text: data.message,
                    type: "success",
                }); */
            } 
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text: data.message,
                    type: "error",
                });
            }
            refreshTableCpp();
        }
    });
}
function changeStart(palet_id) 
{
    var start       = $('#start_palet_'+palet_id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url         : 'ubah-jam-start',
        method      : 'POST',
        dataType    : 'JSON',
        data        : 
        {
            start       : start,
            palet_id    : palet_id
        },
        success      : function(data) 
        {
            if (data.success == true) 
            {
                /* swal({
                    title: "Proses Berhasil",
                    text: data.message,
                    type: "success",
                }); */
            } 
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text: data.message,
                    type: "error",
                }); 
            }
            refreshTableCpp();
        }
    });
}
function changeEnd(palet_id) 
{   
    var end       = $('#end_palet_'+palet_id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url         : 'ubah-jam-end',
        method      : 'POST',
        dataType    : 'JSON',
        data        : 
        {
            end       : end,
            palet_id    : palet_id
        },
        success      : function(data) 
        {
            if (data.success == true) 
            {
                /* swal({
                    title: "Proses Berhasil",
                    text: data.message,
                    type: "success",
                }); */
            } 
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text: data.message,
                    type: "error",
                }); 
            }
            refreshTableCpp();
        }
    });    
}

function changeBox(palet_id) 
{
    var jumlah_box       = $('#box_palet_'+palet_id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url         : 'ubah-jumlah-box',
        method      : 'POST',
        dataType    : 'JSON',
        data        : 
        {
            jumlah_box  : jumlah_box,
            palet_id    : palet_id
        },
        success      : function(data) 
        {
            if (data.success == true) 
            {
                /* swal({
                    title: "Proses Berhasil",
                    text: data.message,
                    type: "success",
                }); */
            } 
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text: data.message,
                    type: "error",
                }); 
            }
            refreshTableCpp();
        }
    });
}
function hapusDataPopupTambahBatch()
{
    $('#jenis_tambah option').prop('selected', function() {
        return this.defaultSelected;
    });
    $('#nomor_wo_tambah option').prop('selected', function() {
        return this.defaultSelected;
    });
    var select = document.getElementById("nomor_wo_tambah");
    var length = select.options.length;
    for (i = 0; i < length; i++) {
        select.options[i] = null;
    }
}
function getWoPacking() 
{
    var jenis_tambah            = $('#jenis_tambah').val();
    var cpp_head_id             = $('#cpp_head_id').val();
    $.ajax({
        url     : 'get-wo-packing/'+jenis_tambah+'/'+cpp_head_id,
        method  : 'GET',
        dataType: 'JSON',
        success : function(data) 
        {
            if (data.success == true) 
            {
                var optionwo = '<option disabled selected>-- PILIH Nomor Wo --</option>', $combowo = $('#nomor_wo_tambah');
                for (index = 0; index < data.data.length; index++) 
                {
                    optionwo+='<option  value="'+data.data[index].enkripsi_id+'" >'+data.data[index].wo_number+' - '+data.data[index].product.product_name+'</option>';   
                }
                $combowo.html(optionwo).on('change');
            } 
            else 
            {
                swal({
                    title   : "Proses Gagal",
                    text    : data.message,
                    type    : "error",
                });
                document.getElementById('close-button-tambah-wo').click();
            }
        }
    });
}
function deletePalet(lot_number,palet_id) 
{
    var lot_number      = lot_number;
    var palet_id        = palet_id;
    var product_name    = $('#nama_produk').text();
    Swal.fire
    ({
        title:  'Konfirmasi Penghapusan Palet',
        text :  'Apakah anda yakin akan menghapus Palet dengan nomor lot '+lot_number+' pada Cpp Produk '+product_name+'?',
        type : 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus Palet Tersebut',
        cancelButtonText: 'Cancel',
    }).then((result) => 
    {
        if (result.value) 
        {
             $.ajax({
                headers:
                {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'hapus-palet',
                method: 'POST',
                dataType: 'JSON',
                data: 
                { 
                    'palet_id'          : palet_id 
                },
                success: function (data) 
                {
                    if (data.success == true) 
                    {
                        swal({
                            title:'Success',
                            text : data.message,
                            type:'success'
                        });
                        refreshTableCpp();
                    }
                    else
                    {
                        swal({
                            title:'Success',
                            text : data.message,
                            type:'error'
                        });
                    }
                },
            });
        }
    })    
}
function closeCppProduct() 
{
    var cpp_head_id    = $('#cpp_head_id').val();
    Swal.fire
    ({
        title:  'Konfirmasi Close Cpp Produk ',
        text :  'Apakah proses packing sudah selesia dilakukan ?',
        type : 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Close CPP',
        cancelButtonText: 'Tidak,Proses CPP Produk',
    }).then((result) => 
    {
        if (result.value) 
        {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url         : 'close-cpp-produk',
                method      : 'POST',
                dataType    : 'JSON',
                data        : 
                {
                    cpp_head_id : cpp_head_id
                },
                success      : function(data) 
                {
                    if (data.success == true) 
                    {
                        swal({
                            title: "Proses Berhasil",
                            text: data.message,
                            type: "success",
                        });   
                        setTimeout(function(){ document.location.href='/rollie/cpp-produk' },1000);
                    } 
                    else 
                    {
                        swal({
                            title: "Proses Gagal",
                            text: data.message,
                            type: "error",
                        });
                        return false;
                    }
                }
            });         
        }
    }); 
}
/* End CPP Packing Script */    
/* start PSR Script */
    function getPsrDetail(psr_id,product_name,wo_number,production_realisation_date,psr_qty,psr_number) 
    {
         $.ajax({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url         : 'permintaan-sampel/get-psr-detail',
            method      : 'POST',
            dataType    : 'JSON',
            data        : 
            {
                psr_id      : psr_id,
            },
            success      : function(data) 
            {
                var isitable = '', $isitable = $('#detail_psr');
                for (var i = 0; i < data.length; i++) 
                {
                    for (var j = 0; j < data[i].fillingSampelCode.length; j++) 
                    {
                        isitable    += '<tr class="text-center">';
                        isitable    += '<td>'+data[i].fillingSampelCode[j].filling_sampel_code+'</td>';
                        isitable    += '<td>'+data[i].filling_machine_code+'</td>';
                        isitable    += '<td>'+data[i].fillingSampelCode[j].hitung_jumlah+'</td>';
                        isitable    += '<td>'+data[i].fillingSampelCode[j].jumlah+'</td>';
                        isitable    += '<td>'+(data[i].fillingSampelCode[j].hitung_jumlah*1)*(data[i].fillingSampelCode[j].jumlah*1) +'</td>';
                        isitable    += '</tr>';
                    }
                }
                $isitable.html(isitable).on('change');
                // console.log(isitable);
                $('#product_name').val(product_name);
                $('#wo_number').val(wo_number);
                $('#production_realisation_date').val(production_realisation_date);
                $('#psr_qty').val(psr_qty);
                document.getElementById('psr_number').innerHTML = psr_number;

            }
        });
    }

    function editPsr(psr_id) 
    {
        var qty     = document.getElementById('qty_'+psr_id).innerHTML;
        document.getElementById('qty_'+psr_id).innerHTML    = "<input type='hidden' class='form-control' id='qty_lama_"+psr_id+"' value='"+qty+"' readonly> <br> <input type='text' class='form-control' id='edit_qty_"+psr_id+"' value='"+qty+"' autofocus>";
        var note    =document.getElementById('note_'+psr_id).innerHTML;
        document.getElementById('note_'+psr_id).innerHTML   = "<textarea class='form-control hidden' id='note_lama_"+psr_id+"' readonly>"+note+"</textarea> <br> <textarea class='form-control' id='edit_note_"+psr_id+"'>"+note+"</textarea>";
        $('.button-awal').hide();
        $('.button-ubah').show();
    }
    function cancelEditPsr(psr_id) 
    {
        var qty         = $('#qty_lama_'+psr_id).val();
        var note        = $('#note_lama_'+psr_id).val();
        document.getElementById('qty_'+psr_id).innerHTML    = qty;
        document.getElementById('note_'+psr_id).innerHTML   = note;
        $('.button-awal').show();
        $('.button-ubah').hide();
    }
    function updatePsr(psr_id) 
    {
        var qty         = $('#edit_qty_'+psr_id).val();
        var note        = $('#edit_note_'+psr_id).val();
        $.ajax({
            headers: 
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url         : 'permintaan-sampel/ubah-psr',
            method      : 'POST',
            dataType    : 'JSON',
            data        : 
            {
                psr_id      : psr_id,
                qty         : qty,
                note        : note,
            },
            success      : function(data) 
            {
                document.getElementById('qty_'+psr_id).innerHTML    = qty;
                document.getElementById('note_'+psr_id).innerHTML   = note;
                $('.button-awal').show();
                $('.button-ubah').hide();
            }
        });
    }

    function sendMailPsr() 
    {
        var psr_id = [];
        $('input[name^="sendmail"]').each(function()
        {
            if (this.checked == true) {
                psr_id.push(this.value);
            }
        });
        if (psr_id.length == 0) 
        {
            swal({
                title: "Proses Gagal",
                text: "Harap pilih PSR sudah dikonfirmasi jumlahnya dan keterangan untuk kebutuhan informasi PSR.",
                type: "error",
            });   
        } 
        else 
        {
            Swal.fire
            ({
                title:  'Konfirmasi Pengiriman Info PSR',
                text :  'Apakah PSR yang akan dikirim sudah sesuai jumlah dan permintaan dilapangan ?',
                type : 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Kirim Notifikasi Ke Penyelia',
                cancelButtonText: 'Cancel',
            }).then((result) => 
            {
                if (result.value) 
                {
                    $.ajax({
                        headers: 
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : 'permintaan-sampel/send-notifikasi-psr',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            psr_id  : psr_id,
                        },
                        success      : function(data) 
                        {
                            if (data.success == true) 
                            {
                                swal({
                                    title: "Proses Berhasil",
                                    text: data.message,
                                    type: "success",
                                });   
                                setTimeout(function(){ document.location.href='/rollie/permintaan-sampel' },1000);
                                
                            } 
                            else 
                            {
                                swal({
                                    title: "Proses Gagal",
                                    text: data.message,
                                    type: "error",
                                });
                            }
                        }
                    });
                }
            });
        }
    }
    function handleChangeMail() 
    {
        var checked     = 0;
        $('input[name^="sendmail"]').each(function()
        {
            if (this.checked == true) {
                checked++;
            }
        });
        if (checked > 0 ) {
            $('#mail_psr').show();
        } else {
            $('#mail_psr').hide();
        }
    }
    function handlePrintPsr() 
    {
        var checked     = 0;
        $('input[name^="printpsr"]').each(function()
        {
            if (this.checked == true) {
                checked++;
            }
        });
        if (checked > 0 ) {
            $('#print_psr').show();
        } else {
            $('#print_psr').hide();
        }
    }

    function printPsr() 
    {
        var psr_id = [];
        $('input[name^="printpsr"]').each(function()
        {
            if (this.checked == true) {
                psr_id.push(this.value);
            }
        });
        if (psr_id.length == 0) 
        {
            swal({
                title: "Proses Gagal",
                text: "Harap pilih PSR yang akan diprint.",
                type: "error",
            });   
        } 
        else 
        {
            Swal.fire
            ({
                title:  'Konfirmasi Print Dokumen PSR',
                text :  'Apakah anda yakin PSR akan di Print?',
                type : 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Print PSR',
                cancelButtonText: 'Cancel',
            }).then((result) => 
            {
                if (result.value) 
                {
                    $.ajax({
                        headers: 
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : 'permintaan-sampel/print-psr',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            psr_id  : psr_id,
                        },
                        success      : function(data) 
                        {
                            win         = window.open();
                            var html    = "";
                            html += "<style>"
                            html += "table{ border-collapse:collapse; }  td, th{ border:1px solid black; font-size:8px;font-family: Calibri,sans-serif; } .text-center{ text-align:center; }"
                            html += "</style>"

                            html += "<table>";
                            html += "<thead>";
                            html += "<tr class='text-center'>";
                            html += "<th>No</th>";
                            html += "<th>Nomor PSR</th>";
                            html += "<th style='width:65'>Tanggal Produksi</th>";
                            html += "<th style='width:65px'>Nomor Wo</th>";
                            html += "<th  style='width:65px'>Kode Batch 1</th>";
                            html += "<th  style='width:65px'>Kode Batch 2</th>";
                            html += "<th  style='width:55px'>Kode Produk</th>";
                            html += "<th style='width: 200px'>Nama Produk</th>";
                            html += "<th>Dept.<br>Pemilik</th>";
                            html += "<th>Dept.<br>Pengguna</th>";
                            html += "<th>Jumlah<br>Sampel</th>";
                            html += "<th style='width: 120px'>Note</th>";
                            html += "</tr>";
                            html += "</thead>";
                            html += "<tbody>";
                            var j =0;
                            for (i = 0; i < data.length; i++) 
                            {
                                j++;
                                html += "<tr style='text-align:center'>";
                                html += "<td>"+ j +"</td>";
                                html += "<td>"+data[i].psr_number+"</td>";
                                html += "<td>"+data[i].wo_number.production_realisation_date+"</td>";
                                html += "<td>"+data[i].wo_number.wo_number+"</td>";
                                if (data[i].wo_number.cpp_details.length == 1) 
                                {
                                    if (data[i].wo_number.cpp_details[0].filling_machine.filling_machine_code == "A3CF B" || data[i].wo_number.cpp_details[0].filling_machine.filling_machine_code == "TPA A" )
                                    {
                                        html += "<td>"+ data[i].wo_number.cpp_details[0].lot_number +"</td>";
                                        html += "<td> - </td>";
                                    } 
                                    else
                                    {
                                        html += "<td> - </td>";
                                        html += "<td>"+ data[i].wo_number.cpp_details[0].lot_number +"</td>";
                                    }
                                } 
                                else 
                                {
                                    for (j = 0; j < data[i].wo_number.cpp_details.length; j++) 
                                    {
                                        html += "<td>"+ data[i].wo_number.cpp_details[j].lot_number +"</td>";
                                    }
                                }
                                html += "<td>"+data[i].wo_number.product.oracle_code+"</td>";
                                html += "<td>"+data[i].wo_number.product.product_name+"</td>";
                                html += "<td> FQC </td>";
                                html += "<td> FQC </td>";
                                html += "<td>"+data[i].psr_qty+"</td>";
                                if (!data[i].psr_note) {
                                    html += "<td> - </td>";
                                } else {
                                    html += "<td>"+data[i].psr_note+"</td>";
                                }
                                html += "</tr>";
                            }
                            html += "<tr>";
                            html += "<td colspan='12' rowspan='2' style='border:none;'> <br>";
                            html += "</td>";
                            html += "</tr>";
                            html += "<tr>";
                            html += "</tr>";
                            html += "<tr>";
                            html += "<td colspan='6' style='border:none;'></td>";
                            html += "<td colspan='4' style='text-align:center'>Mengetahui</td>";
                            html += "<td colspan='2' style='text-align:center'>Dibuat Oleh</td>";
                            html += "</tr>";
                            html += "<tr>";
                            html += "<td colspan='6' rowspan='3' style='border:none;'><br><br></td>";
                            html += "<td colspan='2' rowspan='3'><br><br></td>";
                            html += "<td colspan='2' rowspan='3'><br><br></td>";
                            html += "<td colspan='2' rowspan='3'><br><br></td>";
                            html += "</tr>";
                            html += "<tr>";
                            html += "</tr>";
                            html += "<tr>";
                            html += "</tr>";
                            html += "<tr class='text-center'>";
                            html += "<td colspan='6' style='border:none;'></td>";
                            html += "<td colspan='2'>FQC Manager</td>";
                            html += "<td colspan='2'>Penyelia Produksi</td>";
                            html += "<td colspan='2'>Inspektor QC</td>";
                            html += "</tr>";
                            html += "</tbody>";
                            html += "</table>";
                            win.document.write(html);
                            var document_focus = false; // var we use to monitor document focused status.
                            // Now our event handlers.
                            $(document).ready(function() { win.window.print();document_focus = true; });
                            setInterval(function() { if (document_focus === true) { win.window.close(); }  }, 100);
                            setTimeout(function(){ document.location.href='/rollie/permintaan-sampel' },3000);
                            
                        }
                    });
                }
            });
        }
    }
/* end PSR script */
/* Start Data Analysis */
/* Start Fisikokimia */
    function analisaFisikokimiaProduk(params, cpp_head_id,product_name,tanggal_produksi) 
    {
        Swal.fire
        ({
            title:  'Konfirmasi Analisa Fisikokimia',
            text :  'Apakah anda akan melakukan analisa Fisikokimia produk '+product_name+' dengan tanggal produksi '+tanggal_produksi+' ?',
            type : 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Masuk Ke Form Analisa Fisikokimia',
            cancelButtonText: 'Cancel',
        }).then((result) => 
        {
            if (result.value) 
            {
                $.ajax({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : 'analisa-fisiko-kimia',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        cpp_head_id : cpp_head_id,
                        params      : params,
                    },
                    success      : function(data) 
                    {
                        if (data.success == true) 
                        {
                            //var id = data.analisa_kimia_id
                            swal({
                                title: "Proses Berhasil",
                                text: data.message,
                                type: "success",
                            });   
                            setTimeout(function(){ document.location.href='fisiko-kimia-form/'+data.analisa_kimia_id+'/'+data.params },1000);
                        } 
                        else 
                        {
                            swal({
                                title: "Proses Gagal",
                                text: data.message,
                                type: "error",
                            });
                        }
                    }
                });
            }
        });
    };

    function tsAwal() 
    {
        var ts_awal_1 = $('#ts_awal_1').val()*1;
        var ts_awal_2 = $('#ts_awal_2').val()*1;
        if(ts_awal_1 === '')
        {
            ts_awal_1 = 0;
        }
        if (ts_awal_2 === '') 
        {
            ts_awal_2 = 0 ;
        }
        var ts_awal_avg                                 = (ts_awal_1+ts_awal_2)/2;
        document.getElementById('ts_awal_avg').value    = ts_awal_avg.toFixed(2);
        ubahStatusAkhir();
    }
    function tsTengah() 
    {
        var ts_tengah_1 = $('#ts_tengah_1').val()*1;
        var ts_tengah_2 = $('#ts_tengah_2').val()*1;
        if(ts_tengah_1 === '')
        {
            ts_tengah_1 = 0;
        }
        if (ts_tengah_2 === '') 
        {
            ts_tengah_2 = 0 ;
        }
        var ts_tengah_avg = (ts_tengah_1+ts_tengah_2)/2;
        document.getElementById('ts_tengah_avg').value = ts_tengah_avg.toFixed(2);
        ubahStatusAkhir();
    }
    function tsAkhir() 
    {
        var ts_akhir_1 = $('#ts_akhir_1').val()*1;
        var ts_akhir_2 = $('#ts_akhir_2').val()*1;
        if(ts_akhir_1 === '')
        {
            ts_akhir_1 = 0;
        }
        if (ts_akhir_2 === '') 
        {
            ts_akhir_2 = 0 ;
        }
        var ts_akhir_avg = (ts_akhir_1+ts_akhir_2)/2;
        document.getElementById('ts_akhir_avg').value = ts_akhir_avg.toFixed(2);
        ubahStatusAkhir();
    }
    function ubahStatusAkhir() 
    {
        if ($('#progress_status').val() == '0')
        {
            var ts_awal         = $('#ts_awal_avg').val();
            var ts_akhir        = $('#ts_akhir_avg').val();
            var ts_tengah       = $('#ts_tengah_avg').val();

            var ph_awal         = $('#ph_awal').val()*1;
            var ph_tengah       = $('#ph_tengah').val()*1;
            var ph_akhir        = $('#ph_akhir').val()*1;
            
            var spek_ts_min     = $('#spek_ts_min').val();
            var spek_ts_max     = $('#spek_ts_max').val();
            
            var spek_ph_min     = $('#spek_ph_min').val();
            var spek_ph_max     = $('#spek_ph_max').val();
            
            var sensori_awal    = $('#sensori_awal').val();
            var sensori_tengah  = $('#sensori_tengah').val();
            var sensori_akhir   = $('#sensori_akhir').val();
            // console.log(sensori_awal+' '+sensori_tengah+' '+sensori_akhir);
            // var status_akhir     = ;
            $('#analisa_kimia_status').val('');
            if (ts_awal !== '' && ts_akhir !== '' && ts_tengah !== '' && ph_awal !== '' && ph_tengah !== '' && ph_akhir !== '' && sensori_awal !== '' && sensori_awal !== null && sensori_tengah !== '' && sensori_tengah !== null && sensori_akhir !== '' && sensori_akhir !== null ) 
            {
                if ( ts_awal < spek_ts_min || ts_tengah < spek_ts_min || ts_akhir < spek_ts_min || ts_awal > spek_ts_max || ts_tengah > spek_ts_max || ts_akhir > spek_ts_max) 
                {
                    if ($('#analisa_kimia_status').val().includes('TS OK')) 
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val().replace('TS OK','TS #OK');
                    } 
                    else if($('#analisa_kimia_status').val().includes('TS #OK'))
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val();
                    }
                    else
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val()+"TS #OK ";
                    }
                }
                else
                {
                    if ($('#analisa_kimia_status').val().includes('TS #OK')) 
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val().replace('TS #OK','TS OK');
                    } 
                    else if($('#analisa_kimia_status').val().includes('TS OK'))
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val();
                    }
                    else
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val()+"TS OK ";
                    }   
                }
                if (ph_awal < spek_ph_min || ph_awal > spek_ph_max || ph_tengah < spek_ph_min || ph_tengah > spek_ph_max || ph_akhir < spek_ph_min || ph_akhir > spek_ph_max) 
                {
                    // $('#analisa_kimia_status').val()
                    if ($('#analisa_kimia_status').val().includes('pH OK')) 
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val().replace('pH OK','pH #OK');
                    } 
                    else if ($('#analisa_kimia_status').val().includes('pH #OK'))
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val();
                    }   
                    else
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val()+"pH #OK ";
                    }
                }
                else
                {
                    if ($('#analisa_kimia_status').val().includes('pH #OK')) 
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val().replace('pH #OK','pH OK');
                    } 
                    else if ($('#analisa_kimia_status').val().includes('pH OK'))
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val();
                    }   
                    else
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val()+"pH OK ";
                    }       
                }

                if (sensori_awal !== 'OK' || sensori_tengah !== 'OK' || sensori_akhir !== 'OK')
                {
                    if($('#analisa_kimia_status').val().includes('Sensory OK'))
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val().replace('Sensory OK','Sensory #OK');
                    }
                    else if ($('#analisa_kimia_status').val().includes('Sensory #OK')) 
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val();
                    } 
                    else 
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val()+"Sensory #OK "
                    }   
                }
                else
                {
                    if($('#analisa_kimia_status').val().includes('Sensory #OK'))
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val().replace('Sensory #OK','Sensory OK');
                    }
                    else if ($('#analisa_kimia_status').val().includes('Sensory OK')) 
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val();
                    } 
                    else 
                    {
                        document.getElementById('analisa_kimia_status').value   = $('#analisa_kimia_status').val()+"Sensory OK"
                    }   
                }
            }    
        }
    }
    function saveAnalisaKimia()
    {
        Swal.fire
        ({
            title:  'Konfirmasi Simpan Analisa Fisikokimia',
            text :  'Apakah seluruh data fisikokimia sudah terinput ?',
            type : 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Sudah',
            cancelButtonText: 'Cancel',
        }).then((result) => 
        {
            if(result.value)
            {
                
                var ts_awal_1           = $('#ts_awal_1').val();
                var ts_awal_2           = $('#ts_awal_2').val();
                var ts_awal_avg         = $('#ts_awal_avg').val();
                
                var ts_tengah_1         = $('#ts_tengah_1').val();
                var ts_tengah_2         = $('#ts_tengah_2').val();
                var ts_tengah_avg       = $('#ts_tengah_avg').val();

                var ts_akhir_1          = $('#ts_akhir_1').val();
                var ts_akhir_2          = $('#ts_akhir_2').val();
                var ts_akhir_avg        = $('#ts_akhir_avg').val();

                var ph_awal             = $('#ph_awal').val();
                var ph_tengah           = $('#ph_tengah').val();
                var ph_akhir            = $('#ph_akhir').val();

                var sensori_awal        = $('#sensori_awal').val();
                var sensori_tengah      = $('#sensori_tengah').val();
                var sensori_akhir       = $('#sensori_akhir').val();
                
                var visko_awal          = $('#visko_awal').val();
                var visko_tengah        = $('#visko_tengah').val();
                var visko_akhir         = $('#visko_akhir').val();
                
                var jam_filling_awal    = $('#jam_filling_awal').val();
                var jam_filling_tengah  = $('#jam_filling_tengah').val();
                var jam_filling_akhir   = $('#jam_filling_akhir').val();

                var kode_batch_standar   = $('#kode_batch_standar').val();
                var kode_batch_standar   = $('#kode_batch_standar').val();


                if (!ts_awal_1 || !ts_awal_2 ||  !ts_awal_avg || !ts_tengah_1 || !ts_tengah_2 || !ts_tengah_avg || !ts_akhir_1 || !ts_akhir_2 || !ts_akhir_avg || !ph_awal || !ph_tengah || !ph_akhir || sensori_awal == 'selected' || sensori_tengah == 'selected' || sensori_akhir == 'selected' || !visko_awal || !visko_tengah || !visko_akhir || !jam_filling_awal || !jam_filling_tengah || !jam_filling_akhir || !kode_batch_standar || !kode_batch_standar)
                {
                    swal({
                        title: "Proses Gagal",
                        text: "Harap isi seluruh data analisa terlebih dahulu",
                        type: "error",
                    });  
                } 
                else 
                {
                    $('#type_input').val('save');
                    $('#form-fisiko-kimia').submit();
                }
            }
        });
    }
    function editAnalisaKimiaOk() 
    {
        var analisa_kimia_id    = $('#analisa_kimia_id').val();
        Swal.fire
        ({
            title:  'Konfirmasi Ubah Analisa Fisikokimia',
            text :  'Apakah anda yakin akan merevisi data analisa Fisikokimia '+$('#product_name').val()+' dengan tanggal produksi '+$('#production_realisation_date').val()+' ?',
            type : 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Edit Hasil Analisa',
            cancelButtonText: 'Cancel',
        }).then((result) => 
        {
            if(result.value)
            {
                $.ajax({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url         : '/rollie/fisiko-kimia-form/edit-analisa-fisikokimia',
                    method      : 'POST',
                    dataType    : 'JSON',
                    data        : 
                    {
                        analisa_kimia_id : analisa_kimia_id,
                        params      : $('#params').val(),
                    },
                    success      : function(data) 
                    {
                        if (data.success == true) 
                        {
                            swal({
                                title: "Proses Berhasil",
                                text: data.message,
                                type: "success",
                            });   
                            setTimeout(function(){ document.location.href='/rollie/fisiko-kimia-form/'+data.analisa_kimia_id+'/'+data.params },1000);
                        } 
                        else 
                        {
                            swal({
                                title: "Proses Gagal",
                                text: data.message,
                                type: "error",
                            });
                        }
                    }
                });    
            }
        });
    }
    function updateTsOven() 
    {
        var analisa_kimia_id    = $('#analisa_kimia_id').val();
        var ts_oven_awal        = $('#ts_oven_awal').val();
        var ts_oven_tengah      = $('#ts_oven_tengah').val();
        var ts_oven_akhir       = $('#ts_oven_akhir').val();
        if (!ts_oven_awal || !ts_oven_akhir || !ts_oven_tengah) 
        {
            swal({
                title: "Proses Gagal",
                text: "Harap lengkapi data ts oven terlebih dahulu",
                type: "error",
            });
        }
        else
        {
            Swal.fire
            ({
                title:  'Konfirmasi Update TS Oven',
                text :  'Apakah anda yakin akan menginput TS Oven '+$('#product_name').val()+' dengan tanggal produksi '+$('#production_realisation_date').val()+' ?',
                type : 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Update TS Oven',
                cancelButtonText: 'Cancel',
            }).then((result) => 
            {
                if(result.value)
                {
                    $.ajax({
                        headers: 
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : '/rollie/fisiko-kimia/update-ts-oven',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            analisa_kimia_id    : analisa_kimia_id,
                            ts_oven_awal        : ts_oven_awal,
                            ts_oven_tengah      : ts_oven_tengah,
                            ts_oven_akhir       : ts_oven_akhir,
                        },
                        success      : function(data) 
                        {
                            if (data.success == true) 
                            {
                                swal({
                                    title: "Proses Berhasil",
                                    text: data.message,
                                    type: "success",
                                });   
                                setTimeout(function(){ document.location.href='' },2000);
                            } 
                            else 
                            {
                                swal({
                                    title: "Proses Gagal",
                                    text: data.message,
                                    type: "error",
                                });
                            }
                        }
                    });    
                }
            });
        }
    }

    function prosesFollowUpPpq(ppq_id,ppq_nomor_ppq,nama_produk,alasan_ppq,status_akhir,params,params_induk = '') 
    {
        if (status_akhir == '0') /*  jika status ppq nya new ppq */ 
        {
            Swal.fire
            ({
                title:  'Konfirmasi Follow Up PPQ '+ppq_nomor_ppq,
                text :  'Apakah anda yakin akan melakukan proses follow up ppq produk '+nama_produk+' case '+ alasan_ppq +' dengan nomor ppq '+ ppq_nomor_ppq+'?',
                type : 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Proses Follow Up PPQ',
                cancelButtonText: 'Cancel',
            }).then((result) => 
            {
                if(result.value)
                {
                    $.ajax({
                        headers: 
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : '/rollie/proses-follow-up-ppq',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            ppq_id          : ppq_id,
                            params          : params,
                            params_induk    : params_induk,
                        },
                        success      : function(data) 
                        {
                            if (data.success == true) 
                            {
                                swal({
                                    title: "Proses Berhasil",
                                    text: data.message,
                                    type: "success",
                                });   
                                setTimeout(function(){ document.location.href='/rollie/form-follow-up-ppq/'+data.follow_up_ppq_id+'/'+data.params+'/'+data.params_induk },1000);
                            } 
                            else 
                            {
                                swal({
                                    title: "Proses Gagal",
                                    text: data.message,
                                    type: "error",
                                });
                            }
                        }
                    });    
                }
            });
        } 
        else if(status_akhir !== '0' )
        {
            document.location.href='/rollie/form-follow-up-ppq/'+$('#follow_up_ppq_id_'+ppq_id).val()+'/'+params+'/'+params_induk;
        }
    }
    function validasiInputFollowUp() 
    {
        var follow_up_ppq_id    = $('#follow_up_ppq_id').val();
        var params_route        = $('#params_route').val();
        var params              = $('#params').val();
        var params_induk        = $('#params_induk').val();
        var jenis_ppq           = $('#jenis_ppq').val();
        switch (params_route) 
        {
            case 'ppq-qc-release':
                switch (jenis_ppq) 
                {
                    case 'Package Integrity':
                        var  hasil_analisa              = $('#hasil_analisa').val();
                        var  jumlah_metode_sampling     = $('#jumlah_metode_sampling').val();
                        var  status_produk              = $('#status_produk').val();
                        var  tanggal_status             = $('#tanggal_status_ppq').val();
                        var  nomor_lbd                  = $('#nomor_lbd').val();
                        if ( !hasil_analisa || !jumlah_metode_sampling || status_produk == '10' || !nomor_lbd ) 
                        {
                            swal({
                                title: "Proses Gagal",
                                text: "Harap lengkapi form follow up ppq terlebih dahulu",
                                type: "error",
                            });
                        } 
                        else
                        {
                            Swal.fire
                            ({
                                title:  'Konfirmasi Proses Follow Up PPQ',
                                text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim ',
                                type : 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Proses Hasil Follow Up PPQ',
                                cancelButtonText: 'Tidak, Periksa Kembali hasil',
                            }).then((result) => 
                            {
                                if (result.value) 
                                {

                                    $('#draft_button').attr('disabled','true');
                                    $('#save_button').attr('onclick','javascript:void(0)');
                                    $('#save_button').removeClass('btn-primary');
                                    $('#save_button').addClass('btn-danger');
                                    $('#draft_button').removeClass('btn-outline-primary');
                                    $('#draft_button').addClass('btn-outline-danger');
                                    $.ajax({
                                        headers: 
                                        {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url         : '/rollie/form-follow-up-ppq/update-follow-up-ppq',
                                        method      : 'POST',
                                        dataType    : 'JSON',
                                        data        : 
                                        {
                                            follow_up_ppq_id        : follow_up_ppq_id,
                                            params                  : params,
                                            params_induk            : params_induk,
                                            params_route            : params_route,
                                            jenis_ppq               : jenis_ppq,
                                            hasil_analisa           : hasil_analisa,
                                            jumlah_metode_sampling  : jumlah_metode_sampling,
                                            status_produk           : status_produk,
                                            tanggal_status_ppq      : tanggal_status,
                                            nomor_lbd               : nomor_lbd,
                                            params_save             : 'savenya',
                                        },
                                        success      : function(data) 
                                        {
                                            if (data.success == true) 
                                            {
                                                swal({
                                                    title: "Proses Berhasil",
                                                    text: data.message,
                                                    type: "success",
                                                });   
                                                setTimeout(function(){ document.location.href='/rollie/'+data.params },2000);
                                            } 
                                            else 
                                            {
                                                swal({
                                                    title: "Proses Gagal",
                                                    text: data.message,
                                                    type: "error",
                                                });
                                            }
                                        }
                                    });
                                }    
                            })
                        }
                    break;
                }
            break;

            case 'ppq-qc-tahanan':
                switch (jenis_ppq) 
                {
                    case 'Kimia':
                        var  hasil_analisa              = $('#hasil_analisa').val();
                        var  status_produk              = $('#status_produk').val();
                        var  tanggal_status             = $('#tanggal_status_ppq').val();
                        var  nomor_lbd                  = $('#nomor_lbd').val();
                        var  corrective_action          = [];
                        $('textarea[name^="corrective_action"]').each(function()
                        {
                            corrective_action.push(this.value);
                        });
                        var  pic_corrective_action          = [];
                        $('input[name^="pic_corrective_action"]').each(function()
                        {
                            pic_corrective_action.push(this.value);
                        });

                        var  due_date_corrective_action          = [];
                        $('input[name^="due_date_corrective_action"]').each(function()
                        {
                            due_date_corrective_action.push(this.value);
                        });
                        // console.log(due_date_corrective_action);

                        var  status_corrective_action          = [];
                        $('select[name^="status_corrective_action"]').each(function()
                        {
                            status_corrective_action.push(this.value);
                        });

                        var  preventive_action          = [];
                        $('textarea[name^="preventive_action"]').each(function()
                        {
                            preventive_action.push(this.value);
                        });
                        var  pic_preventive_action          = [];
                        $('input[name^="pic_preventive_action"]').each(function()
                        {
                            pic_preventive_action.push(this.value);
                        });

                        var  due_date_preventive_action          = [];
                        $('input[name^="due_date_preventive_action"]').each(function()
                        {
                            due_date_preventive_action.push(this.value);
                        });

                        var  status_preventive_action          = [];
                        $('select[name^="status_preventive_action"]').each(function()
                        {
                            status_preventive_action.push(this.value);
                        });
                        // var params_input = '0';
                        if (corrective_action[0] ==  '' || preventive_action[0] ==  '') 
                        {
                            /*ini jika correvtive action atau preventivenya ga ada*/
                            Swal.fire
                            ({
                                title:  'Konfirmasi Corrective Action dan Preventive Action Follow Up PPQ',
                                text :  'Corrective Action atau Preventive Action follow up ppq tidak terisi',
                                type : 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Proses Hasil Follow Up PPQ',
                                cancelButtonText: 'Tidak, Input Corrective Action/ Preventive Action',
                            }).then((result) => 
                            {
                                if (result.value) 
                                {
                                    if ( !hasil_analisa ||  status_produk == '10' || !nomor_lbd ) 
                                    {
                                        swal({
                                            title: "Proses Gagal",
                                            text: "Harap lengkapi form follow up ppq terlebih dahulu",
                                            type: "error",
                                        });
                                    } 
                                    else
                                    {   
                                        Swal.fire
                                        ({
                                            title:  'Konfirmasi Proses Follow Up PPQ',
                                            text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim email notifikasi kepada pihak terkait',
                                            type : 'info',
                                            showCancelButton: true,
                                            confirmButtonColor: '#3085d6',
                                            cancelButtonColor: '#d33',
                                            confirmButtonText: 'Ya, Proses Hasil Follow Up PPQ',
                                            cancelButtonText: 'Tidak, Periksa Kembali hasil',
                                        }).then((result) => 
                                        {
                                            $.ajax({
                                                headers: 
                                                {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                },
                                                url         : '/rollie/form-follow-up-ppq/update-follow-up-ppq',
                                                method      : 'POST',
                                                dataType    : 'JSON',
                                                data        : 
                                                {
                                                    follow_up_ppq_id            : follow_up_ppq_id,
                                                    params                      : params,
                                                    jenis_ppq                   : jenis_ppq,
                                                    hasil_analisa               : hasil_analisa,
                                                    status_produk               : status_produk,
                                                    tanggal_status_ppq          : tanggal_status,
                                                    nomor_lbd                   : nomor_lbd,
                                                    corrective_action           : corrective_action,
                                                    pic_corrective_action       : pic_corrective_action,
                                                    due_date_corrective_action  : due_date_corrective_action,
                                                    status_corrective_action    : status_corrective_action,
                                                    preventive_action           : preventive_action,
                                                    pic_preventive_action       : pic_preventive_action,
                                                    due_date_preventive_action  : due_date_preventive_action,
                                                    status_preventive_action    : status_preventive_action,
                                                    params_induk                : 'null',
                                                    params_save                 : 'savenya',
                                                },
                                                success      : function(data) 
                                                {
                                                    if (data.success == true) 
                                                    {
                                                        swal({
                                                            title: "Proses Berhasil",
                                                            text: data.message,
                                                            type: "success",
                                                        });   
                                                        setTimeout(function(){ document.location.href='/rollie/'+data.params },1000);
                                                    } 
                                                    else 
                                                    {
                                                        swal({
                                                            title: "Proses Gagal",
                                                            text: data.message,
                                                            type: "error",
                                                        });
                                                    }
                                                }
                                            });    
                                        })
                                    }                    
                                }
                            })   
                        }
                        else
                        {   
                            if ( !hasil_analisa ||  status_produk == '10' || !nomor_lbd ) 
                            {
                                swal({
                                    title: "Proses Gagal",
                                    text: "Harap lengkapi form follow up ppq terlebih dahulu",
                                    type: "error",
                                });
                            } 
                            else
                            {   
                                Swal.fire
                                ({
                                    title:  'Konfirmasi Proses Follow Up PPQ',
                                    text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim email notifikasi kepada pihak terkait ',
                                    type : 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Proses Hasil Follow Up PPQ',
                                    cancelButtonText: 'Tidak, Periksa Kembali hasil',
                                }).then((result) => 
                                {
                                    $.ajax({
                                        headers: 
                                        {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url         : '/rollie/form-follow-up-ppq/update-follow-up-ppq',
                                        method      : 'POST',
                                        dataType    : 'JSON',
                                        data        : 
                                        {
                                            follow_up_ppq_id            : follow_up_ppq_id,
                                            params                      : params,
                                            jenis_ppq                   : jenis_ppq,
                                            hasil_analisa               : hasil_analisa,
                                            status_produk               : status_produk,
                                            tanggal_status_ppq          : tanggal_status,
                                            nomor_lbd                   : nomor_lbd,
                                            corrective_action           : corrective_action,
                                            pic_corrective_action       : pic_corrective_action,
                                            due_date_corrective_action  : due_date_corrective_action,
                                            status_corrective_action    : status_corrective_action,
                                            preventive_action           : preventive_action,
                                            pic_preventive_action       : pic_preventive_action,
                                            due_date_preventive_action  : due_date_preventive_action,
                                            params_induk                : 'null',
                                            status_preventive_action    : status_preventive_action,
                                            params_save                 : 'savenya',
                                        },
                                        success      : function(data) 
                                        {
                                            if (data.success == true) 
                                            {
                                                swal({
                                                    title: "Proses Berhasil",
                                                    text: data.message,
                                                    type: "success",
                                                });   
                                                setTimeout(function(){ document.location.href='/rollie/'+data.params },1000);
                                            } 
                                            else 
                                            {
                                                swal({
                                                    title: "Proses Gagal",
                                                    text: data.message,
                                                    type: "error",
                                                });
                                            }
                                        }
                                    });    
                                })
                            }
                        }

                    break
                }
            break;
            case 'ppq-engineering':
                var  root_cause                 = $('#root_cause').val();
                var  kategori_case              = $('#kategori_case').val();
                var  status_case                = $('#status_case').val();
                var  params_induk               = $('#params_induk').val();

                var  corrective_action          = [];
                $('textarea[name^="corrective_action"]').each(function()
                {
                    corrective_action.push(this.value);
                });
                var  pic_corrective_action          = [];
                $('input[name^="pic_corrective_action"]').each(function()
                {
                    pic_corrective_action.push(this.value);
                });

                var  due_date_corrective_action          = [];
                $('input[name^="due_date_corrective_action"]').each(function()
                {
                    due_date_corrective_action.push(this.value);
                });
                // console.log(due_date_corrective_action);

                var  status_corrective_action          = [];
                $('select[name^="status_corrective_action"]').each(function()
                {
                    status_corrective_action.push(this.value);
                });

                var  preventive_action          = [];
                $('textarea[name^="preventive_action"]').each(function()
                {
                    preventive_action.push(this.value);
                });
                var  pic_preventive_action          = [];
                $('input[name^="pic_preventive_action"]').each(function()
                {
                    pic_preventive_action.push(this.value);
                });

                var  due_date_preventive_action          = [];
                $('input[name^="due_date_preventive_action"]').each(function()
                {
                    due_date_preventive_action.push(this.value);
                });

                var  status_preventive_action          = [];
                $('select[name^="status_preventive_action"]').each(function()
                {
                    status_preventive_action.push(this.value);
                });
                // var params_input = '0';
                if (corrective_action[0] ==  '' || preventive_action[0] ==  '') 
                {
                    /*ini jika correvtive action atau preventivenya ga ada*/
                    Swal.fire
                    ({
                        title:  'Konfirmasi Corrective Action dan Preventive Action Follow Up PPQ',
                        text :  'Corrective Action atau Preventive Action follow up ppq tidak terisi',
                        type : 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Proses Hasil Follow Up PPQ',
                        cancelButtonText: 'Tidak, Input Corrective Action/ Preventive Action',
                    }).then((result) => 
                    {
                        if (result.value) 
                        {
                            if ( !root_cause ||  status_case == '10' || kategori_case =='10' ) 
                            {
                                swal({
                                    title: "Proses Gagal",
                                    text: "Harap lengkapi form follow up ppq terlebih dahulu",
                                    type: "error",
                                });
                            } 
                            else
                            {   
                                Swal.fire
                                ({
                                    title:  'Konfirmasi Proses Follow Up PPQ',
                                    text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim ',
                                    type : 'info',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Ya, Proses Hasil Follow Up PPQ',
                                    cancelButtonText: 'Tidak, Periksa Kembali hasil',
                                }).then((result) => 
                                {
                                    $.ajax({
                                        headers: 
                                        {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url         : '/rollie/form-follow-up-ppq/update-follow-up-ppq',
                                        method      : 'POST',
                                        dataType    : 'JSON',
                                        data        : 
                                        {
                                            follow_up_ppq_id            : follow_up_ppq_id,
                                            params                      : params,
                                            params_induk                : params_induk,
                                            root_cause                  : root_cause,
                                            kategori_case               : kategori_case,
                                            status_case                 : status_case,
                                            corrective_action           : corrective_action,
                                            pic_corrective_action       : pic_corrective_action,
                                            due_date_corrective_action  : due_date_corrective_action,
                                            status_corrective_action    : status_corrective_action,
                                            preventive_action           : preventive_action,
                                            pic_preventive_action       : pic_preventive_action,
                                            due_date_preventive_action  : due_date_preventive_action,
                                            status_preventive_action    : status_preventive_action,
                                            params_save                 : 'savenya',
                                        },
                                        success      : function(data) 
                                        {
                                            if (data.success == true) 
                                            {
                                                swal({
                                                    title: "Proses Berhasil",
                                                    text: data.message,
                                                    type: "success",
                                                });   
                                                setTimeout(function(){ document.location.href='/rollie/'+data.params },1000);
                                            } 
                                            else 
                                            {
                                                swal({
                                                    title: "Proses Gagal",
                                                    text: data.message,
                                                    type: "error",
                                                });
                                            }
                                        }
                                    });    
                                })
                            }                    
                        }
                    })   
                }
                else
                {   
                    if ( !root_cause ||  status_case == '10' || kategori_case =='10' ) 
                    {
                        swal({
                            title: "Proses Gagal",
                            text: "Harap lengkapi form follow up ppq terlebih dahulu",
                            type: "error",
                        });
                    } 
                    else
                    {   
                        Swal.fire
                        ({
                            title:  'Konfirmasi Proses Follow Up PPQ',
                            text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim ',
                            type : 'info',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya, Proses Hasil Follow Up PPQ',
                            cancelButtonText: 'Tidak, Periksa Kembali hasil',
                        }).then((result) => 
                        {
                            $.ajax({
                                headers: 
                                {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url         : '/rollie/form-follow-up-ppq/update-follow-up-ppq',
                                method      : 'POST',
                                dataType    : 'JSON',
                                data        : 
                                {
                                    follow_up_ppq_id            : follow_up_ppq_id,
                                    params                      : params,
                                    params_induk                : params_induk,
                                    root_cause                  : root_cause,
                                    kategori_case               : kategori_case,
                                    status_case                 : status_case,
                                    corrective_action           : corrective_action,
                                    pic_corrective_action       : pic_corrective_action,
                                    due_date_corrective_action  : due_date_corrective_action,
                                    status_corrective_action    : status_corrective_action,
                                    preventive_action           : preventive_action,
                                    pic_preventive_action       : pic_preventive_action,
                                    due_date_preventive_action  : due_date_preventive_action,
                                    status_preventive_action    : status_preventive_action,
                                    params_save                 : 'savenya',
                                },
                                success      : function(data) 
                                {
                                    if (data.success == true) 
                                    {
                                        swal({
                                            title: "Proses Berhasil",
                                            text: data.message,
                                            type: "success",
                                        });   
                                        setTimeout(function(){ document.location.href='/rollie/'+data.params },1000);
                                    } 
                                    else 
                                    {
                                        swal({
                                            title: "Proses Gagal",
                                            text: data.message,
                                            type: "error",
                                        });
                                    }
                                }
                            });    
                        })
                    }    
                }
            break;
        }
    }
    function validasiInputFollowUpRkj() 
    {
        var follow_up_rkj_id        = $('#follow_up_rkj_id').val();
        var params_route            = $('#params_route').val();
        var params                  = $('#params').val();

        
        if (params_route.includes('rkj-rnd-produk')) 
        {
            var  hasil_analisa          = $('#hasil_analisa').val();
            var  dugaan_penyebab        = $('#dugaan_penyebab').val();
            var  status_produk          = $('#status_produk').val();
            var  tanggal_status_produk  = $('#tanggal_status_produk').val();
            var  corrective_action          = [];
            $('textarea[name^="corrective_action"]').each(function()
            {
                corrective_action.push(this.value);
            });
            var  pic_corrective_action          = [];
            $('input[name^="pic_corrective_action"]').each(function()
            {
                pic_corrective_action.push(this.value);
            });

            var  due_date_corrective_action          = [];
            $('input[name^="due_date_corrective_action"]').each(function()
            {
                due_date_corrective_action.push(this.value);
            });
            
            var  status_corrective_action          = [];
            $('select[name^="status_corrective_action"]').each(function()
            {
                status_corrective_action.push(this.value);
            });
            if (corrective_action[0] ==  '') 
            {
                /*ini jika correvtive action atau preventivenya ga ada*/
                Swal.fire
                ({
                    title:  'Konfirmasi Corrective Action Follow Up RKJ',
                    text :  'Corrective Action atau Preventive Action follow up rkj tidak terisi',
                    type : 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Proses Hasil Follow Up Rkj',
                    cancelButtonText: 'Tidak, Input Corrective Action/ Preventive Action',
                }).then((result) => 
                {
                    if (result.value) 
                    {
                        if ( !dugaan_penyebab || !hasil_analisa || status_produk == '10' ) 
                        {
                            swal({
                                title: "Proses Gagal",
                                text: "Harap lengkapi form follow up rkj terlebih dahulu",
                                type: "error",
                            });
                        } 
                        else
                        {
                            Swal.fire
                            ({
                                title:  'Konfirmasi Proses Follow Up RKJ',
                                text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim email notifikasi ',
                                type : 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Proses Hasil Follow Up RKJ',
                                cancelButtonText: 'Tidak, Periksa Kembali hasil',
                            }).then((result) => 
                            {
                                if (result.value) 
                                {
                                    $.ajax({
                                        headers: 
                                        {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url         : '/rollie/form-follow-up-rkj/update-follow-up-rkj',
                                        method      : 'POST',
                                        dataType    : 'JSON',
                                        data        : 
                                        {
                                            follow_up_rkj_id        : follow_up_rkj_id,
                                            params                  : params,
                                            hasil_analisa           : hasil_analisa,
                                            dugaan_penyebab         : dugaan_penyebab,
                                            status_produk           : status_produk,
                                            tanggal_status_produk   : tanggal_status_produk,
                                            corrective_action               : corrective_action,
                                            pic_corrective_action           : pic_corrective_action,
                                            due_date_corrective_action      : due_date_corrective_action,
                                            status_corrective_action        : status_corrective_action,
                                            params_save             : 'savenya',
                                        },
                                        success      : function(data) 
                                        {
                                            if (data.success == true) 
                                            {
                                                swal({
                                                    title: "Proses Berhasil",
                                                    text: data.message,
                                                    type: "success",
                                                });   
                                                setTimeout(function(){ document.location.href='/rollie/'+data.params },1000);
                                            } 
                                            else 
                                            {
                                                swal({
                                                    title: "Proses Gagal",
                                                    text: data.message,
                                                    type: "error",
                                                });
                                            }
                                        }
                                    });        
                                }
                            })
                        }
                    }
                });
            }
            else
            {
                if ( !dugaan_penyebab || !hasil_analisa || status_produk == '10' ) 
                {
                    swal({
                        title: "Proses Gagal",
                        text: "Harap lengkapi form follow up rkj terlebih dahulu",
                        type: "error",
                    });
                } 
                else
                {
                    Swal.fire
                    ({
                        title:  'Konfirmasi Proses Follow Up RKJ',
                        text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim email notifikasi ',
                        type : 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Proses Hasil Follow Up RKJ',
                        cancelButtonText: 'Tidak, Periksa Kembali hasil',
                    }).then((result) => 
                    {
                        if (result.value) 
                        {
                            $.ajax({
                                headers: 
                                {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url         : '/rollie/form-follow-up-rkj/update-follow-up-rkj',
                                method      : 'POST',
                                dataType    : 'JSON',
                                data        : 
                                {
                                    follow_up_rkj_id        : follow_up_rkj_id,
                                    params                  : params,
                                    hasil_analisa           : hasil_analisa,
                                    dugaan_penyebab         : dugaan_penyebab,
                                    status_produk           : status_produk,
                                    tanggal_status_produk   : tanggal_status_produk,
                                    corrective_action               : corrective_action,
                                    pic_corrective_action           : pic_corrective_action,
                                    due_date_corrective_action      : due_date_corrective_action,
                                    status_corrective_action        : status_corrective_action,
                                    params_save             : 'savenya',
                                },
                                success      : function(data) 
                                {
                                    if (data.success == true) 
                                    {
                                        swal({
                                            title: "Proses Berhasil",
                                            text: data.message,
                                            type: "success",
                                        });   
                                        setTimeout(function(){ document.location.href='/rollie/'+data.params },1000);
                                    } 
                                    else 
                                    {
                                        swal({
                                            title: "Proses Gagal",
                                            text: data.message,
                                            type: "error",
                                        });
                                    }
                                }
                            });        
                        }
                    })
                }
            }
        }
        else
        {
            var  nomor_rkp              = $('#nomor_rkp').val();
            var  hasil_investigasi      = $('#hasil_investigasi').val();
            var  status_case            = $('#status_case').val();
            var  tanggal_loi            = $('#tanggal_loi').val();
            var  preventive_action          = [];
            $('textarea[name^="preventive_action"]').each(function()
            {
                preventive_action.push(this.value);
            });
            var  pic_preventive_action          = [];
            $('input[name^="pic_preventive_action"]').each(function()
            {
                pic_preventive_action.push(this.value);
            });

            var  due_date_preventive_action          = [];
            $('input[name^="due_date_preventive_action"]').each(function()
            {
                due_date_preventive_action.push(this.value);
            });
            var  status_preventive_action          = [];
            $('select[name^="status_preventive_action"]').each(function()
            {
                status_preventive_action.push(this.value);
            });
            if (preventive_action[0] ==  '') 
            {
                /*ini jika correvtive action atau preventivenya ga ada*/
                Swal.fire
                ({
                    title:  'Konfirmasi Preventive Action Follow Up RKJ',
                    text :  'Corrective Action atau Preventive Action follow up rkj tidak terisi',
                    type : 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Proses Hasil Follow Up Rkj',
                    cancelButtonText: 'Tidak, Input  Preventive Action',
                }).then((result) => 
                {
                    if (result.value) 
                    {
                        if ( !nomor_rkp || !hasil_investigasi || status_case == '10' || !tanggal_loi ) 
                        {
                            swal({
                                title: "Proses Gagal",
                                text: "Harap lengkapi form follow up rkj terlebih dahulu",
                                type: "error",
                            });
                        } 
                        else
                        {
                            Swal.fire
                            ({
                                title:  'Konfirmasi Proses Follow Up RKJ',
                                text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim email notifikasi ',
                                type : 'info',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Ya, Proses Hasil Follow Up RKJ',
                                cancelButtonText: 'Tidak, Periksa Kembali hasil',
                            }).then((result) => 
                            {
                                if (result.value) 
                                {
                                    $.ajax({
                                        headers: 
                                        {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        url         : '/rollie/form-follow-up-rkj/update-follow-up-rkj',
                                        method      : 'POST',
                                        dataType    : 'JSON',
                                        data        : 
                                        {
                                            follow_up_rkj_id                : follow_up_rkj_id,
                                            params                          : params,
                                            nomor_rkp                       : nomor_rkp,
                                            hasil_investigasi               : hasil_investigasi,
                                            status_case                     : status_case,
                                            tanggal_loi                     : tanggal_loi,
                                            preventive_action               : preventive_action,
                                            pic_preventive_action           : pic_preventive_action,
                                            due_date_preventive_action      : due_date_preventive_action,
                                            status_preventive_action        : status_preventive_action,
                                            
                                            params_save             : 'savenya',
                                        },
                                        success      : function(data) 
                                        {
                                            if (data.success == true) 
                                            {
                                                swal({
                                                    title: "Proses Berhasil",
                                                    text: data.message,
                                                    type: "success",
                                                });   
                                                setTimeout(function(){ document.location.href='/rollie/'+data.params },1000);
                                            } 
                                            else 
                                            {
                                                swal({
                                                    title: "Proses Gagal",
                                                    text: data.message,
                                                    type: "error",
                                                });
                                            }
                                        }
                                    });        
                                }
                            })
                        }
                    }
                });
            }
            else
            {
                if ( !nomor_rkp || !hasil_investigasi || status_case == '10' || !tanggal_loi ) 
                {
                    swal({
                        title: "Proses Gagal",
                        text: "Harap lengkapi form follow up rkj terlebih dahulu",
                        type: "error",
                    });
                } 
                else
                {
                    Swal.fire
                    ({
                        title:  'Konfirmasi Proses Follow Up RKJ',
                        text :  'Apakah anda data follow up sudah diinput dengan sesuai dan benar? Jika sudah benar maka sistem akan memproses hasil follow up dan mengirim email notifikasi ',
                        type : 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Proses Hasil Follow Up RKJ',
                        cancelButtonText: 'Tidak, Periksa Kembali hasil',
                    }).then((result) => 
                    {
                        if (result.value) 
                        {
                            $.ajax({
                                headers: 
                                {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url         : '/rollie/form-follow-up-rkj/update-follow-up-rkj',
                                method      : 'POST',
                                dataType    : 'JSON',
                                data        : 
                                {   
                                    follow_up_rkj_id                : follow_up_rkj_id,
                                    params                          : params,
                                    nomor_rkp                       : nomor_rkp,
                                    hasil_investigasi               : hasil_investigasi,
                                    status_case                     : status_case,
                                    tanggal_loi                     : tanggal_loi,
                                    preventive_action               : preventive_action,
                                    pic_preventive_action           : pic_preventive_action,
                                    due_date_preventive_action      : due_date_preventive_action,
                                    status_preventive_action        : status_preventive_action,
                                    params_save             : 'savenya',
                                },
                                success      : function(data) 
                                {
                                    if (data.success == true) 
                                    {
                                        swal({
                                            title: "Proses Berhasil",
                                            text: data.message,
                                            type: "success",
                                        });   
                                        setTimeout(function(){ document.location.href='/rollie/'+data.params },1000);
                                    } 
                                    else 
                                    {
                                        swal({
                                            title: "Proses Gagal",
                                            text: data.message,
                                            type: "error",
                                        });
                                    }
                                }
                            });        
                        }
                    })
                }
            }
        }
    }

    function prosesFollowUpRkj(rkj_id,nomor_rkj,nama_produk,alasan_rkj,status_akhir,params) 
    {
        if (status_akhir == '0') /*  jika status ppq nya new ppq */ 
        {
            Swal.fire
            ({
                title:  'Konfirmasi Follow Up RKJ '+nomor_rkj,
                text :  'Apakah anda yakin akan melakukan proses follow up RKJ produk '+nama_produk+' case '+ alasan_rkj +' dengan nomor rkj '+ nomor_rkj+'?',
                type : 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Proses Follow Up RKJ',
                cancelButtonText: 'Cancel',
            }).then((result) => 
            {
                if(result.value)
                {
                    $.ajax({
                        headers: 
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url         : '/rollie/proses-follow-up-rkj',
                        method      : 'POST',
                        dataType    : 'JSON',
                        data        : 
                        {
                            rkj_id      : rkj_id,
                            params      : params,
                        },
                        success      : function(data) 
                        {
                            if (data.success == true) 
                            {
                                swal({
                                    title: "Proses Berhasil",
                                    text: data.message,
                                    type: "success",
                                });   
                                setTimeout(function(){ document.location.href='/rollie/form-follow-up-rkj/'+data.follow_up_rkj_id+'/'+data.params },1000);
                            } 
                            else 
                            {
                                swal({
                                    title: "Proses Gagal",
                                    text: data.message,
                                    type: "error",
                                });
                            }
                        }
                    });    
                }
            });
        } 
        else if(status_akhir !== '0' )
        {
            document.location.href='/rollie/form-follow-up-rkj/'+$('#follow_up_rkj_id_'+rkj_id).val()+'/'+params
        }
    }
/* End Fisikokimia */
/* End Data Analysis */

/* Start Analisa Mikro */
function changeFillingMikro(analisa_mikro_id) 
{
    var jam_filling_mikro       = $('#jam_filling_'+analisa_mikro_id).val();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url         : 'ubah-jam-filling',
        method      : 'POST',
        dataType    : 'JSON',
        data        : 
        {
            jam_filling_mikro   : jam_filling_mikro,
            analisa_mikro_id    : analisa_mikro_id
        },
        success      : function(data) 
        {
            if (data.success == true) 
            {
                // swal({
                //     title: "Proses Berhasil",
                //     text: data.message,
                //     type: "success",
                // });
            } 
            else 
            {
                swal({
                    title: "Proses Gagal",
                    text: data.message,
                    type: "error",
                }); 
                
            }
        }
    });
}
function getFillingSampelMikro() 
{
    $.ajax({
        url     : 'ambil-kode-sampel/'+$('#filling_machine_id').val()+'/'+$('#product_type_id').val(),
        method  : 'GET',
        dataType: 'JSON',
        success : function(data) 
        {
            var kode_sampel_analisa = '<option disabled selected>-- Pilih Kode Sampel PI --</option>', $combosampel = $('#kode_sampel_analisa');
            for (index = 0; index < data.length; index++) 
            {
                kode_sampel_analisa+='<option  value="'+data[index].enkripsi_id+'" >'+data[index].filling_sampel_code+'-'+data[index].filling_sampel_event+'</option>';   
            }
            $combosampel.html(kode_sampel_analisa).on('change');
            $('.select2').select2();
            
            // checkFillingSampel();
        }
    });
}
/* End Analisa Mikro */
/* START RKOL */
    function cekTindakanFollowUp() 
    {
        var tindakan = $('#tindakan').val();
        if (tindakan == 'rkj') 
        {
            // apabila pilihannya rkj akan buat rkj 
            $('#corrective').addClass('hidden');
            Swal.fire({
                title       : 'Lakukan perpindahan proses PPQ dengan RKJ ?',
                text        : "Setelah melakukan konfirmasi ini anda akan dialihkan ke halaman pembuatan RKJ",
                type        : 'info',
                showCancelButton    : true,
                confirmButtonColor  : '#3085d6',
                cancelButtonColor   : '#d33',
                confirmButtonText   : 'Ya, Buat RKJ!'
            }).then((result) => 
            {
                if (result.value) 
                {
                    $.ajax({
                        headers:
                        {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: '/rollie/form-follow-up-ppq/proses-ppq-to-rkj',
                        method: 'POST',
                        dataType: 'JSON',
                        data: 
                        { 
                            'hasil_analisa'         : $('#hasil_analisa').val(),
                            'ppq_id'                : $('#ppq_id').val(),
                        },
                        success: function (data) 
                        {
                            if (data.success == true) 
                            {
                                swal({
                                    title   : "Success",
                                    text    : data.message,
                                    type    : "success"
                                });
                                var url     = $('#params_route').val();
                                window.location.href    = "/rollie/ppq-qc-tahanan";
                            } 
                            else 
                            {
                                swal({
                                    title   : "Failed",
                                    text    : 'Ada kesalahan',
                                    type    : "error"
                                });
                            }
                        },
                    });
                }
                else
                {
                    $('#tindakan option').prop('selected', function() {
                        return this.defaultSelected;
                    });
                    $('#status_produk_div').addClass('hidden');
                    $('#hasil_evaluasi_div').removeClass('col-lg-6 col-md-6 col-sm-6');
                    $('#hasil_evaluasi_div').addClass('col-lg-12 col-md-12 col-sm-12');
                } 
            })
        } 
        else 
        {
            // apabila bukan akan menghilangkan hidden corrective
            $('#corrective').removeClass('hidden');
            $('#status_produk_div').removeClass('hidden');
            $('#hasil_evaluasi_div').removeClass('col-lg-12 col-md-12 col-sm-12');
            $('#hasil_evaluasi_div').addClass('col-lg-6 col-md-6 col-sm-6');
        }
    }
    function cloneCorrectiveAction() 
    {
        var myDiv = document.getElementById("corrective_action_div");
        document.getElementById('corrective_action_body').appendChild(myDiv.cloneNode(true));
        $('#corrective_action_div:last').find("textarea").val("");
        $('#corrective_action_div:last').find("input:text").val("");
        // $('#corrective_action_div:last').find("input:date").val("");
    }

    function clonePreventiveAction() 
    {
        var myDiv = document.getElementById("preventive_action_div");
        document.getElementById('preventive_action_body').appendChild(myDiv.cloneNode(true));
        $('#preventive_action_div:last').find("textarea").val("");
        $('#preventive_action_div:last').find("input:text").val("");
        // $('#preventive_action_div:last').find("input:date").val("");
    }
    function openClose() {
        var icon = document.getElementById('iconnya');
        if(icon.className == 'pull-right fa fa-arrow-down')
        {
            icon.className = 'pull-right fa fa-arrow-down open';  
        } 
        else
        {
            icon.className = 'pull-right fa fa-arrow-down';
        }
    }
    function prosesPpqAnalisaMikro(params_suhu)
    {
        var params_suhu         = params_suhu;
        var nomor_ppq        = $('#nomor_ppq_'+params_suhu).val()          ;
        var ppq_id           = $('#ppq_id_'+params_suhu).val()             ;
        var wo_number        = $('#wo_number_'+params_suhu).val()          ;
        var product_name     = $('#product_name_'+params_suhu).val()       ;
        var oracle_code      = $('#oracle_code_'+params_suhu).val()        ;
        var tanggal_produksi = $('#tanggal_produksi_'+params_suhu).val()   ;
        var filling_machine  = $('#filling_machine_'+params_suhu).val()    ;
        var mesin_filling_id = $('#mesin_filling_id_'+params_suhu).val()   ;
        var nolot            = $('#nolot_'+params_suhu).val()              ;
        var nolot_id         = $('#nolot_'+params_suhu).val()              ;
        var jumlah_pack      = $('#jumlah_pack_'+params_suhu).val()        ;
        var tanggal_ppq      = $('#tanggal_ppq_'+params_suhu).val()        ;
        var jam_filling_mulai= $('#jam_filling_mulai_'+params_suhu).val()  ;
        var jam_filling_akhir= $('#jam_filling_akhir_'+params_suhu).val()  ;
        var alasan_ppq       = $('#alasan_ppq_'+params_suhu).val()         ;
        var detail_titik_ppq = $('#detail_titik_ppq_'+params_suhu).val()   ;
        var kategori_ppq_id  = $('#kategori_ppq_id_'+params_suhu).val()    ;
        var decode_1           = $('#decode_1').val()    ;
        var decode_2           = $('#decode_2').val()    ;
        var encode_1           = $('#encode_1').val()    ;
        var encode_2           = $('#encode_2').val()    ;
        var auto_code          = $('#auto_code').val()    ;
        // console.log($('.ppq').length);
        // $('#div_ppq_30').hide();
        // console.log($('.ppq').length);

        Swal.fire({
            title: 'Konfirmasi Data PPQ Suhu '+params_suhu,
            text: 'Apakah anda yakin apa memproses data PPQ Produk '+product_name+' karena mikro #OK pada suhu preinkubasi '+params_suhu+'?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Proses PPQ ',
            cancelButtonText: 'Tidak, proses yang lain',
        }).then((result) => {
            if (result.value) 
            {
                $.ajax({
                    headers: 
                    {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/rollie/analisa-mikro-release/form-ppq/proses-ppq', 
                    method: 'POST',
                    dataType: 'JSON',
                    data:
                    {
                        'ppq_id'            : ppq_id,
                        'alasan_ppq'        : alasan_ppq,
                        'detail_titik_ppq'  : detail_titik_ppq,
                        'kategori_ppq_id'   : kategori_ppq_id,
                        'jumlah_pack'       : jumlah_pack
                    },
                    success: function (data) 
                    {
                        if (data.success)
                        {
                            swal({
                                'title' : 'Berhasil',
                                'text'  : 'PPQ Ketidaksesuaian Mikro 30 Sudah berhasil di input.',
                                'type'  : 'success'
                            });  
                            if (params_suhu  == '30') 
                            {
                                if (decode_2 == 'null' ) 
                                {
                                    window.setTimeout(function () {
                                        window.location.href='/rollie/analisa-mikro-release';
                                    },1000);
                                } 
                                else
                                {
                                    window.location.href='/rollie/analisa-mikro-release/form-ppq/'+auto_code+'/'+encode_2;
                                }
                            } 
                            else if(params_suhu == '55') 
                            {
                                if (decode_1 == 'null') 
                                {
                                    window.setTimeout(function () {
                                        window.location.href='/rollie/analisa-mikro-release';
                                    },1000);
                                } 
                                else
                                {
                                    window.location.href='/rollie/analisa-mikro-release/form-ppq/'+encode_1+'/'+auto_code;
                                }
                            }
                        }
                        else    
                        {
                            swal({
                                'title'     : 'Error',
                                'text'      : data.message,
                                'type'      : 'error'
                            });
                        }
                    }  
                });
            }
        });

    }
/* END RKOL */

/* Start Report */
    /* Start Report RPD  */
        function filterTanggalProduksi(tanggal_produksi) 
        {
            tanggal_produksi    = tanggal_produksi.replace('/','-');
            tanggal_produksi    = tanggal_produksi.replace('/','-');
            tanggal_produksi    = tanggal_produksi.replace('/','-');
            tanggal_produksi    = tanggal_produksi.replace('/','-');
            tanggal_produksi    = tanggal_produksi.replace(' - ',' s.d ');
            // tanggal_produksi    = tanggal_produksi.replace(' - ',' s.d ');
            $.ajax({
                url     : '/rollie/report-rpd-filling/filter-tanggal-produksi/'+tanggal_produksi,
                method  : 'GET',
                dataType: 'JSON',
                success : function(data) 
                {
                    var optionwo = '', $combowo = $('#product_id');
                    for (i = 0; i < data.length; i++) 
                    {
                        for ( b = 0; b < data[i].length; b++) {
                            optionwo += "<option value='"+data[i][b].product.enkripsi_id+"'>"+data[i][b].product.product_name+"</option>";
                        }
                    }
                    $combowo.html(optionwo).on('change');
                    refreshTableReportRpd(data);
                    
                }
            });
        }

        function filterProductName()
        {
            product_id          = [];
            $.each($("#product_id option:selected"), function(){
                product_id.push($(this).val());
            });
            tanggal_produksi    = $('#filter_tanggal').val();
            tanggal_produksi    = tanggal_produksi.replace('/','-');
            tanggal_produksi    = tanggal_produksi.replace('/','-');
            tanggal_produksi    = tanggal_produksi.replace('/','-');
            tanggal_produksi    = tanggal_produksi.replace('/','-');
            tanggal_produksi    = tanggal_produksi.replace(' - ',' s.d ');
            $.ajax({
                url     : '/rollie/report-rpd-filling/filter-produk/'+product_id+'/'+tanggal_produksi,
                method  : 'GET',
                dataType: 'JSON',
                success : function(data) 
                {
                    var optionwo = '', $combowo = $('#wo_number_id');
                    for (i = 0; i < data.length; i++) 
                    {
                        for (z = 0; z < data[i].length; z++) 
                        {
                            optionwo += "<option value='"+data[i][z].enkripsi_id+"'>"+data[i][z].wo_number+"</option>";
                        }
                    }
                    console.log(optionwo);
                    $combowo.html(optionwo).on('change');
                    refreshTableReportRpd(data);
                }
            });
        }
        function filterWoNumber()
        {
            wo_number_id          = [];
            $.each($("#wo_number_id option:selected"), function(){
                wo_number_id.push($(this).val());
            });
            $.ajax({
                url     : '/rollie/report-rpd-filling/filter-wo/'+wo_number_id,
                method  : 'GET',
                dataType: 'JSON',
                success : function(data) 
                {
                    refreshTableReportRpd(data);
                }
            });
        }
        function refreshTableReportRpd(data) 
        {
            for (a = 0; a < data.length; a++) 
            {
                var isitable = '', $table = $('#isi-report-rpd-filling');
                for (i = 0; i < data[a].length; i++) 
                {
                    //$('#report-rpd-filling').dataTable().fnDestroy();
                    for ( j = 0; j < data[a][i].rpd_filling_detail_pis.length; j++) 
                    {
                        isitable += "<tr>";
                        isitable += "<td >"+ data[a][i].wo_number +"</td>";
                        isitable += "<td >"+ data[a][i].product.product_name +"</td>";
                        isitable += "<td >"+ data[a][i].production_realisation_date +"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].filling_machine.filling_machine_code +"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].filling_sampel_code.filling_sampel_code +" - "+ data[a][i].rpd_filling_detail_pis[j].filling_sampel_code.filling_sampel_event +"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].filling_date +"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].filling_time +"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].berat_kanan+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].berat_kiri+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].overlap+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].ls_sa_proportion+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].volume_kanan+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].volume_kiri+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].airgap+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].ts_accurate_kanan+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].ts_accurate_kiri+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].ls_accurate+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].sa_accurate+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].surface_check+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].pinching+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].strip_folding+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].konduktivity_kanan+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].konduktivity_kiri+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].design_kanan+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].design_kiri+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].dye_test+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].residu_h2o2+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].prod_code_and_no_md+"</td>";
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].correction+"</td>";
                        if (!data[a][i].rpd_filling_detail_pis[j].dissolving_test) 
                        {
                            isitable += "<td > - </td>";
                            
                        } 
                        else 
                        {
                            isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].dissolving_test+"</td>";                    
                        }
                        isitable += "<td >"+ data[a][i].rpd_filling_detail_pis[j].status_akhir+"</td>";                    
                        isitable += "</tr>";                    
                    }      
                    $table.html(isitable).on('change');
                }
            }
        }
    /* End Report RPD  */
/* END Report */
