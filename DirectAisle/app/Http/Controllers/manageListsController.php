<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShoppingList;
use App\ListItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use DB;
use View;

class manageListsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //echo"index";
        $id = Auth::id();
        //echo $id;
        //variable name that store lists and model List *test
       // $lists = ShoppingList::all();
        $lists = ShoppingList::where('user_id', $id)->get();
       // foreach($lists as $list)TEST
        //{
            //echo $list;
        //}


       // print "made it to index";// Need to specify which variable we are passing with with()
        return view('shopping_lists')->with('lists', $lists);
        //return view('home');
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      echo "create list";
        //
        //print "inside create"; exit;
        return view('create_list');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $list = new ShoppingList;

      //  print_r($_REQUEST);
        //print_r($request);
        $list->list_name = $request->list_name;
        $id=Auth::id();
        $list->user_id = $id;
        //echo $request->list_name;

        $list->save();
        $lists = ShoppingList::where('user_id', $id)->get();

        return view('shopping_lists')->with('lists', $lists);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        if (isset($_REQUEST['_method']) && $_REQUEST['_method']== 'delete'){
            $this->destroy($id);

        }
        //print "inside show"; exit;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        print "inside edit"; exit;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      //print_r($_REQUEST);

       $categories = DB::table('product_locations')
         ->select('category')
         ->groupBy('category')
         ->get();

        $list_id = $request->list_id;

        $myitemsids = DB::select("select distinct item_id from list_items where list_id = :id", ['id'=>$list_id]);
        $myitems=array();

        foreach($myitemsids as $id)
        {

          $item = DB::select("select * from product_locations where item_id = :id", ['id'=>$id->item_id]);
          $myitems[]=$item[0];

        }


        $categories = DB::table('product_locations')
          ->select('category')
          ->groupBy('category')
          ->get();
        //$products = ProductLocation::where('category', $category)->get();

        //return View::make('add_items', compact('categories', 'list_id'));
        return View::make('add_items')->with('categories', $categories)->with('list_id',$list_id)->with('items',$myitems);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($list_id)
    {

        // Delete some list by list_id
        $lists = ListItem::where('list_id', $list_id)->get();
        //$lists->delete();

        foreach( $lists as $l)
        {
          $l->delete();
        }

        $list = ShoppingList::find($list_id);
        $list->delete();

      
        return redirect('manageLists');


    }
}
