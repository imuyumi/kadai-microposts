@if (Auth::user()->is_favorite($micropost->id))  
           {!! Form::open(['route'=>['micropost.unfav',$micropost->id],'method'=>'delete']) !!}
            {!! Form::submit('Unfavorite',['class'=>"btn btn-warning btn-xs"]) !!} 
            {!! Form::close() !!}
        @else 
            {!! Form::open(['route'=>['micropost.fav',$micropost->id]]) !!}
            {!! Form::submit('Favorite',['class'=>"btn btn btn-default btn-xs"]) !!}
           {!! Form::close() !!}
@endif