@extends('layouts.app')
@section('title')
    Ubah Data Pengguna 
@endsection
@section('menu-open-general-setting') 
    active menu-open
@endsection
@section('active-master-app-manage-user') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header bg-dark text-bold">
                    Data Pengguna 
                </div>
                <div class="card-body">
                    <form action="update" method="post" id="form-input">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <input type="hidden" name="user_id" value="{{ app('App\Http\Controllers\ResourceController')->encrypt($user->id) }}">
                                <div class="form-group">
                                    <label for="fullname">Fullname</label>
                                    <input type="text" name="fullname" id="fullname" class="form-control" placeholder="fullname" aria-describedby="fullname" value="{{ $user->employee->fullname }}">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="email" aria-describedby="email" value="{{ $user->employee->email }}" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="username" aria-describedby="username" value="{{ $user->username }}">
                                </div>
                                <div class="form-group">
                                    <label for="departement_id">Departement</label>
                                    <select name="departement_id" id="departement_id" class="form-control">
                                        @foreach ($departements as $departemen)
                                        <option value="{{ app('App\Http\Controllers\ResourceController')->encrypt($departemen->id) }}">{{ $departemen->departement }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="form-group">
                                    <label for="distribution_list" class="text-bold">Email Notifikasi</label>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" style="min-width: 100%;">
                                            <thead>
                                                <tr class="nowrap">
                                                    <th>PPQ Mail TO</th>
                                                    <th>PPQ Mail CC</th>
            
                                                    <th>RKJ NFI Mail TO</th>
                                                    <th>RKJ NFI Mail CC</th>
            
                                                    <th>RKJ HB Mail TO</th>
                                                    <th>RKJ HB Mail CC</th>
            
                                                    <th>RKJ WRP Mail TO</th>
                                                    <th>RKJ WRP Mail CC</th>
            
                                                    <th>Sortasi Mail TO</th>
                                                    <th>Sortasi Mail CC</th>
            
                                                    <th>PSR Mail TO</th>
                                                    <th>PSR Mail CC</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (is_null($user->employee->distributionList))
                                                    @php
                                                        $checked = '';
                                                    @endphp
                                                @else
                                                @php
                                                        $checked =app('App\Http\Controllers\ResourceController')->encrypt($user->employee->distributionList->id);
                                                    @endphp
                                                @endif
                                                <input type="hidden" value="{{ $checked }}" name="distribution_list_id">
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" value="" id="ppq_mail_to"  @if ($checked !== '') @if ($user->employee->distributionList->ppq_mail_to == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" value="" id="ppq_mail_cc" @if ($checked !== '') @if ($user->employee->distributionList->ppq_mail_cc == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    <td>
                                                        <input type="checkbox" value="" id="rkj_nfi_mail_to" @if ($checked !== '') @if ($user->employee->distributionList->rkj_nfi_mail_to == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="rkj_nfi_mail_cc" @if ($checked !== '') @if ($user->employee->distributionList->rkj_nfi_mail_cc == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="rkj_hb_mail_to" @if ($checked !== '') @if ($user->employee->distributionList->rkj_hb_mail_to == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="rkj_hb_mail_cc" @if ($checked !== '') @if ($user->employee->distributionList->rkj_hb_mail_cc == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="rkj_wrp_mail_to" @if ($checked !== '') @if ($user->employee->distributionList->rkj_wrp_mail_to == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="rkj_wrp_mail_cc" @if ($checked !== '') @if ($user->employee->distributionList->rkj_wrp_mail_cc == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="sortasi_mail_to" @if ($checked !== '') @if ($user->employee->distributionList->sortasi_mail_to == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="sortasi_mail_cc" @if ($checked !== '') @if ($user->employee->distributionList->sortasi_mail_cc == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="psr_mail_to" @if ($checked !== '') @if ($user->employee->distributionList->psr_mail_to == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    
                                                    <td>
                                                        <input type="checkbox" value="" id="psr_mail_cc" @if ($checked !== '') @if ($user->employee->distributionList->psr_mail_cc == '1') checked @endif  @endif data-bootstrap-switch>
                                                    </td>
                                                    <input type="hidden" name="mail[ppq_mail_to]" id="ppq_mail_to_text">
                                                    <input type="hidden" name="mail[ppq_mail_cc]" id="ppq_mail_cc_text">
                                                    <input type="hidden" name="mail[rkj_nfi_mail_to]" id="rkj_nfi_mail_to_text">
                                                    <input type="hidden" name="mail[rkj_nfi_mail_cc]" id="rkj_nfi_mail_cc_text">
                                                    <input type="hidden" name="mail[rkj_hb_mail_to]" id="rkj_hb_mail_to_text">
                                                    <input type="hidden" name="mail[rkj_hb_mail_cc]" id="rkj_hb_mail_cc_text">
                                                    <input type="hidden" name="mail[rkj_wrp_mail_to]" id="rkj_wrp_mail_to_text">
                                                    <input type="hidden" name="mail[rkj_wrp_mail_cc]" id="rkj_wrp_mail_cc_text">
                                                    <input type="hidden" name="mail[sortasi_mail_to]" id="sortasi_mail_to_text">
                                                    <input type="hidden" name="mail[sortasi_mail_cc]" id="sortasi_mail_cc_text">
                                                    <input type="hidden" name="mail[psr_mail_to]" id="psr_mail_to_text">
                                                    <input type="hidden" name="mail[psr_mail_cc]" id="psr_mail_cc_text">
                                                </tr>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <div class="form-group">
                                    <a class="btn btn-primary form-control text-white" onclick="submitForm()">Ubah Data Pengguna</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @section('extract-plugin-footer')
    <link rel="stylesheet" href="{{ asset('css/master/bootstrap-switch.min.css') }}">
        <script src="{{ asset('js/master/bootstrap-switch.min.js') }}"></script>
        <script>
            $("input[data-bootstrap-switch]").each(function(){
                $(this).bootstrapSwitch('state', $(this).prop('checked'));
            });
            function submitForm() 
            {
                $("input[data-bootstrap-switch]").each(function(){
                    if (this.checked) 
                    {
                        $('#'+this.id+'_text').val('on');
                    }
                    else
                    {
                        $('#'+this.id+'_text').val('off');
                    }
                });  
                $('#form-input').submit();
            }

        </script>
    @endsection
@endsection