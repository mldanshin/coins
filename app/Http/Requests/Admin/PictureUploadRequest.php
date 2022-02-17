<?php

namespace App\Http\Requests\Admin;

use App\Http\Requests\Request as BaseRequest;
use App\Models\Picture\PictureType;
use App\Models\CRUD\Picture\PictureUpload;
use Illuminate\Validation\Validator;

final class PictureUploadRequest extends BaseRequest
{
    /**
     * @return mixed[]
     */
    public function rules(): array
    {
        return [
            "picture-obverse-file" => [
                "nullable",
                "file",
                "mimes:" . implode(",", config("app.picture_supported"))
            ],
            "picture-reverse-file" => [
                "nullable",
                "file",
                "mimes:" . implode(",", config("app.picture_supported"))
            ],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        if (empty($this->file("picture-obverse-file")) && empty($this->file("picture-reverse-file"))) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'picture-files',
                    __("validation.custom.picture_files.picture_files_empty")
                );
            });
        }

        if (!empty($this->file("picture-obverse-file")) && !empty($this->file("picture-reverse-file"))) {
            $validator->after(function ($validator) {
                $validator->errors()->add(
                    'picture-files',
                    __("validation.custom.picture_files.picture_files_only")
                );
            });
        }
    }

    public function getPicture(): PictureUpload
    {
        return new PictureUpload(
            $this->file("picture-obverse-file") ?? $this->file("picture-reverse-file"),
            ($this->file("picture-obverse-file") === null) ? PictureType::reverse : PictureType::obverse
        );
    }
}
