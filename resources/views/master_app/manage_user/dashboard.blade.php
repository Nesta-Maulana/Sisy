@extends('layouts.app')
@section('title')
    Data Pengguna
@endsection
@section('menu-open-general-setting') 
    active menu-open
@endsection
@section('active-master-app-manage-user') 
    active 
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header bg-dark">
                    Data Pengguna
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                            <table class="table table-bordered" id="manage-user-table" style="min-width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        <th  style="width: 130px">Fullname</th>
                                        <th >Username</th>
                                        <th >Email</th>
                                        <th >Departemen</th>
                                        <th >List Distribution Email</th>
                                        <th >Status Akun</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <button class="btn btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </td>
                                        <td>{{ $user->employee->fullname }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->employee->email }}</td>
                                        <td>{{ $user->employee->departement->departement }}</td>
                                        <td>
                                            <table class="table table-bordered table-striped" style="border : 1px solid black">
                                                <thead>
                                                    <tr>
                                                        <th>PPQ Mail TO</th>
                                                        <th>PPQ Mail CC</th>

                                                        <th>RKJ NFI Mail TO</th>
                                                        <th>RKJ NFI Mail CC</th>

                                                        <th>RKJ HB Mail TO</th>
                                                        <th>RKJ HB Mail CC</th>

                                                        <th>RKJ WRP Mail TO</th>
                                                        <th>RKJ WRP Mail CC</th>

                                                        <th>RKJ Sortasi Mail TO</th>
                                                        <th>RKJ Sortasi Mail CC</th>

                                                        <th>RKJ PSR TO</th>
                                                        <th>RKJ PSR CC</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (is_null(($user->employee->distributionList)))
                                                        <tr>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                            <td>-</td>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>
                                                                @if ($user->employee->distributionList->ppq_mail_to == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->employee->distributionList->ppq_mail_cc == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->employee->distributionList->rkj_nfi_mail_to == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->employee->distributionList->rkj_nfi_mail_cc == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if ($user->employee->distributionList->rkj_hb_mail_to == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->employee->distributionList->rkj_hb_mail_cc == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if ($user->employee->distributionList->rkj_wrp_mail_to == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->employee->distributionList->rkj_wrp_mail_cc == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if ($user->employee->distributionList->sortasi_mail_to == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->employee->distributionList->sortasi_mail_cc == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @if ($user->employee->distributionList->psr_mail_to == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($user->employee->distributionList->psr_mail_cc == '1')
                                                                    <i class="fas fa-check"></i>
                                                                @else
                                                                    <i class="fas fa-window-close"></i>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </td>
                                        <td>
                                            @if ($user->is_active == '1')
                                                <label class="">Active</label>
                                            @else
                                                <label class="">Inactive</label>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection