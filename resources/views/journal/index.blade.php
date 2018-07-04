@extends('layouts.base')
@section('title','Assets')
@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('account')}}/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('account')}}/vendors/css/tables/datatable/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('account')}}/vendors/css/tables/extensions/keyTable.dataTables.min.css">
@endsection
@section('select_firm')
    <ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
        <li class="nav-item">
            <a class="nav-link" style="cursor: context-menu" href="javascript:void(0)"><span>Select Firms {{ Session::get('data') }}</span></a>
        </li>
        <li class="nav-item">
            <select name="" id="select_firm" onchange="select_firm(this.value)" class="form-control" style="margin-top: 6px">
                <option value="0">- Select Firm -</option>
                @foreach($firm as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
        </li>
    </ul>
@endsection
@section('content')
    <div class="app-content container center-layout mt-2">
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body"><!-- Analytics spakline & chartjs  -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <style>
                            @keyframes show{
                                from{opacity: 0}
                                to{opacity: 100}
                            }
                        </style>
                        <div class="card" style="">
                            <div class="card-header border-0-bottom">
                                <h4 class="card-title">General Journal</h4>
                                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                                <div class="heading-elements">
                                    <ul class="list-inline mb-0">
                                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12" id="data">
                                            <style>
                                                input{
                                                    width: 100%;
                                                }
                                                .table select{
                                                    width: 100%;height: 27px;
                                                }
                                            </style>
                                            <table class="table table-striped table-bordered dataex-key-basic">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Select Asset</th>
                                                    <th>Asset Number</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>
                                                        <select style="" name="" id="">
                                                            <option value="">- Select Account -</option>
                                                        </select>
                                                    </td>
                                                    <td><input type="text"></td>
                                                    <td><input type="text"></td>
                                                    <td><input type="text"></td>
                                                </tr>
                                                <tfoot>
                                                <tr>
                                                    <td colspan="5" class="text-center">
                                                        <a href=""><span class="fa fa-plus"></span></a>
                                                    </td>
                                                </tr>
                                                </tfoot>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection