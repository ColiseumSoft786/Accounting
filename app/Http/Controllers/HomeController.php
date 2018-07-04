<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\Category;
use App\Firm;
use App\Head;
use App\Mhead;
use App\Type;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.home');
    }
    public function assets(){
        $user = User::find(Auth::id());
        $firm = $user->firms;
        return view('home.assets',['firm' => $firm]);
    }
    public function getJson(Request $req){
        $firm = Firm::find($req->input('firm'));
        if($firm != null){
            $head = $firm->Mheads;
            $mhead = array();
            foreach ($head as $item){
             $ahead = array();
             foreach($item->heads as $head){
                 $apartcateg = array();
                 foreach ($head->categories as $partycateg){
                     $apartytype = array();
                     foreach($partycateg->types as  $partytype){
                         $aparty = array();
                         foreach($partytype->accounts as $party){
                             array_push($aparty,['Id' => $party->id,"Name" =>$party->name,"Code" => $party->level]);
                         }
                         array_push($apartytype,['Id' => $partytype->id,"Name" =>$partytype->name,'Party'=>$aparty,"Code" => $partytype->level]);
                     }
                     array_push($apartcateg,['Id' => $partycateg->id,"Name" =>$partycateg->name,'Type'=>$apartytype,"Code" => $partycateg->level]);
                 }
                 array_push($ahead,['Id' => $head->id,"Name" =>$head->name,'Categ'=>$apartcateg,"Code" => $head->level]);
             }
             array_push($mhead,['Id' => $item->id,"Name" =>$item->name,'Head'=>$ahead,"Code" => $item->level]);
         }
         $json = json_encode($mhead);
            return $json;
        }
        return "[]";

    }
    public function addNewValue(Request $request){
        $level = $request->input('level');
        $id = $request->input('Id');
        $name = $request->input('name');
        $firm = $request->input('firm');
        if($level == "mhead"){
            $firms = Firm::find($firm);
            $mheads = $firms->Mheads;
            $mhead = new Mhead();
            $mhead->name = $name;
            if($mheads != null){
                $mhead->level = $mheads->count() + 1;
            }else {
                $mhead->level = "1";
            }
            $mhead->firm_id = $firm;
            $mhead->save();
        }else if($level == "head"){
            $mhead = Mhead::find($id);
            $head = $mhead->heads;
            $nhead = new Head();
            $nhead->name = $name;
            if($head != null){
                $nhead->level = $mhead->level ."-". ($head->count() + 1);
            }else {
                $nhead->level = $mhead->level ."-1";
            }
            $nhead->mhead_id = $id;
            $nhead->save();
        }
        else if($level == "cat"){
            $head = Head::find($id);
            $cats = $head->categories;
            $cat = new Category();
            $cat->name = $name;
            if($cats != null){
                $cat->level = $head->level ."-". ($cats->count() + 1);
            }else {
                $cat->level =  $head->level ."-1";
            }
            $cat->head_id = $id;
            $cat->save();
        }else if($level == "type"){
            $cat = Category::find($id);
            $types = $cat->types;
            $type = new Type();
            $type->name = $name;
            if($types != null){
                $type->level = $cat->level ."-". ($types->count() + 1);
            }else {
                $type->level =  $cat->level ."-1";
            }
            $type->category_id = $id;
            $type->save();
        }else if($level == "party"){
            $type = Type::find($id);
            $accounts = $type->accounts;
            $account = new Accounts();
            $account->name = $name;
            if($accounts != null){
                $account->level = $type->level ."-". ($accounts->count() + 1);
            }else {
                $account->level =  $type->level ."-1";
            }
            $account->type_id = $id;
            $account->amount = 0;
            $account->save();
        }
        return "true";
    }
    public function deleteasset(Request $request){
        $level = $request->input('level');
        $id = $request->input('id');
        $firm = $request->input('firm');
        if($level == 'mhead'){
            $row = Mhead::find($id);
            $row->heads()->delete();
            $row->delete();
        } else if($level == 'head'){
            $row = Head::find($id);
            $row->delete();
        }else if($level == 'cat'){
            $row = Category::find($id);
            $row->delete();
        }else if($level == 'type'){
            $row = Type::find($id);
            $row->delete();
        }else if($level == 'party'){
            $row = Accounts::find($id);
            $row->delete();
        }
        $this->updatelevel($firm);
        return "true";
    }
    public function updatelevel($firm){
        $firms = Firm::find($firm);
        //print_r($firms->name);
            $mheads = $firms->Mheads;
            $mc = 1;
            foreach($mheads as $mhead){
                $mhead->level = $mc;
                $mhead->save();
                $heads = $mhead->Heads;
                $hc = 1;
                foreach($heads as $head){
                    $head->level = $mc."-".$hc;
                    $head->save();
                    $cats = $head->Categories;
                    $cc = 1;
                    foreach($cats as $cat){
                        $cat->level = $mc."-".$hc."-".$cc;
                        $cat->save();
                        $types = $cat->Types;
                        $tc = 1;
                        foreach ($types as $type){
                            $type->level = $mc."-".$hc."-".$cc."-".$tc;
                            $type->save();
                            $accounts = $type->Accounts;
                            $ac = 1;
                            foreach($accounts as $account){
                                $account->level = $mc."-".$hc."-".$cc."-".$tc."-".$ac;
                                $account->save();
                                $ac++;
                            }
                            $tc++;
                        }
                        $cc++;
                    }
                    $hc++;
                }
                $mc++;
            }
    }

    public function selectfirm(){
        return view('partials.firm');
    }
}
