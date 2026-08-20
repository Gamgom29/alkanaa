<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partner;
use App\Models\Product;
use Illuminate\Support\Str;

class PartnerController extends Controller
{
    public function __construct() {
        // Staff Permission Check
        $this->middleware(['permission:view_all_partners'])->only('index');
        $this->middleware(['permission:add_partner'])->only('create');
        $this->middleware(['permission:edit_partner'])->only('edit');
        $this->middleware(['permission:delete_partner'])->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort_search =null;
        $partners = Partner::orderBy('name', 'asc');
        if ($request->has('search')){
            $sort_search = $request->search;
            $partners = $partners->where('name', 'like', '%'.$sort_search.'%');
        }
        $partners = $partners->paginate(15);
        return view('backend.partners.index', compact('partners', 'sort_search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $partner = new Partner;
        $partner->name = $request->name;
        $partner->meta_title = $request->meta_title;
        $partner->meta_description = $request->meta_description;
        

        $partner->logo = $request->logo;
        $partner->save();

        flash(translate('Partner has been inserted successfully'))->success();
        return redirect()->route('partners.index');

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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $lang   = $request->lang;
        $partner  = Partner::findOrFail($id);
        return view('backend.partners.edit', compact('partner','lang'));
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
        $partner = Partner::findOrFail($id);
        if($request->lang == env("DEFAULT_LANGUAGE")){
            $partner->name = $request->name;
        }
        $partner->meta_title = $request->meta_title;
        $partner->meta_description = $request->meta_description;

        $partner->logo = $request->logo;
        $partner->save();

        flash(translate('Partner has been updated successfully'))->success();
        return back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        
        Partner::destroy($id);

        flash(translate('Partner has been deleted successfully'))->success();
        return redirect()->route('partners.index');

    }
}
