@extends('app')
@section('content')
    <?php /* Left this here just to show how I called the method to upload Action Items from the provided file */ ?>
    <div class="col-xs-12 text-center" style="margin-top: 30px;" hidden>
        {!! Form::open(['route' => 'seed_data', 'files' => 'true' ]) !!}
        <input type="file" id="seed_file" name="seed_file">
        {!! Form::submit() !!}
        {!! Form::close() !!}
    </div>
    @if(isset($actions) && $actions->count() > 0)
    <div class="col-xs-12 text-center" style="margin-top: 30px; color: white;">
        <div class="col-xs-12 text-center">
            <p style="font-size: 24px;">Action item list</p>
        </div>
        <div class="row actions-contener margin_fix" style="width: 100%;">
            @foreach($actions as $a)
                <div class="col-xs-12" style="border-top: 1px solid black; padding: 15px; min-height: 60px;">
                    <div class="col-xs-11 col-sm-11 padding_fix text-left" style="font-size: 16px;">
                        <span>{{ $a->id }}.</span>
                        <span>{{ $a->description }}</span>
                        <b>({{ $a->status }})</b>
                    </div>
                    <div class="col-xs-1 col-sm-1 padding_fix" style="display: flex; align-items: center; justify-content: center; height: 100%;">
                        <i class="fa fa-plus action-show" style="font-size: 14px; color: lightgreen; background: gray; padding: 5px; border-radius: 2px; cursor: pointer;" id="{{ $a->id }}"></i>
                    </div>
                </div>
                <?php /* Each hidden div has its own file upload form */ ?>
                <div class="col-xs-12 action-div{{$a->id}}" style="padding: 10px;" hidden>
                    @if(is_null($a->filepath) || $a->filepath == "")
                        {!! Form::open(['route' => 'upload-action-file', 'files' => 'true' ]) !!}
                        <input type="hidden" name="action_id" value="{{ $a->id }}">
                        <input type="file" name="action_file">
                        <input type="submit" value="Upload file" style="float: left; color: black; width: 200px;">
                        {!! Form::close() !!}
                    @elseif($a->status == "completed" && \Storage::exists("photos/" . $a->filepath))
                        {!! Form::open(array('route' => ['actions.update', $a], 'method' => 'PUT' )) !!}
                        <button class="btn btn-new" style="display: inline-block; margin-bottom: 10px;">Mark as done</button>
                        {!! Form::close() !!}
                        <a class="link-new" href="{{ route('download-file', ['id' => $a->id ]) }}" style="display: block;">Download {{ $a->filepath }}</a>
                    @elseif($a->status == "done" && \Storage::exists("photos/" . $a->filepath))
                        <a class="link-new" href="{{ route('download-file', ['id' => $a->id ]) }}" style="display: block;">Download {{ $a->filepath }}</a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @else
        <div class="col-xs-12 text-center" style="margin-top: 30px; color: white;">
            <div class="col-xs-12 text-center">
                <p style="font-size: 24px;">There are no actions to display</p>
            </div>
        </div>
    @endif
    <?php /* This div is used to display all the validation errors that might have taken place */ ?>
    <div class="error-container">
        @if(isset($errors) && !is_null($errors))
            @foreach ($errors->all() as $message)
                <div style="position: fixed; bottom: 10px; border: 1px solid red; width: 320px; padding: 10px 0px; text-align: center; left: 50%; margin-left: -160px;">
                    <p style="margin-bottom: 0px;">{{ $message }}</p>
                </div>
            @endforeach
        @endif
    </div>
@stop
<?php /* Created div with slidetoggle to avoid redirecting with only 10 items present */ ?>
@section('scripts')
    <script type="text/javascript">
        $(".action-show").on('click', function() {
            var id = $(this).attr('id');
           $(".action-div" + id).slideToggle("fast");
        });
    </script>
@stop
