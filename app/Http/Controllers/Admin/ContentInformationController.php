<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ContentInformation;

class ContentInformationController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $contentInformation = ContentInformation::all();

        return view('admin.contentInformation.edit', compact('contentInformation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedInformation = request()->validate([
            'presentation' => 'string|nullable',
            'adresses' => 'string|nullable',
            'version' => 'string|nullable',
            'mentions_legales' => 'string|nullable',
            'appel_partenaires' => 'string|nullable',
            'logo'=> 'nullable|image',
            'banner'=> 'nullable|image',
            'office'=> 'nullable|image'
        ]);

        ContentInformation::UpdateOrCreate(["id" => 1, "name" => "presentation"], ['description' => $validatedInformation['presentation']]);
        ContentInformation::UpdateOrCreate(["id" => 2, "name" => "adresses"], ['description' => $validatedInformation['adresses']]);
        ContentInformation::UpdateOrCreate(["id" => 3, "name" => "version"], ['description' => $validatedInformation['version']]);
        ContentInformation::UpdateOrCreate(["id" => 4, "name" => "mentions légales"], ['description' => $validatedInformation['mentions_legales']]);
        ContentInformation::UpdateOrCreate(["id" => 5, "name" => "appel partenaires"], ['description' => $validatedInformation['appel_partenaires']]);

        if($file = $request->file('logo'))
            $this->saveImage($file, 6, "logo image");
        if($file = $request->file('banner'))
            $this->saveImage($file, 7, "banniere image");
        if($file = $request->file('office'))
            $this->saveImage($file, 8, "bureau image");

        return redirect()->route('admin.contentinformation.edit');
    }

    private function saveImage($file, $id, $name){
        $item = ContentInformation::find($id);

        if(isset($item) && isset($item->path)){
            unlink(storage_path('app/public' . $item->path));
        }

        $path = $file->store('public/upload/images/content_information');
        $filepath = substr($path, 6);
        ContentInformation::UpdateOrCreate(["id" => $id, "name" => $name], ['path' => $filepath]);
    }

}
