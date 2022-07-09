@extends('layouts.admin')
@section('title', 'つぶやきの一覧')

@section('content')
    <div class="container">
      <div class="row">
          <div class="col-md-8 mx-auto">
              <h2>つぶやき新規作成</h2>
              <form action="{{ action('Admin\SnsController@create') }}" method="post" enctype="multipart/form-data">
                  @if (count($errors) > 0)
                      <ul>
                          @foreach($errors->all() as $e)
                              <li><font color="red">{{ $e }}</font></li>
                          @endforeach
                      </ul>
                  @endif
                  <div class="form-group row">
                      <label class="col-md-2" for="body">つぶやき作成</label>
                      <div class="col-md-10">
                          <input type="text" class="form-control" name="body" value="{{ old('body') }}" placeholder="いまなにしてる？">
                      </div>
                  </div>
                  {{ csrf_field() }}
                  <input type="submit" class="btn btn-primary" value="つぶやく">
              </form>
          </div>
      </div>
    </div>
<hr size="5" width="80%" color="#fff">
    <div class="container">
        <div class="row">
            <h2>つぶやき一覧</h2>
        </div>
        <div class="row">
            <div class="list-sns col-md-12 mx-auto">
                <div class="row">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th width="10%">名前</th>
                                <th width="50%">つぶやき</th>
                                <th width="30%">投稿日時</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $sns)
                                <tr>
                                    <th>{{ $user->find($sns->user_id)->name }}</th>
                                    <td>{{ $sns->body }}</td>
                                    <td>{{ $sns->created_at->format('Y年m月d日 H:i') }}</td>
                                    @if (Auth::user()->id === $user->find($sns->user_id)->id)
                                    <td><a href="{{ action('Admin\SnsController@delete', ['id' => $sns->id]) }}"><font color="red">削除</font></a></td>
                                    @endif
                                  </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection