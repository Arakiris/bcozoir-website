<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\ContentInformation;
use App\MediaLink;

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
        $contentInformation = ContentInformation::all()->keyBy('name');
        $socialMedia = MediaLink::all();

        return view('admin.contentInformation.edit', compact('contentInformation', 'socialMedia'));
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
            'presentation' => 'bail|string|nullable',
            'adresses' => 'bail|string|nullable',
            'version' => 'bail|string|nullable',
            'mentions_legales' => 'bail|string|nullable',
            'appel_partenaires' => 'bail|string|nullable',
            'logo'=> 'bail|nullable|image',
            'banner'=> 'bail|nullable|image',
            'office'=> 'bail|nullable|image',
            'tournament_image_1' => 'bail|nullable|image',
            'tournament_image_2' => 'bail|nullable|image',
            'music'=> 'bail|nullable|mimes:mp3,mp4,mpga,wav',
            'volume' => 'bail|required|numeric||between:0,1',
            'fb_image' => 'bail|nullable|image',
            'fb_url' => 'url|nullable',
            'socialMedia.*.image' => 'bail|nullable|image',
            'socialMedia.*.url' => 'bail|nullable|url',
            'socialMedia.*.description' => 'bail|nullable|string',
            'socialMedia.*.display' => 'bail|nullable|string',
            'map_title' => 'bail|string|nullable',
            'map_link' => 'bail|nullable|string',
            'courrier_postal' => 'nullable|string'
        ]);

        ContentInformation::updateOrCreate(["name" => "presentation"], ['description' => $validatedInformation['presentation']]);
        ContentInformation::updateOrCreate(["name" => "adresses"], ['description' => $validatedInformation['adresses']]);
        ContentInformation::updateOrCreate(["name" => "version"], ['description' => $validatedInformation['version']]);
        ContentInformation::updateOrCreate(["name" => "mentions légales"], ['description' => $validatedInformation['mentions_legales']]);
        ContentInformation::updateOrCreate(["name" => "appel partenaires"], ['description' => $validatedInformation['appel_partenaires']]);

        if($file = $request->file('logo'))
            $this->saveContentInfo($file, "logo image");
        if($file = $request->file('banner'))
            $this->saveContentInfo($file, "banniere image");
        if($file = $request->file('office'))
            $this->saveContentInfo($file, "bureau image");


        if($file = $request->file('music'))
            $this->saveContentInfo($file, "musique de fond");
        ContentInformation::updateOrCreate(["name" => "volume musique"], ['description' => $validatedInformation['volume']]);

        if($file = $request->file('fb_image'))
            $this->saveContentInfo($file, "facebook image");
        ContentInformation::updateOrCreate(["name" => "facebook url"], ['description' => $validatedInformation['fb_url']]);

        $test = ContentInformation::updateOrCreate(["name" => "map"], ['description' => $validatedInformation['map_link'], 'path' => $validatedInformation['map_title']]);

        $files = $request->file('socialMedia');
        for ( $i = 1 ; $i <  count($validatedInformation['socialMedia']) + 1 ; $i++) { 
            if(isset($files[$i]) && $files[$i]['image']){
                $file = $files[$i]['image'];
                $this->saveMediaLink($file, $i);
            }

            MediaLink::updateOrCreate(['id' => $i], ['url' => $validatedInformation['socialMedia'][$i]['url'], 'description' => $validatedInformation['socialMedia'][$i]['description'],
                                                        'display' => $validatedInformation['socialMedia'][$i]['display']]);
        }

        if($file = $request->file('tournament_image_1'))
            $this->saveContentInfo($file, "image tournament 1");
        if($file = $request->file('tournament_image_2'))
            $this->saveContentInfo($file, "image tournament 2");

        ContentInformation::updateOrCreate(["name" => "courrier_postal"], ['description' => $validatedInformation['courrier_postal']]);

        return redirect()->route('admin.contentinformation.edit');
    }

    private function saveContentInfo($file, $name) {
        $item = ContentInformation::where('name', $name)->first();

        if(isset($item) && isset($item->path)){
            unlink(storage_path('app/public' . $item->path));
        }

        $path = $file->store('public/upload/images/content_information');
        $filepath = substr($path, 6);

        ContentInformation::updateOrCreate(["name" => $name], ['path' => $filepath]);
    }

    private function saveMediaLink($file, $id) {
        $item = MediaLink::where('id', $id)->first();

        if(isset($item) && isset($item->path)){
            unlink(storage_path('app/public' . $item->path));
        }

        $path = $file->store('public/upload/images/media_link');
        $filepath = substr($path, 6);

        MediaLink::updateOrCreate(['id' => $id], ['path' => $filepath]);
    }

}
