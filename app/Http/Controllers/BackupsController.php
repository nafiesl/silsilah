<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\BackupUploadRequest;
use BackupManager\Filesystems\Destination;
use BackupManager\Manager;
use Illuminate\Http\Request;
use League\Flysystem\FileExistsException;
use League\Flysystem\FileNotFoundException;

class BackupsController extends Controller
{
    public function index(Request $request)
    {
        if (!file_exists(storage_path('app/backup/db'))) {
            $backups = [];
        } else {
            $backups = \File::allFiles(storage_path('app/backup/db'));

            // Sort files by modified time DESC
            usort($backups, function($a, $b) {
                return -1 * strcmp($a->getMTime(), $b->getMTime());
            });
        }

        return view('backups.index',compact('backups'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'file_name' => 'nullable|max:30|regex:/^[\w._-]+$/'
        ]);

        try {
            $manager = app()->make(Manager::class);
            $fileName = $request->get('file_name') ?: date('Y-m-d_Hi');

            $manager->makeBackup()->run('mysql', [
                    new Destination('local', 'backup/db/' . $fileName)
                ], 'gzip');

            return redirect()->route('backups.index');
        } catch (FileExistsException $e) {
            return redirect()->route('backups.index');
        }
    }

    public function destroy($fileName)
    {
        if (file_exists(storage_path('app/backup/db/') . $fileName)) {
            unlink(storage_path('app/backup/db/') . $fileName);
        }
        return redirect()->route('backups.index');
    }

    public function download($fileName)
    {
        return response()->download(storage_path('app/backup/db/') . $fileName);
    }

    public function restore($fileName)
    {
        try {
            $manager = app()->make(Manager::class);
            $manager->makeRestore()->run('local', 'backup/db/' . $fileName, 'mysql', 'gzip');
        } catch (FileNotFoundException $e) {}

        return redirect()->route('backups.index');
    }

    public function upload(BackupUploadRequest $request)
    {
        $file = $request->file('backup_file');

        if (file_exists(storage_path('app/backup/db/') . $file->getClientOriginalName()) == false) {
            $file->storeAs('backup/db', $file->getClientOriginalName());
        }

        return redirect()->route('backups.index');
    }

}
