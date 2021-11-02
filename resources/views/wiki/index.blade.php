@extends('home.main')
@section('title','wiki文档') 
@section('content') 
    <div class="container">
        <div class="title">  
        </div> 
        <div class="container-fluid">
            <div class="row">
                @php
                    $mediaStore = config('mediastore.name');
                @endphp

                @foreach($projects as $project) 
                    <div class="col-sm-4"> 
                        <div class="card card-profile">
                         <div class="card-cover"> </div>
                        <div class="card-avatar border-white">
                            <a href="{{route('wiki.document.detail',['project_id'=>$project->id])}}" target="_blank">
                                <img class="wiki-doc-img" src="/uploads/{{$mediaStore.'/'.$project->thumb}}">
                            </a>
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">
                                {{$project->name}}
                            </h4>
                            <h6 class="card-category">
                                文档总数：{{$project->doc_count}}
                            </h6>
                            <p class="card-description">
                                {{$project->description}}
                            </p>
                        </div> 
                       </div>
                    </div> 
                @endforeach
            </div>
        </div>

         
    </div>
@endsection
