<?php


namespace App\Http\Controllers;


use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Image as ImageModel;
use App\Utils\ImageUtils;

class ImageController extends Controller
{

    public function list()
    {
        $images = ImageModel::with('fragments')->get();
//        $images = ImageModel::all();
        return $images;
    }

    public function show($id)
    {
        $image = ImageModel::with('fragments')->find($id);

        return $image;
    }

    public function upload(Request $request)
    {

        $fileModel = new ImageModel;

        if ($request->file()) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $filePath = 'storage/uploads/'.$fileName;
//            mkdir(public_path('uploads'));
            $request->file->storeAs('public/uploads', $fileName);

            $fileModel->old_name = $request->file->getClientOriginalName();
            $fileModel->name = $fileName;
            $fileModel->save();

            ImageUtils::imageCut($filePath, $fileModel->id);

            return $filePath;
        }

    }
}
