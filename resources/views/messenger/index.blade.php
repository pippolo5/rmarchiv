@extends('layouts.app')
@section('pagetitle', 'persönliche nachrichten')
@section('content')
    <div class="container">
        <div class="row">
            <div class="page-header">
                <h1>persönliche nachrichten</h1>
                {!! Breadcrumbs::render('messages') !!}
            </div>
        </div>
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ $threads->links('vendor.pagination.bootstrap-4') }}
                </div>
                <ul class="list-group">
                    @foreach($threads as $thread)
                        <li class="list-group-item media" style="margin-top: 0px;">
                            <a class="pull-right" href="{{ route('board.thread.show', $thread->id) }}"><span class="badge">{{ App\Models\MessengerMessage::whereThreadId($thread->id)->count() }}</span></a>
                            <a class="pull-left" href="{{ url('users', $thread->creator()->id) }}"><img class="media-object img-rounded" width="42px" src="http://ava.rmarchiv.de/?size=42&gender=male&id={{ $thread->creator()->id }}" alt="{{ $thread->creator()->name }}"></a>
                            <div class="thread-info">
                                <div class="media-heading">
                                    @if($thread->closed == 1)
                                        <i class="fa fa-lock text-danger"></i>
                                    @endif
                                    @if(\App\Models\BoardPoll::whereThreadId($thread->id)->count() != 0)
                                        <i class="fa fa-signal fa-rotate-270"></i>
                                    @endif
                                        <a href="{{ route('board.thread.show', $thread->id) }}">
                                            <span @if($thread->isUnread($currentUserId) === true) style="font-weight: bold;" @endif>
                                                @if($thread->subject == '')
                                                    kein betreff
                                                @else
                                                    {{ $thread->subject }}
                                                @endif
                                            </span>
                                        </a>
                                </div>
                                <div class="media-body" style="font-size: 12px;">
                                    @if($thread->isUnread($currentUserId) === true)
                                    <div class="pull-right">
                                        <span class="label label-danger">
                                                neue nachricht verfügbar!
                                        </span>
                                    </div>
                                    @endif
                                    erstellt <time datetime='{{ $thread->created_at }}' title='{{ $thread->created_at }}'>{{ \Carbon\Carbon::parse($thread->created_at)->diffForHumans() }}</time>
                                    <span> • </span>
                                    letzte antwort <time datetime='{{ $thread->updated_at }}' title='{{ $thread->updated_at  }}'>{{ \Carbon\Carbon::parse($thread->updated_at)->diffForHumans() }}</time>
                                    <span> • </span>
                                    beteiligte:
                                    @foreach(App\Models\MessengerParticipant::whereThreadId($thread->id)->get() as $pp)
                                        @php $user = \App\Models\User::whereId($pp->user_id)->first() @endphp
                                    <a href='{{ url('users', $user->id) }}' class='usera' title="{{ $user->name }}">
                                        <img width="16px" class="img-rounded" src='http://ava.rmarchiv.de/?size=16&gender=male&id={{ $user->id }}' alt="{{ $user->name }}"/>
                                    </a> <a href='{{ url('users', $user->id) }}' class='user'>{{ $user->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="panel-footer">
                    {{ $threads->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>

        @if(Auth::check())
            <div class='rmarchivtbl' id='rmarchivbox_bbsopen'>
                <h2>erstelle eine neue privatnachricht</h2>
                {!! Form::open(['route' => 'messages.store']) !!}
                <div class='content'>
                    {!! Form::label('subject', 'betreff:', ['class' => 'control-label']) !!}
                    {!! Form::text('subject', null, ['class' => 'form-control']) !!}

                    {!! Form::label('message', 'nachricht:', ['class' => 'control-label']) !!}
                    {!! Form::textarea('message', null, ['class' => 'form-control']) !!}
                    <script type="text/javascript">
                        $(function() {
                            $('textarea').inlineattachment({
                                uploadUrl: 'http://rmarchiv.de/attachment/upload',
                            });
                        });
                    </script>

                    <div>
                        empfänger: (mehrfachauswahl möglich)
                        <br>
                        @if($users->count() > 0)
                            <div class="checkbox">
                                @foreach($users as $user)
                                    <label title="{{ $user->name }}"><input type="checkbox" name="recipients[]" value="{{ $user->id }}">{!!$user->name!!}</label>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
                <div class='foot'>
                    <input type='submit' value='Submit' id='submit'></div>
                {!! Form::close() !!}
            </div>
        @else
            <div class="rmarchivtbl" id="rmarchivbox_bbsopen">
                <h2>du bist nicht angemeldet.</h2>
                <div class="content">
                    du bist nicht angemeldet.<br>
                    um einen thread erstellen zu können, <a href="{{ url('login') }}">logge</a> dich ein.<br>
                    wenn du keinen account hast, <a href="{{ url('register') }}">registriere</a> dich doch einfach.
                </div>
            </div>
        @endif
    </div>
@endsection