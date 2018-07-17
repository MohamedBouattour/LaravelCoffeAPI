<?php

namespace App\Http\Controllers\api;


use Illuminate\Http\Request;
use App\Http\Controllers\api\BaseController as BaseController;
use App\Categorys;
use Validator;


class CategoryService extends BaseController{
    public function index() {
        $categoryss = Categorys::all();
        return $this->sendResponse($categoryss->toArray(),'allCatgeorys');
    }

    public function store(Request $request) {
        $input = $request->all();
        $validator = Validator::make($input,
        [
            'categoryname'=> 'required|unique:categorys|string'
        ]);
        
        if ($validator->fails()) {
            return $this->sendError('erreur de validation',$validator->errors());
        }

        $categorys = Categorys::create($input);
        return $this->sendResponse($categorys->toArray(),'created');
    }

    public function show($id) {
        $categorys = Categorys::find($id);
        if (is_null($categorys)) {
            return $this->sendError('not found',$id);
        }
        return $this->sendResponse($categorys->toArray(),'finded');
    }

    public function change (Request $request, Categorys $categorys) {
        $input = $request->all();
        $validator = Validator::make($input,
        [
            'categoryname'=> 'required|unique:categorys|string'
        ]);
        
        if ($validator->fails()) {
            return $this->sendError('erreur de validation',$validator->errors());
        }

        $categorys->Categorysname =$input['categorysname'];
        $categorys->save();
        return $this->sendResponse($categorys->toArray(),'changed');
    }

    public function destroy ( Categorys $categorys) {
        $categorys->delete();
        return $this->sendResponse($categorys->toArray(),'destroyed');
    }

}