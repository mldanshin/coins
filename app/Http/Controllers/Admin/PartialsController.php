<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PictureUploadRequest;
use App\Models\CRUD\Picture\Repository;
use App\Services\FileStorage;
use Illuminate\View\View;

class PartialsController extends Controller
{
    public function uploadPicture(PictureUploadRequest $request): View
    {
        $source = (new Repository(FileStorage::instance()))->upload($request->getPicture());

        return view("admin.coins.partials.picture", [
            "source" => $source
        ]);
    }
}
