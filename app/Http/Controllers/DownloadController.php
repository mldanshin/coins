<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Validate as ValidateCoin;
use App\Models\Download\Database\Creator as CreatorDatabase;
use App\Models\Download\Document\Manager as DocumentManager;
use App\Models\Download\Document\Validate as ValidateDocument;
use App\Models\Download\Pictures\Manager as PicturesManager;
use App\Models\Download\Pictures\Validate as ValidatePictures;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

final class DownloadController extends Controller
{
    public function downloadDocument(string $type, ?string $coin = null): BinaryFileResponse
    {
        if ($coin !== null) {
            ValidateCoin::coinId($coin);
        }
        ValidateDocument::type($type);

        return response()->download(
            (new DocumentManager($type, $coin))->getFilePath()
        );
    }

    public function downloadDatabase(): BinaryFileResponse
    {
        if (config("app.env") === "demo") {
            abort(404);
        }

        return response()->download(
            (new CreatorDatabase())->getFilePath()
        );
    }

    public function downloadPictures(string $type): BinaryFileResponse|Response
    {
        ValidatePictures::type($type);

        $filePath = (new PicturesManager($type))->getFilePath();
        if ($filePath === null) {
            return response(__("message.download.picture_missing"));
        } else {
            return response()->download($filePath);
        }
    }
}
