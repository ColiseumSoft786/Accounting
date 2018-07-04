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
@section('script')
    <script src="{{asset('account')}}/vendors/js/tables/datatable/datatables.min.js" type="text/javascript"></script>
    <script src="{{asset('account')}}/vendors/js/tables/datatable/dataTables.fixedHeader.min.js" type="text/javascript"></script>
    <script src="{{asset('account')}}/vendors/js/tables/datatable/dataTables.keyTable.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="{{asset('account')}}/js/scripts/ui/breadcrumbs-with-stats.min.js"></script>
    <script src="{{asset('account')}}/js/scripts/tables/datatables-extensions/datatable-keytable.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2"></script>
    <script>
//        toastr.success("Have fun storming the castle!","Miracle Max Says");
        var data;
        var A,B,C,D;
        /*$.ajax({
            url: '/getjsonofassets',
            type: 'get',
            success: function(result){
                result = JSON.parse(result);
                data = result;
                console.log(data);
                start();
            }
        });*/
       function select_firm(firm){
            //var firm = $(this).val();
            //alert(firm);
            sulf(firm);
        };
        function sulf(firm){
            $.ajax({
                url: '/getjsonofassets?firm='+firm,
                type: 'get',
                success: function(result){
                    result = JSON.parse(result);
                    data = result;
                    console.log(data);
                        start();
                }
            });
        }
        function start(){
            $('#ajax_data_head').html('');
            $('#backasset').html("");
            if(data.length !== 0){
                var value = "Ahello";
                var html = "";
                for(var i=0;i<data.length;i++){
                    html += "<h5><a onclick='second("+i+")' href='javascript:void(0)'>"+data[i].Name+" <span>( "+data[i].Code+" )</span>" +
                        "</a><i class='pull-right' onclick='deleteItem(\"mhead\","+data[i].Id+")'><span class='fa fa-cut'></span></i></h5>";


                }
                $('#ajax_data').html(html);
            }else{
                $('#ajax_data').html("<p class='text-center'>Nothing Found...</p>");
            }
            createinput("mhead",-1);
        }

        function second(a){
            A = a;
            $('#backasset').html("<a onclick='start()' href='javascript:void(0)'>< Back</a>");
            var html = "";
            var head = data[a].Head;
            if(head.length !== 0){
                for(var i=0;i< head.length;i++){
                    html += "<h5><a onclick='third("+a+","+i+")' href='javascript:void(0)'>"+head[i].Name+" <span>( "+head[i].Code+" )</span></a><i class='pull-right' onclick='deleteItem(\"head\","+head[i].Id+")'><span class='fa fa-cut'></span></i></h5>";
                }
                $('#ajax_data').html(html);
            }else{
                $('#ajax_data').html("<p class='text-center'>Nothing Found...</p>");
            }
            $('#ajax_data_head').html(data[a].Name + " > ");

            createinput("head",data[a].Id);

        }
        function third(a,b){
            A=a;B=b;
            $('#backasset').html("<a onclick='second("+a+")' href='javascript:void(0)'>< Back</a>");
            var html = "";
            var head = data[a].Head;
            var cat = head[b].Categ;
            $('#ajax_data_head').html(data[a].Name + " > " + head[b].Name + " > ");

            if(cat.length !== 0){
                for(var i=0;i< cat.length;i++){
                    html += "<h5><a onclick='fourth("+a+","+b+","+i+")' href='javascript:void(0)'>"+cat[i].Name+" <span>( "+cat[i].Code+" )</span></a><i class='pull-right' onclick='deleteItem(\"cat\","+cat[i].Id+")'><span class='fa fa-cut'></span></i></h5>";
                }
                $('#ajax_data').html(html);
            }else{
                $('#ajax_data').html("<p class='text-center'>Nothing Found...</p>");
            }


            createinput("cat",head[b].Id);
        }
        function fourth(a,b,c){
            A=a;B=b;C=c;
            $('#backasset').html("<a onclick='third("+a+","+b+")' href='javascript:void(0)'>< Back</a>");
            var html = "";
            var head = data[a].Head;
            var cat = head[b].Categ;
            var type = cat[c].Type;
            $('#ajax_data_head').html(data[a].Name + " > " + head[b].Name + " > " + cat[c].Name + " > ");

            if(type.length !== 0){
                for(var i=0;i< type.length;i++){
                    html += "<h5><a onclick='fifth("+a+","+b+","+c+","+i+")' href='javascript:void(0)'>"+type[i].Name+" <span>( "+type[i].Code+" )</span></a><i class='pull-right' onclick='deleteItem(\"type\","+type[i].Id+")'><span class='fa fa-cut'></span></i></h5>";
                }
                $('#ajax_data').html(html);
            }else{
                $('#ajax_data').html("<p class='text-center'>Nothing Found...</p>");
            }

            createinput("type",cat[c].Id);
        }
        function fifth(a,b,c,d){
            A=a;B=b;C=c;D=d;
            $('#backasset').html("<a onclick='fourth("+a+","+b+","+c+")' href='javascript:void(0)'>< Back</a>");

            var html = "";
            var head = data[a].Head;
            var cat = head[b].Categ;
            var type = cat[c].Type;
            var party = type[d].Party;
            $('#ajax_data_head').html(data[a].Name + " > " + head[b].Name + " > " + cat[c].Name + " > " + type[d].Name +" > ");

            if(party.length !== 0){
                for(var i=0;i< party.length;i++){
                    html += "<h5><a href='javascript:void(0)'>"+party[i].Name+" <span>( "+party[i].Code+" )</span></a><i class='pull-right' onclick='deleteItem(\"party\","+party[i].Id+")'><span class='fa fa-cut'></span></i></h5>";
                }
                $('#ajax_data').html(html);
            }else{
                $('#ajax_data').html("<p class='text-center'>Nothing Found...</p>");
            }


            createinput("party",type[d].Id);
        }
        function createinput(l,i){
            var id = 0;
            var html =  '<input type="text" onkeypress="check(event)" id="input_value" class="form-control" placeholder="Enter Name"><div class="input-group-append"> <button id="input_button" onclick="addname(\''+l+'\','+i+')" class="btn btn-outline-secondary" type="button">Add</button></div>';
            $('#input_name').html(html);
        }
        function addname(l,i){
            var name = $('#input_value').val();
            var url ='/addnew?level='+l+'&Id='+i+'&name='+name+'&firm='+$('#select_firm').val();
            console.log(url);
            $.ajax({
                url: url,
                type: 'get',
                success: function(result){
                    if(result == "true"){
                        againsulf($('#select_firm').val(),l);
                    }
                }
            })
        }
        function againsulf(firm,level){
            $.ajax({
                url: '/getjsonofassets?firm='+firm,
                type: 'get',
                success: function(result){
                    result = JSON.parse(result);
                    data = result;
                    if(level == 'mhead'){
                        start()
                    }
                    else if(level == 'head'){
                        second(A);
                    }else if(level == 'cat'){
                        third(A,B);
                    }else if(level == 'type'){
                        fourth(A,B,C);
                    }else if(level == 'party'){
                        fifth(A,B,C,D);
                    }
                }
            });
        }
        function check(e) {
            if(e.which === 13){
                $('#input_value').attr("disabled", "disabled");
                $('#input_button').click();
                $('#input_button').attr("disabled", "disabled");

                // $(this).removeAttr("disabled");
            }
        }
        function deleteItem(level,id){
            if(confirm('Warning: All the inner accounts of this item will be deleted. Are you really want to delete ?')){
                var firm = $('#select_firm').val();
                $.ajax({
                    url: '/deleteasset?level='+level+'&id='+id+"&firm="+firm,
                    type: 'get',
                    success: function(result){
                        alert("Successfully deleted");
                        againsulf($('#select_firm').val(),level);

                    }
                })
            }

        }

    </script>
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
                                <h4 class="card-title">Current Assets Settings</h4>
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
                                        <div class="offset-md-3 col-md-6" id="data">
                                            <div class="card" style="border: 1px solid gray">
                                                <div class="card-header" style="border-bottom: 1px solid gray">
                                                    <h4 class="card-title">Structure <span id="backasset" class="pull-right"></span></h4>
                                                </div>
                                                <style>

                                                    #ajax_data{

                                                    }
                                                    #ajax_data > h5 > a{
                                                        text-decoration: none;
                                                        color: #252525;
                                                    }
                                                    #ajax_data  > h5::first-letter{
                                                        text-transform: uppercase;
                                                    }
                                                    #ajax_data  > h5{
                                                        animation-name: show;
                                                        animation-duration: 0.5s;
                                                        box-shadow: 2px 2px 5px #888888;
                                                        padding: 12px 10px;
                                                        /*text-transform: capitalize;*/
                                                        text-transform: lowercase;
                                                        cursor: default;
                                                    }
                                                    #ajax_data > h5 > span{
                                                        font-size: 11px;
                                                    }
                                                    #ajax_data > h5 > i{
                                                        font-size: 12px;
                                                        color: #ff672c;
                                                        padding: 5px;
                                                        border-radius: 100%;
                                                        border: 1px solid rgba(0, 0, 0, 0.16);
                                                        cursor: pointer;
                                                    }
                                                    #ajax_data > h5 > i:hover{
                                                        color: white;
                                                        background-color: #ff672c;
                                                        transition: .5s;

                                                    }
                                                </style>
                                                <div class="card-content">
                                                    <div class="card-body" style="padding: 12px;">
                                                        <div id="ajax_data_head"  style="font-size: 10px;margin-bottom: 10px;"></div>
                                                        <div id="ajax_data">
                                                            <p class="text-center">Select firm first from the top.</p>
                                                        </div>
                                                        <div class="input-group mb-3" id="input_name">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<div class="row">
                                        <div class="col-md-4 offset-md-4">
                                            <div class="col-md-12" style="background-color: gray">
                                                <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal">
                                                    @php ($a = 1)
                                                    @foreach($head as $item)
                                                        <a class="nav-link" id="v-pills-{{$a}}a-tab" data-toggle="pill" href="#v-pills-{{$a}}a" role="tab" aria-controls="v-pills-{{$a}}a" aria-selected="false" style="color: #fff;">{{ $item->MHead }}</a>
                                                        @php($a++)
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="tab-content" id="v-pills-tabContent">
                                                    --}}{{--Level 1--}}{{--
                                                    @php ($a = 1)
                                                    @foreach($head as $item)
                                                        <div class="tab-pane fade" id="v-pills-{{$a}}a" role="tabpanel" aria-labelledby="v-pills-{{$a}}a-tab">
                                                            <div class="col-md-12" >
                                                                <h4 style="margin-top: 10px">{{$item->MHead}}</h4>
                                                                <div style="background-color: lightgrey">
                                                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal" >
                                                                        @php ($b = 1)
                                                                        @foreach($item->heads as $inner)
                                                                            <a class="nav-link" id="v-pills-{{$a}}{{$b}}b-tab" data-toggle="pill" href="#v-pills-{{$a}}{{$b}}b" role="tab" aria-controls="v-pills-{{$a}}{{$b}}b" aria-selected="false">{{ $inner->Head  }},</a>
                                                                            @php($b++)
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="tab-content" id="v-pills-tabContent">
                                                                    --}}{{--Level 2--}}{{--
                                                                    @php ($b = 1)
                                                                    @foreach($item->heads as $inner)
                                                                        <div class="tab-pane fade" id="v-pills-{{$a}}{{$b}}b" role="tabpanel" aria-labelledby="v-pills-{{$a}}{{$b}}b-tab">
                                                                            <div class="col-md-12" >
                                                                                <h4 style="margin-top: 10px">{{$inner->Head}}</h4>
                                                                                <div style="background-color: lightgrey">
                                                                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal" >
                                                                                        @php ($c = 1)
                                                                                        @foreach($inner->partycategs as $inner1)
                                                                                            <a class="nav-link" id="v-pills-{{$a}}{{$b}}{{$c}}c-tab" data-toggle="pill" href="#v-pills-{{$a}}{{$b}}{{$c}}c" role="tab" aria-controls="v-pills-{{$a}}{{$b}}{{$c}}c" aria-selected="false">{{ $inner1->PartyCateg  }},</a>
                                                                                            @php($c++)
                                                                                        @endforeach
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="col-md-12">
                                                                                <div class="tab-content" id="v-pills-tabContent">
                                                                                    --}}{{--Level 3--}}{{--
                                                                                    @php ($c = 1)
                                                                                    @foreach($inner->partycategs as $inner1)
                                                                                        <div class="tab-pane fade" id="v-pills-{{$a}}{{$b}}{{$c}}c" role="tabpanel" aria-labelledby="v-pills-{{$a}}{{$b}}{{$c}}c-tab">
                                                                                            <div class="col-md-12" >
                                                                                                <h4 style="margin-top: 10px">{{$inner1->PartyCateg}}</h4>
                                                                                                <div style="background-color: lightgrey">
                                                                                                    <div class="nav nav-pills" id="v-pills-tab" role="tablist" aria-orientation="horizontal" >
                                                                                                        @php ($d = 1)
                                                                                                        @foreach($inner1->partytypes as $inner2)
                                                                                                            <a class="nav-link" id="v-pills-{{$a}}{{$b}}{{$c}}{{$d}}d-tab" data-toggle="pill" href="#v-pills-{{$a}}{{$b}}{{$c}}{{$d}}d" role="tab" aria-controls="v-pills-{{$a}}{{$b}}{{$c}}{{$d}}d" aria-selected="false">{{ $inner2->PartyType  }},</a>
                                                                                                            @php($d++)
                                                                                                        @endforeach
                                                                                                    </div>
                                                                                                </div>

                                                                                            </div>
                                                                                            <div class="col-md-12">
                                                                                                <div class="tab-content" id="v-pills-tabContent">
                                                                                                    --}}{{--Level 4--}}{{--
                                                                                                    @php ($d = 1)
                                                                                                    @foreach($inner1->partytypes as $inner2)
                                                                                                        <div class="tab-pane fade" id="v-pills-{{$a}}{{$b}}{{$c}}{{$d}}d" role="tabpanel" aria-labelledby="v-pills-{{$a}}{{$b}}{{$c}}{{$d}}d-tab">
                                                                                                            <ul>
                                                                                                                @foreach($inner2->parties as $inner3)
                                                                                                                    <li>5- {{ $inner3->PartyName }}</li>
                                                                                                                @endforeach
                                                                                                            </ul>
                                                                                                        </div>
                                                                                                        @php($d++)
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        @php($c++)
                                                                                    @endforeach
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @php($b++)
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php($a++)
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="row">
                                        <table class="table table-striped table-bordered dataex-key-basic">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                            </tr>
                                            <tr>
                                                <td>Garrett Winters</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>63</td>
                                                <td>2011/07/25</td>
                                                <td>$170,750</td>
                                            </tr>
                                            <tr>
                                                <td>Ashton Cox</td>
                                                <td>Junior Technical Author</td>
                                                <td>San Francisco</td>
                                                <td>66</td>
                                                <td>2009/01/12</td>
                                                <td>$86,000</td>
                                            </tr>
                                            <tr>
                                                <td>Cedric Kelly</td>
                                                <td>Senior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2012/03/29</td>
                                                <td>$433,060</td>
                                            </tr>
                                            <tr>
                                                <td>Airi Satou</td>
                                                <td>Accountant</td>
                                                <td>Tokyo</td>
                                                <td>33</td>
                                                <td>2008/11/28</td>
                                                <td>$162,700</td>
                                            </tr>
                                            <tr>
                                                <td>Brielle Williamson</td>
                                                <td>Integration Specialist</td>
                                                <td>New York</td>
                                                <td>61</td>
                                                <td>2012/12/02</td>
                                                <td>$372,000</td>
                                            </tr>
                                            <tr>
                                                <td>Herrod Chandler</td>
                                                <td>Sales Assistant</td>
                                                <td>San Francisco</td>
                                                <td>59</td>
                                                <td>2012/08/06</td>
                                                <td>$137,500</td>
                                            </tr>
                                            <tr>
                                                <td>Rhona Davidson</td>
                                                <td>Integration Specialist</td>
                                                <td>Tokyo</td>
                                                <td>55</td>
                                                <td>2010/10/14</td>
                                                <td>$327,900</td>
                                            </tr>
                                            <tr>
                                                <td>Colleen Hurst</td>
                                                <td>Javascript Developer</td>
                                                <td>San Francisco</td>
                                                <td>39</td>
                                                <td>2009/09/15</td>
                                                <td>$205,500</td>
                                            </tr>
                                            <tr>
                                                <td>Sonya Frost</td>
                                                <td>Software Engineer</td>
                                                <td>Edinburgh</td>
                                                <td>23</td>
                                                <td>2008/12/13</td>
                                                <td>$103,600</td>
                                            </tr>
                                            <tr>
                                                <td>Jena Gaines</td>
                                                <td>Office Manager</td>
                                                <td>London</td>
                                                <td>30</td>
                                                <td>2008/12/19</td>
                                                <td>$90,560</td>
                                            </tr>
                                            <tr>
                                                <td>Quinn Flynn</td>
                                                <td>Support Lead</td>
                                                <td>Edinburgh</td>
                                                <td>22</td>
                                                <td>2013/03/03</td>
                                                <td>$342,000</td>
                                            </tr>
                                            <tr>
                                                <td>Charde Marshall</td>
                                                <td>Regional Director</td>
                                                <td>San Francisco</td>
                                                <td>36</td>
                                                <td>2008/10/16</td>
                                                <td>$470,600</td>
                                            </tr>
                                            <tr>
                                                <td>Haley Kennedy</td>
                                                <td>Senior Marketing Designer</td>
                                                <td>London</td>
                                                <td>43</td>
                                                <td>2012/12/18</td>
                                                <td>$313,500</td>
                                            </tr>
                                            <tr>
                                                <td>Tatyana Fitzpatrick</td>
                                                <td>Regional Director</td>
                                                <td>London</td>
                                                <td>19</td>
                                                <td>2010/03/17</td>
                                                <td>$385,750</td>
                                            </tr>
                                            <tr>
                                                <td>Michael Silva</td>
                                                <td>Marketing Designer</td>
                                                <td>London</td>
                                                <td>66</td>
                                                <td>2012/11/27</td>
                                                <td>$198,500</td>
                                            </tr>
                                            <tr>
                                                <td>Paul Byrd</td>
                                                <td>Chief Financial Officer (CFO)</td>
                                                <td>New York</td>
                                                <td>64</td>
                                                <td>2010/06/09</td>
                                                <td>$725,000</td>
                                            </tr>
                                            <tr>
                                                <td>Gloria Little</td>
                                                <td>Systems Administrator</td>
                                                <td>New York</td>
                                                <td>59</td>
                                                <td>2009/04/10</td>
                                                <td>$237,500</td>
                                            </tr>
                                            <tr>
                                                <td>Bradley Greer</td>
                                                <td>Software Engineer</td>
                                                <td>London</td>
                                                <td>41</td>
                                                <td>2012/10/13</td>
                                                <td>$132,000</td>
                                            </tr>
                                            <tr>
                                                <td>Dai Rios</td>
                                                <td>Personnel Lead</td>
                                                <td>Edinburgh</td>
                                                <td>35</td>
                                                <td>2012/09/26</td>
                                                <td>$217,500</td>
                                            </tr>
                                            <tr>
                                                <td>Jenette Caldwell</td>
                                                <td>Development Lead</td>
                                                <td>New York</td>
                                                <td>30</td>
                                                <td>2011/09/03</td>
                                                <td>$345,000</td>
                                            </tr>
                                            <tr>
                                                <td>Yuri Berry</td>
                                                <td>Chief Marketing Officer (CMO)</td>
                                                <td>New York</td>
                                                <td>40</td>
                                                <td>2009/06/25</td>
                                                <td>$675,000</td>
                                            </tr>
                                            <tr>
                                                <td>Caesar Vance</td>
                                                <td>Pre-Sales Support</td>
                                                <td>New York</td>
                                                <td>21</td>
                                                <td>2011/12/12</td>
                                                <td>$106,450</td>
                                            </tr>
                                            <tr>
                                                <td>Doris Wilder</td>
                                                <td>Sales Assistant</td>
                                                <td>Sidney</td>
                                                <td>23</td>
                                                <td>2010/09/20</td>
                                                <td>$85,600</td>
                                            </tr>
                                            <tr>
                                                <td>Angelica Ramos</td>
                                                <td>Chief Executive Officer (CEO)</td>
                                                <td>London</td>
                                                <td>47</td>
                                                <td>2009/10/09</td>
                                                <td>$1,200,000</td>
                                            </tr>
                                            <tr>
                                                <td>Gavin Joyce</td>
                                                <td>Developer</td>
                                                <td>Edinburgh</td>
                                                <td>42</td>
                                                <td>2010/12/22</td>
                                                <td>$92,575</td>
                                            </tr>
                                            <tr>
                                                <td>Jennifer Chang</td>
                                                <td>Regional Director</td>
                                                <td>Singapore</td>
                                                <td>28</td>
                                                <td>2010/11/14</td>
                                                <td>$357,650</td>
                                            </tr>
                                            <tr>
                                                <td>Brenden Wagner</td>
                                                <td>Software Engineer</td>
                                                <td>San Francisco</td>
                                                <td>28</td>
                                                <td>2011/06/07</td>
                                                <td>$206,850</td>
                                            </tr>
                                            <tr>
                                                <td>Fiona Green</td>
                                                <td>Chief Operating Officer (COO)</td>
                                                <td>San Francisco</td>
                                                <td>48</td>
                                                <td>2010/03/11</td>
                                                <td>$850,000</td>
                                            </tr>
                                            <tr>
                                                <td>Shou Itou</td>
                                                <td>Regional Marketing</td>
                                                <td>Tokyo</td>
                                                <td>20</td>
                                                <td>2011/08/14</td>
                                                <td>$163,000</td>
                                            </tr>
                                            <tr>
                                                <td>Michelle House</td>
                                                <td>Integration Specialist</td>
                                                <td>Sidney</td>
                                                <td>37</td>
                                                <td>2011/06/02</td>
                                                <td>$95,400</td>
                                            </tr>
                                            <tr>
                                                <td>Suki Burks</td>
                                                <td>Developer</td>
                                                <td>London</td>
                                                <td>53</td>
                                                <td>2009/10/22</td>
                                                <td>$114,500</td>
                                            </tr>
                                            <tr>
                                                <td>Prescott Bartlett</td>
                                                <td>Technical Author</td>
                                                <td>London</td>
                                                <td>27</td>
                                                <td>2011/05/07</td>
                                                <td>$145,000</td>
                                            </tr>
                                            <tr>
                                                <td>Gavin Cortez</td>
                                                <td>Team Leader</td>
                                                <td>San Francisco</td>
                                                <td>22</td>
                                                <td>2008/10/26</td>
                                                <td>$235,500</td>
                                            </tr>
                                            <tr>
                                                <td>Martena Mccray</td>
                                                <td>Post-Sales support</td>
                                                <td>Edinburgh</td>
                                                <td>46</td>
                                                <td>2011/03/09</td>
                                                <td>$324,050</td>
                                            </tr>
                                            <tr>
                                                <td>Unity Butler</td>
                                                <td>Marketing Designer</td>
                                                <td>San Francisco</td>
                                                <td>47</td>
                                                <td>2009/12/09</td>
                                                <td>$85,675</td>
                                            </tr>
                                            <tr>
                                                <td>Howard Hatfield</td>
                                                <td>Office Manager</td>
                                                <td>San Francisco</td>
                                                <td>51</td>
                                                <td>2008/12/16</td>
                                                <td>$164,500</td>
                                            </tr>
                                            <tr>
                                                <td>Hope Fuentes</td>
                                                <td>Secretary</td>
                                                <td>San Francisco</td>
                                                <td>41</td>
                                                <td>2010/02/12</td>
                                                <td>$109,850</td>
                                            </tr>
                                            <tr>
                                                <td>Vivian Harrell</td>
                                                <td>Financial Controller</td>
                                                <td>San Francisco</td>
                                                <td>62</td>
                                                <td>2009/02/14</td>
                                                <td>$452,500</td>
                                            </tr>
                                            <tr>
                                                <td>Timothy Mooney</td>
                                                <td>Office Manager</td>
                                                <td>London</td>
                                                <td>37</td>
                                                <td>2008/12/11</td>
                                                <td>$136,200</td>
                                            </tr>
                                            <tr>
                                                <td>Jackson Bradshaw</td>
                                                <td>Director</td>
                                                <td>New York</td>
                                                <td>65</td>
                                                <td>2008/09/26</td>
                                                <td>$645,750</td>
                                            </tr>
                                            <tr>
                                                <td>Olivia Liang</td>
                                                <td>Support Engineer</td>
                                                <td>Singapore</td>
                                                <td>64</td>
                                                <td>2011/02/03</td>
                                                <td>$234,500</td>
                                            </tr>
                                            <tr>
                                                <td>Bruno Nash</td>
                                                <td>Software Engineer</td>
                                                <td>London</td>
                                                <td>38</td>
                                                <td>2011/05/03</td>
                                                <td>$163,500</td>
                                            </tr>
                                            <tr>
                                                <td>Sakura Yamamoto</td>
                                                <td>Support Engineer</td>
                                                <td>Tokyo</td>
                                                <td>37</td>
                                                <td>2009/08/19</td>
                                                <td>$139,575</td>
                                            </tr>
                                            <tr>
                                                <td>Thor Walton</td>
                                                <td>Developer</td>
                                                <td>New York</td>
                                                <td>61</td>
                                                <td>2013/08/11</td>
                                                <td>$98,540</td>
                                            </tr>
                                            <tr>
                                                <td>Finn Camacho</td>
                                                <td>Support Engineer</td>
                                                <td>San Francisco</td>
                                                <td>47</td>
                                                <td>2009/07/07</td>
                                                <td>$87,500</td>
                                            </tr>
                                            <tr>
                                                <td>Serge Baldwin</td>
                                                <td>Data Coordinator</td>
                                                <td>Singapore</td>
                                                <td>64</td>
                                                <td>2012/04/09</td>
                                                <td>$138,575</td>
                                            </tr>
                                            <tr>
                                                <td>Zenaida Frank</td>
                                                <td>Software Engineer</td>
                                                <td>New York</td>
                                                <td>63</td>
                                                <td>2010/01/04</td>
                                                <td>$125,250</td>
                                            </tr>
                                            <tr>
                                                <td>Zorita Serrano</td>
                                                <td>Software Engineer</td>
                                                <td>San Francisco</td>
                                                <td>56</td>
                                                <td>2012/06/01</td>
                                                <td>$115,000</td>
                                            </tr>
                                            <tr>
                                                <td>Jennifer Acosta</td>
                                                <td>Junior Javascript Developer</td>
                                                <td>Edinburgh</td>
                                                <td>43</td>
                                                <td>2013/02/01</td>
                                                <td>$75,650</td>
                                            </tr>
                                            <tr>
                                                <td>Cara Stevens</td>
                                                <td>Sales Assistant</td>
                                                <td>New York</td>
                                                <td>46</td>
                                                <td>2011/12/06</td>
                                                <td>$145,600</td>
                                            </tr>
                                            <tr>
                                                <td>Hermione Butler</td>
                                                <td>Regional Director</td>
                                                <td>London</td>
                                                <td>47</td>
                                                <td>2011/03/21</td>
                                                <td>$356,250</td>
                                            </tr>
                                            <tr>
                                                <td>Lael Greer</td>
                                                <td>Systems Administrator</td>
                                                <td>London</td>
                                                <td>21</td>
                                                <td>2009/02/27</td>
                                                <td>$103,500</td>
                                            </tr>
                                            <tr>
                                                <td>Jonas Alexander</td>
                                                <td>Developer</td>
                                                <td>San Francisco</td>
                                                <td>30</td>
                                                <td>2010/07/14</td>
                                                <td>$86,500</td>
                                            </tr>
                                            <tr>
                                                <td>Shad Decker</td>
                                                <td>Regional Director</td>
                                                <td>Edinburgh</td>
                                                <td>51</td>
                                                <td>2008/11/13</td>
                                                <td>$183,000</td>
                                            </tr>
                                            <tr>
                                                <td>Michael Bruce</td>
                                                <td>Javascript Developer</td>
                                                <td>Singapore</td>
                                                <td>29</td>
                                                <td>2011/06/27</td>
                                                <td>$183,000</td>
                                            </tr>
                                            <tr>
                                                <td>Donna Snider</td>
                                                <td>Customer Support</td>
                                                <td>New York</td>
                                                <td>27</td>
                                                <td>2011/01/25</td>
                                                <td>$112,000</td>
                                            </tr>
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Office</th>
                                                <th>Age</th>
                                                <th>Start date</th>
                                                <th>Salary</th>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div>

                                        




                                    <ul>
                                        @foreach($head as $item)
                                        <li>
                                            1- {{ $item->MHead  }}
                                            <ul>
                                                @foreach($item->heads as $inner)
                                                    <li>2- {{ $inner->Head }}
                                                        <ul>
                                                            @foreach($inner->partycategs as $inner1)
                                                                            <li>3- {{ $inner1->PartyCateg }}
                                                                                <ul>
                                                                                    @foreach($inner1->partytypes as $inner2)
                                                                                        <li>4- {{ $inner2->PartyType }}
                                                                                            <ul>
                                                                                                @foreach($inner2->parties as $inner3)
                                                                                                    <li>5- {{ $inner3->PartyName }}</li>
                                                                                                @endforeach
                                                                                            </ul>
                                                                                        </li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </li>
                                                                        @endforeach

                                                        </ul>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                    </ul>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
