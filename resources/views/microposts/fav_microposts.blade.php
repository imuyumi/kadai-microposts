<ul class="media-list">
@foreach($favorites as $favorite)
<?php $user =$favorite->user; ?>
    <li class="media">
        <div class="media-left">
            <img class="media-object img-rounded" src="{{ Gravatar::src($user->email,50) }}" alt="">
        </div>
        <div class="media-body">
            <div>
                {!! link_to_route('users.show',$user->name,['id'=>$user->id]) !!}
                <span class="text-muted">posted at{{$favorite->created_at}}</span>
            </div>
                <p>{{ $favorite->content}}</p>
            <div>
                @if(Auth::id() == $favorite->user_id) 
                <!--ログインユーザのIDを取得することができる、Auth::user()->id と同じ動き-->
                {!! Form::open(['route'=>['microposts.destroy',$favorite->id], 'method'=>'delete']) !!}
                    {!! Form::submit('Delete',['class'=>'btn btn-danger btn-xs']) !!}           
                {!! Form::close() !!}   
                @endif
                {!! Form::open(['route'=>['micropost.unfav',$favorite->id],'method'=>'delete']) !!}
                {!! Form::submit('Unfavorite',['class'=>"btn btn-warning btn-xs"]) !!} 
                {!! Form::close() !!}
            </div>
@endforeach