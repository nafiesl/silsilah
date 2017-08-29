@extends('layouts.app')

@section('title',trans('backup.index_title'))

@section('content')
<h3 class="page-header">{{ trans('backup.index_title') }}</h3>
<div class="row">
    <div class="col-md-8">
        <div class="panel panel-default table-responsive">
            <div class="panel-heading"><h3 class="panel-title">{{ trans('backup.list') }}</h3></div>
            <table class="table table-condensed">
                <thead>
                    <th>#</th>
                    <th>{{ trans('backup.file_name') }}</th>
                    <th>{{ trans('backup.file_size') }}</th>
                    <th>{{ trans('backup.created_at') }}</th>
                    <th class="text-center">{{ trans('backup.actions') }}</th>
                </thead>
                <tbody>
                    @forelse($backups as $key => $backup)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $backup->getFilename() }}</td>
                        <td>{{ formatSizeUnits($backup->getSize()) }}</td>
                        <td>{{ date('Y-m-d H:i:s', $backup->getMTime()) }}</td>
                        <td class="text-center">
                            <a href="{{ route('backups.index', ['action' => 'restore', 'file_name' => $backup->getFilename()]) }}"
                                id="restore_{{ str_replace('.gz', '', $backup->getFilename()) }}"
                                class="btn btn-warning btn-xs"
                                title="{{ trans('backup.restore') }}">{{ trans('app.restore') }}</i></a>
                            <a href="{{ route('backups.download', [$backup->getFilename()]) }}"
                                id="download_{{ str_replace('.gz', '', $backup->getFilename()) }}"
                                class="btn btn-info btn-xs"
                                title="{{ trans('backup.download') }}">{{ trans('app.download') }}</a>
                            <a href="{{ route('backups.index', ['action' => 'delete', 'file_name' => $backup->getFilename()]) }}"
                                id="del_{{ str_replace('.gz', '', $backup->getFilename()) }}"
                                class="btn btn-danger btn-xs"
                                title="{{ trans('backup.delete') }}">{{ trans('app.delete') }}</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">{{ trans('backup.empty') }}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        @include('backups.forms')
    </div>
</div>
@endsection
