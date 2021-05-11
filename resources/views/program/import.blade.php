@extends('main')

@section('title', 'Program')
    
@section('breadcrumb')
<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>EduLevel</h1>
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="page-header float-right">
            <div class="page-title">
                <ol class="breadcrumb text-right">
                    <li><a href="{{url('programs')}}">Program</a></li>
                    <li class="active">import</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    <strong>Import Data Program</strong>
                </div>
                <div class="pull-right">
                    <a href="{{ url('programs') }}" class="btn btn-secondary btn-sm"><i class="fa fa-undo"></i>&nbsp;Back</a>
                </div>
            </div>
            <div class="card-body">
                 <div class="row">
                     <div class="col-md-4 offset-md-4">
                         <form action="{{ url('programs/import') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="test" value="test">
                             <div class="form-group">
                                 <label>Import Data Program</label>
                                 <input type="file" name="excel" class="form-control @error('excel') is-invalid @enderror" value="{{ old('excel') }}" autofocus>
                                 @error('excel')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>                                     
                                 @enderror
                             </div>
                             <button type="submit" class="btn btn-sm btn-info"><i class="fa fa-upload"></i>&nbsp;Unggah</button>
                         </form>
                     </div>
                 </div>
            </div>
        </div>
    </div>
</div>
{{-- content --}}
@endsection