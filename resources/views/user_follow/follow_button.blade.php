@if(Auth::id() !=$user->id) 
<!--//自分のアカウントではないかどうか確認-->
    @if (Auth::user()->is_following($user->id))  
    <!--//userをフォローしているかどうか→true-->
        {!! Form::open(['route'=>['user.unfollow',$user->id],'method'=>'delete']) !!}
            {!! Form::submit('Unfollow',['class'=>"btn btn-danger btn-block"]) !!} 
            <!--//フォローを外すボタンを表示-->
            {!! Form::close() !!}
        @else 
        <!--//userをフォローしているかどうか→folse-->
            {!! Form::open(['route'=>['user.follow',$user->id]]) !!}
                {!! Form::submit('Follow',['class'=>"btn btn-primary btn-block"]) !!}
                <!--//フォローボタンを表示-->
            {!! Form::close() !!}
    @endif
@endif