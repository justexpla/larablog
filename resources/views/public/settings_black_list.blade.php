@extends('layouts.app')

@section('content')
    <div class="pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3 black-list">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{__('pages.settings.blacklist.user')}}</th>
                <th scope="col">{{__('pages.settings.blacklist.actions')}}</th>
            </tr>
            </thead>
            <tbody>
                @php
                    /** @var \Illuminate\Database\Eloquent\Collection $blackList*/
                    $counter = 1;
                @endphp
                @foreach($blackList as $user)
                    @php /** @var \App\Models\User $user*/ @endphp
                    <tr>
                        <th scope="row">
                            {{$counter++}}
                        </th>
                        <td>
                            <a href="{{$user->path()}}">{{$user->name}}</a>
                        </td>
                        <td>
                            <form action="{{route('settings.blacklist.destroy', $user)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">{{__('pages.settings.blacklist.remove_from_bl')}}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
