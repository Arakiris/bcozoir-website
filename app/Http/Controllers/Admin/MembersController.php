<?php

namespace App\Http\Controllers\Admin;

use App\Http\Traits\CommonTrait;
// use App\Http\Requests\StoreMemberRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Http\Controllers\Controller;
use App\Member;
use App\Club;
use App\Category;
use App\Picture;
use Image;

use Carbon\Carbon;


class MembersController extends Controller
{
    use CommonTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::with(['club', 'category'])->get();
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clubs = Club::all();
        $categories = Category::all();

        return view('admin.members.create', compact('clubs', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Club::findOrFail($request->club_id);
        Category::findOrFail($request->category_id);

        $validatedMember = request()->validate([
            'club_id' => 'bail|required',
            'category_id' => 'bail|required',
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
            'sex' => 'bail|required|min:1|max:1',
            'birth_date' => 'bail|nullable|date',
            'is_licensee' => 'bail|required|integer',
            'id_licensee' => 'bail|nullable',
            'bonus' => 'nullable|numeric',
            'listing_url' => 'nullable|string'
        ]);

        if(!isset($validatedMember['bonus'])){
            $validatedMember['bonus'] = 0;
        }

        $member = Member::create($validatedMember);

        request()->validate([
            'image' => 'nullable|image'
        ]);

        if($file = $request->file('image')){
            $storage = storage_path('app/public');
            $folderPath = '/upload/images/members/' . $member->id . '/';

            $this->savePictures($file, $folderPath, $storage, $member);
        }
        $this->updateStatisticDate();
        
        session()->flash('notification_management_admin', 'Le nouveau membre a bien été enregistré');

        return redirect("/administration/membres");
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
    public function edit($id)
    {
        $clubs = Club::all();
        $categories = Category::all();
        $member = Member::with('category')->findOrFail($id);
        return view('admin.members.edit', compact('clubs', 'categories', 'member'));
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
        Club::findOrFail($request->club_id);
        Category::findOrFail($request->category_id);

        $validatedMember = request()->validate([
            'club_id' => 'bail|required',
            'category_id' => 'bail|required',
            'first_name' => 'bail|required',
            'last_name' => 'bail|required',
            'sex' => 'bail|required|min:1|max:1',
            'birth_date' => 'bail|nullable|date',
            'is_licensee' => 'bail|required|integer',
            'id_licensee' => 'bail|nullable',
            'bonus' => 'nullable|numeric',
            'listing_url' => 'nullable|string'
        ]);

        if(!isset($validatedMember['bonus'])){
            $validatedMember['bonus'] = 0;
        }

        $member = Member::findOrFail($id);

        if($validatedMember['is_licensee'] == 0){
            $validatedMember['id_licensee'] = null;
        }

        $member->update($validatedMember);

        request()->validate([
            'image' => 'nullable|image'
        ]);

        if($file = $request->file('image')){
            $previousPicture = $member->picture->first();
            if(!is_null($previousPicture)){
                unlink(storage_path('app/public' . $previousPicture->path));
                if(!is_null($previousPicture->thumbnail))
                    unlink(storage_path('app/public' . $previousPicture->thumbnail));
                if(!is_null($previousPicture->medium_size))
                    unlink(storage_path('app/public' . $previousPicture->medium_size));
                $previousPicture->delete();
            }

            $storage = storage_path('app/public');
            $folderPath = '/upload/images/members/' . $member->id . '/';

            $this->savePictures($file, $folderPath, $storage, $member);
        }
        $this->updateStatisticDate();

        session()->flash('notification_management_admin', 'Le membre a bien été édité');

        return redirect('/administration/membres');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $previousPicture = $member->picture->first();
        if(!is_null($previousPicture)){
            unlink(storage_path('app/public' . $previousPicture->path));
            unlink(storage_path('app/public' . $previousPicture->thumbnail));
            unlink(storage_path('app/public' . $previousPicture->medium_size));
            $previousPicture->delete();
        }

        if(!is_null($member->historical_path)){
            unlink(storage_path('app/public' . $member->historical_path));
        }

        $member->delete();
        $this->updateStatisticDate();
        
        session()->flash('notification_management_admin', 'Le membre a bien été supprimé');
        return redirect('/administration/membres');
    }

    /**
     * Save a picture and return it
     * 
     * @param string $file
     * @param string $folderPath
     * @param string $storage
     * @param Member $item
     */
    private function savePictures($file, $folderPath, $storage, $item){
        $save_path = $storage . $folderPath;
        if (!file_exists($save_path)) {
            mkdir($save_path, 0755, true);
        }

        $timestamp = Carbon::now()->timestamp . str_random(5);
        $filename = $folderPath . $timestamp . '.' . $file->extension();
        $filename_medium = $folderPath . $timestamp . '-medium.' . $file->extension();
        $filename_thumb = $folderPath . $timestamp . '-thumbnail.' . $file->extension();

        $width_medium = 400;
        $height_medium = 400;
        $width_thumb = 200;
        $height_thumb = 200;

        $img = Image::make($file);
        $img->backup();

        $img->save($storage . $filename, 80);
        $img->reset();

        if ($img->height() > $img->width()) {
            $width_medium = null;
            $width_thumb = null;
        }
        else {
            $height_medium = null;
            $height_thumb = null;
        }

        $img->resize($width_medium, $height_medium, function ($constraint) { $constraint->aspectRatio();})
                            ->save($storage . $filename_medium, 80);
        $img->reset();
        
        $img->resize($width_thumb, $height_thumb, function ($constraint) { $constraint->aspectRatio();})
                            ->save($storage . $filename_thumb, 80);
        
                            
        $picture = new Picture();
        $picture->path = $filename;
        $picture->medium_size = $filename_medium;
        $picture->thumbnail = $filename_thumb;

        $item->picture()->save($picture);
    }
}
