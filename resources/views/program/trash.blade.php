@extends('main')

@section('title', 'Program')
    
@section('breadcrumb')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Program</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="">Program</a></li>
                    <li class="active">trash</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Data Program</strong>
                </div>
                <div class="pull-right">
                    <a href="{{ url('programs/delete') }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete All</a>
                    <a href="{{ url('programs/restore') }}" class="btn btn-info btn-sm"><i class="fa fa-undo"></i>&nbsp;Restore All</a>
                    <a href="{{ url('programs') }}" class="btn btn-secondary btn-sm"><i class="fa fa-chevron-left"></i>&nbsp;back</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Program</th>
                            <th>Jenjang</th>
                            <th></th>
                        </tr>
                    </thead>
                   <tbody>
                       @if ($programs->count() > 0)
                       @foreach ($programs as $item)                    
                       <tr>
                           <td>{{ $loop -> iteration }}</td>
                           <td>{{ $item -> name }}</td>
                           <td>{{ $item -> edulevel->name }}</td>
                           
                           <td class="text-center">
                               <a href="{{ url('programs/restore/'.$item -> id) }}" class="btn btn-info btn-sm">Restore</a>
                               <a href="{{ url('programs/delete/'.$item -> id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus data?')">Delete Permanently</a>
                               
                           {{-- 
                            cara kedua pakai form mainkan di routenya :
                            <form action="{{ url('programs/delete/'.$item -> id) }}" method="POST" class="d-inline" onsubmit="return confirm('yakin hapus data?')">
                           @method('delete')
                           @csrf
                               <button class="btn btn-danger btn-sm">
                                   Hapus Permanently    
                               </button>    
                           </form> --}}
                        </td>
                       </tr>
                       @endforeach
                        @else
                        <tr>
                            <td colspan="4" class="text-center">Data Kosong</td>
                        </tr>
                        @endif
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>
{{-- content --}}
@endsection