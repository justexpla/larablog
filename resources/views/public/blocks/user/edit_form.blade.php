<div class="pl-3 pr-3 pt-3 pb-1 bg-white rounded shadow-sm mb-4 mt-3">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">{{__('misc.user_edit_profile')}}</h4>
            <form class="needs-validation mb-3" novalidate="" method="POST" action="{{route('user.update', $user)}}">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="name">{{__('misc.user_login')}}</label>
                    <input type="text"
                           class="form-control"
                           id="name"
                           placeholder="{{__('misc.user_login')}}"
                           required=""
                           name="name"
                           value="{{old('name') ?? $user->name}}"
                    >
                    <div class="invalid-feedback">
                        {{__('misc.user_login_validation_error')}}
                    </div>
                </div>

                <button class="btn btn-primary btn-lg btn-block" type="submit">{{__('misc.user_edit_submit')}}</button>
            </form>
        </div>
    </div>
</div>
